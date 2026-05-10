<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PayOSController extends Controller
{
    private $clientId;
    private $apiKey;
    private $checksumKey;
    private $baseUrl = 'https://api-merchant.payos.vn';

    public function __construct()
    {
        $this->clientId    = env('PAYOS_CLIENT_ID');
        $this->apiKey      = env('PAYOS_API_KEY');
        $this->checksumKey = env('PAYOS_CHECKSUM_KEY');
    }

    /**
     * Tạo link thanh toán PayOS
     * POST /api/payments/payos/{orderId}
     */
    public function createPaymentLink(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->payment_status === 'paid') {
            return response()->json(['message' => 'Đơn hàng này đã được thanh toán.'], 400);
        }

        $amount      = (int) $order->total_amount;
        $orderCode   = (int) $order->id; // PayOS dùng số nguyên làm mã đơn
        $description = "LPS{$order->id}"; // Nội dung chuyển khoản - max 25 ký tự
        $cancelUrl   = $request->input('cancel_url', env('APP_URL'));
        $returnUrl   = $request->input('return_url', env('APP_URL') . '?payos_success=1&order_id=' . $order->id);

        // Tạo Checksum theo tài liệu PayOS
        // Chuỗi ký: amount={amount}&cancelUrl={cancelUrl}&description={description}&orderCode={orderCode}&returnUrl={returnUrl}
        $dataStr = "amount={$amount}&cancelUrl={$cancelUrl}&description={$description}&orderCode={$orderCode}&returnUrl={$returnUrl}";
        $signature = hash_hmac('sha256', $dataStr, $this->checksumKey);

        $payload = [
            'orderCode'   => $orderCode,
            'amount'      => $amount,
            'description' => $description,
            'cancelUrl'   => $cancelUrl,
            'returnUrl'   => $returnUrl,
            'signature'   => $signature,
            'items'       => $order->items->map(fn($i) => [
                'name'     => mb_substr($i->product_name, 0, 50),
                'quantity' => (int) $i->quantity,
                'price'    => (int) $i->price,
            ])->toArray(),
            'buyerName'   => $order->customer_name,
            'buyerPhone'  => $order->customer_phone,
            'buyerEmail'  => $order->customer_email,
            'buyerAddress'=> $order->customer_address,
        ];

        $response = Http::withHeaders([
            'x-client-id' => $this->clientId,
            'x-api-key'   => $this->apiKey,
            'Content-Type'=> 'application/json',
        ])->post("{$this->baseUrl}/v2/payment-requests", $payload);

        Log::info('PayOS Create Payment Response:', $response->json());

        if ($response->successful() && $response->json('code') === '00') {
            return response()->json([
                'success'     => true,
                'checkoutUrl' => $response->json('data.checkoutUrl'),
                'qrCode'      => $response->json('data.qrCode'),
                'paymentLinkId' => $response->json('data.paymentLinkId'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $response->json('desc') ?? 'Không thể tạo link thanh toán PayOS',
        ], 500);
    }

    /**
     * Webhook PayOS gửi về khi thanh toán thành công
     * POST /api/payments/payos/webhook
     */
    public function handleWebhook(Request $request)
    {
        Log::info('PayOS Webhook Received:', $request->all());

        // 1. Xác minh chữ ký
        $webhookData = $request->input('data');
        $receivedSignature = $request->input('signature');

        if (!$webhookData || !$receivedSignature) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        // Tạo lại signature để so sánh
        $dataStr = collect($webhookData)
            ->sortKeys()
            ->map(fn($v, $k) => "{$k}={$v}")
            ->join('&');

        $expectedSignature = hash_hmac('sha256', $dataStr, $this->checksumKey);

        if ($expectedSignature !== $receivedSignature) {
            Log::warning('PayOS Webhook: Invalid signature');
            return response()->json(['message' => 'Invalid signature'], 401);
        }

        // 2. Xử lý khi thanh toán thành công (code '00')
        $code      = $request->input('code');
        $orderCode = $webhookData['orderCode'] ?? null;

        if ($code === '00' && $orderCode) {
            $order = Order::find($orderCode);
            if ($order && $order->payment_status !== 'paid') {
                $order->update([
                    'payment_status' => 'paid',
                    'status'         => 'confirmed',
                ]);

                // Gửi email xác nhận
                if ($order->customer_email) {
                    try {
                        \Illuminate\Support\Facades\Mail::to($order->customer_email)
                            ->send(new \App\Mail\OrderConfirmation($order->load('items')));
                    } catch (\Exception $e) {
                        Log::error("Email failed for order #{$orderCode} via PayOS: " . $e->getMessage());
                    }
                }

                Log::info("Order #{$orderCode} paid via PayOS.");
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Kiểm tra trạng thái link thanh toán PayOS
     * GET /api/payments/payos/status/{orderId}
     */
    public function checkPaymentStatus($orderId)
    {
        $order = Order::findOrFail($orderId);
        return response()->json([
            'payment_status' => $order->payment_status,
            'status'         => $order->status,
        ]);
    }
}
