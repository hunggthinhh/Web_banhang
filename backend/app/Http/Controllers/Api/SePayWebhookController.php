<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class SePayWebhookController extends Controller
{
    /**
     * Handle incoming SePay Webhook
     * Documentation: https://docs.sepay.vn/tich-hop-webhook.html
     */
    public function handle(Request $request)
    {
        // 1. Log the incoming request for debugging
        Log::info('SePay Webhook Received:', $request->all());

        // 2. Security Check (Optional: check SePay API Key in headers if configured)
        // $apiKey = $request->header('x-api-key');
        // if ($apiKey !== config('services.sepay.api_key')) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        // 3. Extract transaction data
        $content = $request->input('content') ?? $request->input('description') ?? ''; 
        $amount = $request->input('amount') ?? $request->input('transferAmount') ?? $request->input('transfer_amount');

        if (!$content) {
            Log::warning('SePay Webhook: No content or description found');
            return response()->json(['message' => 'No content found'], 400);
        }

        // 4. Parse Order ID from content
        // Pattern: LPS followed by digits (e.g., LPS37)
        if (preg_match('/LPS(\d+)/i', $content, $matches)) {
            $orderId = $matches[1];
            $order = Order::find($orderId);

            if ($order) {
                // 5. Verification: Check if status is already paid to avoid duplicate processing
                if ($order->payment_status === 'paid') {
                    return response()->json(['message' => 'Order already paid'], 200);
                }

                // 6. Update order status
                // Optional: strictly check if $amount >= $order->total_amount
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed' // Or 'processing'
                ]);

                Log::info("Order #{$orderId} marked as PAID via SePay.");

                return response()->json([
                    'success' => true,
                    'message' => "Order #{$orderId} updated successfully"
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Order ID not found in content'
        ]);
    }
}
