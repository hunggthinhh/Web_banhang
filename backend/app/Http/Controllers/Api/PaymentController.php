<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * MOMO PAYMENT INTEGRATION
     */
    public function initiateMoMo(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        $endpoint = env('MOMO_ENDPOINT', 'https://test-payment.momo.vn/v2/gateway/api/create');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');
        
        $orderInfo = "Thanh toán đơn hàng #" . $order->id . " tại La Pâtisserie";
        $redirectUrl = $request->input('redirect_url', 'lpsapp://payment-result'); 
        $ipnUrl = url('/api/payments/momo/callback');
        $amount = (string)$order->total_amount;
        $requestId = time() . "";
        $requestType = "captureWallet";
        $extraData = ""; 

        // Signature logic
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $order->id . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => (string)$order->id,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
            'lang' => 'vi'
        ];

        $response = Http::post($endpoint, $data);
        
        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['message' => 'Lỗi kết nối MoMo', 'error' => $response->json()], 500);
    }

    public function handleMoMoIPN(Request $request)
    {
        Log::info('MoMo IPN Received:', $request->all());
        
        $resultCode = $request->input('resultCode');
        $orderId = $request->input('orderId');
        
        if ($resultCode == 0) {
            $order = Order::find($orderId);
            if ($order && $order->payment_status !== 'paid') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed'
                ]);
                Log::info("Order #{$orderId} paid successfully via MoMo.");
            }
        }
        
        return response()->json([], 204);
    }

    /**
     * ZALOPAY PAYMENT INTEGRATION
     */
    public function initiateZaloPay(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        $appId = env('ZALOPAY_APP_ID');
        $key1 = env('ZALOPAY_KEY1');
        $endpoint = env('ZALOPAY_ENDPOINT', 'https://sb-openapi.zalopay.vn/v2/create');

        $embedData = json_encode(['redirecturl' => $request->input('redirect_url', 'lpsapp://payment-result')]);
        $items = json_encode([]); // Can be detailed items if needed
        $transId = date("ymd") . "_" . time(); 
        
        $params = [
            "app_id" => $appId,
            "app_trans_id" => $transId,
            "app_user" => $order->customer_name ?? "Guest",
            "app_time" => round(microtime(true) * 1000),
            "amount" => (int)$order->total_amount,
            "item" => $items,
            "embed_data" => $embedData,
            "description" => "Thanh toan don hang #" . $order->id,
            "bank_code" => "",
            "callback_url" => url('/api/payments/zalopay/callback')
        ];

        // Signature: app_id|app_trans_id|app_user|amount|app_time|embed_data|item
        $data = $params["app_id"] . "|" . $params["app_trans_id"] . "|" . $params["app_user"] . "|" . $params["amount"] . "|" . $params["app_time"] . "|" . $params["embed_data"] . "|" . $params["item"];
        $params["mac"] = hash_hmac("sha256", $data, $key1);

        $response = Http::asForm()->post($endpoint, $params);
        
        if ($response->successful()) {
            // Store app_trans_id or map it to order to identify later if IPN doesn't carry order_id directly
            // For simplicity, we can put order_id in embed_data or description
            return response()->json($response->json());
        }

        return response()->json(['message' => 'Lỗi kết nối ZaloPay', 'error' => $response->json()], 500);
    }

    public function handleZaloPayIPN(Request $request)
    {
        Log::info('ZaloPay IPN Received:', $request->all());
        
        $key2 = env('ZALOPAY_KEY2');
        $dataStr = $request->input('data');
        $requestMac = $request->input('mac');
        
        $mac = hash_hmac("sha256", $dataStr, $key2);
        
        if ($mac === $requestMac) {
            $data = json_decode($dataStr, true);
            // Parse order ID from description or embed_data
            // Example description: "Thanh toan don hang #37"
            if (preg_match('/#(\d+)/', $data['description'], $matches)) {
                $orderId = $matches[1];
                $order = Order::find($orderId);
                if ($order && $order->payment_status !== 'paid') {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'confirmed'
                    ]);
                    Log::info("Order #{$orderId} paid successfully via ZaloPay.");
                }
            }
            
            return response()->json(["return_code" => 1, "return_message" => "success"]);
        }
        
        return response()->json(["return_code" => 0, "return_message" => "mac invalid"]);
    }
}
