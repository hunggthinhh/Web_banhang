<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class OrderController extends Controller
{
    // Của User
    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required|regex:/^0\d{9}$/',
            'customer_email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'customer_address' => 'required',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
            'items.*.name' => 'required',
        ], [
            'customer_email.regex' => 'Email phải có định dạng @gmail.com',
            'customer_phone.regex' => 'Số điện thoại phải bao gồm đúng 10 chữ số và bắt đầu bằng số 0'
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($request->items as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => auth()->id(), // null if guest
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total_amount' => $total,
                'delivery_date' => $request->delivery_date,
                'delivery_time' => $request->delivery_time,
                'note' => $request->note,
                'payment_method' => $request->payment_method ?? 'cod',
                'payment_status' => 'unpaid', 
                'status' => 'pending'
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'greeting' => $item['greeting'] ?? ''
                ]);
            }
            DB::commit();

            // Gửi Mail xác nhận đơn hàng (Dựa theo thiết kế Grab)
            try {
                Mail::to($request->customer_email)->send(new OrderConfirmation($order->load('items')));
            } catch (\Exception $e) {
                // Chỉ Log lỗi, không làm thất bại đơn hàng
                \Log::error("Email sending failed for order #{$order->id}: " . $e->getMessage());
            }

            return response()->json(['message' => 'Đặt hàng thành công', 'order' => $order]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }

    // Lịch sử đơn hàng của User đang đăng nhập
    public function userOrders()
    {
        $user = auth()->user();
        $orders = Order::with('items.product')->where('user_id', $user->id)
            ->orWhere(function ($query) use ($user) {
                $query->whereNull('user_id')
                    ->where('customer_phone', $user->phone);
            })
            ->latest()
            ->get();
        return response()->json($orders);
    }

    public function checkPaymentStatus($id)
    {
        $order = Order::findOrFail($id);
        return response()->json([
            'payment_status' => $order->payment_status,
            'status' => $order->status
        ]);
    }

    public function simulatePayment($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'payment_status' => 'paid',
            'status' => 'confirmed'
        ]);
        return response()->json(['message' => 'Simulated: Order confirmed and paid']);
    }

    // Của Admin
    public function index(Request $request)
    {
        $query = Order::with('items.product');
        
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('orders.id', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->get();
        return response()->json($orders);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $updateData = [];
        if ($request->has('status')) $updateData['status'] = $request->status;
        if ($request->has('payment_status')) $updateData['payment_status'] = $request->payment_status;
        
        $order->update($updateData);
        return response()->json(['message' => 'Cập nhật thành công', 'order' => $order]);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->items()->delete();
        $order->delete();
        return response()->json(['message' => 'Đã xóa đơn hàng thành công']);
    }

    public function requestReturn(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        $user = auth()->user();
        $order = Order::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere(function ($q) use ($user) {
                        $q->whereNull('user_id')
                          ->where('customer_phone', $user->phone);
                    });
            })
            ->firstOrFail();

        if ($order->status !== 'delivered' && $order->status !== 'completed') {
            return response()->json(['message' => 'Chỉ có thể yêu cầu trả hàng cho đơn hàng đã hoàn tất'], 400);
        }

        $order->update([
            'status' => 'return_requested',
            'note' => $order->note ? $order->note . " | Lý do trả: " . $request->reason : "Lý do trả: " . $request->reason
        ]);

        return response()->json(['message' => 'Yêu cầu trả hàng của bạn đã được gửi thành công']);
    }
}
