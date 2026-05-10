<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['product', 'user'])->orderBy('created_at', 'desc')->get();
        return response()->json($reviews);
    }

    public function userReviews(Request $request)
    {
        $user = auth('sanctum')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $reviews = Review::with(['product'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($reviews);
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) return response()->json(['message' => 'Không tìm thấy đánh giá'], 404);
        
        $review->delete();
        return response()->json(['message' => 'Đã xóa đánh giá thành công']);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|exists:products,id',
                'order_item_id' => 'required|exists:order_items,id',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string',
                'images.*' => 'nullable|image|max:10240', // 10MB max
                'videos.*' => 'nullable|mimes:mp4,mov,ogg,qt,webm|max:51200' // 50MB max
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $user = auth('sanctum')->user();
            if (!$user) {
                return response()->json(['message' => 'Bạn cần đăng nhập để đánh giá'], 401);
            }

            $orderItem = \App\Models\OrderItem::with('order')->find($request->order_item_id);
            
            if (!$orderItem || !$orderItem->order) {
                return response()->json(['message' => 'Đơn hàng không tồn tại hoặc không hợp lệ'], 400);
            }

            if ($orderItem->product_id != $request->product_id) {
                return response()->json(['message' => 'Sản phẩm không khớp với đơn hàng'], 400);
            }

            if ($orderItem->order->user_id != $user->id && $orderItem->order->customer_phone != $user->phone) {
                return response()->json(['message' => 'Bạn không có quyền đánh giá đơn hàng này'], 403);
            }

            if ($orderItem->order->status !== 'completed' && $orderItem->order->status !== 'delivered') {
                return response()->json(['message' => 'Bạn chỉ có thể đánh giá sau khi đơn hàng đã giao thành công'], 400);
            }

            if (Review::where('order_item_id', $request->order_item_id)->exists()) {
                return response()->json(['message' => 'Bạn đã đánh giá sản phẩm này rồi'], 400);
            }

            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $p = public_path('uploads/reviews');
                    if (!file_exists($p)) mkdir($p, 0777, true);
                    $file->move($p, $filename);
                    $imagePaths[] = asset('uploads/reviews/' . $filename);
                }
            }

            $videoPaths = [];
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $p = public_path('uploads/reviews');
                    if (!file_exists($p)) mkdir($p, 0777, true);
                    $file->move($p, $filename);
                    $videoPaths[] = asset('uploads/reviews/' . $filename);
                }
            }

            $review = Review::create([
                'product_id' => $request->product_id,
                'order_item_id' => $request->order_item_id,
                'user_id' => $user->id,
                'guest_name' => $user->name,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'images' => $imagePaths,
                'videos' => $videoPaths
            ]);

            $review->load('user');

            return response()->json(['message' => 'Đánh giá thành công!', 'review' => $review], 201);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
            return response()->json([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }
}
