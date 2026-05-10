<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function handleChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $userMessage = $request->input('message');
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'reply' => 'Hệ thống AI hiện chưa được cấu hình (thiếu API Key). Vui lòng liên hệ Admin để cài đặt.'
            ]);
        }

        $products = \App\Models\Product::with('category')->where('is_active', true)->get();
        $groupedProducts = [];
        foreach($products as $p) {
            $catName = $p->category ? $p->category->name : 'Khác';
            $groupedProducts[$catName][] = $p;
        }

        $productListStr = "";
        $categoryNames = implode(', ', array_keys($groupedProducts));

        foreach($groupedProducts as $cat => $prods) {
            $productListStr .= "\n[Danh mục: {$cat}]\n";
            foreach($prods as $product) {
                $price = number_format($product->price, 0, ',', '.');
                $img = $product->image;
                $slug = $product->slug ?? $product->id;
                
                $productListStr .= "- Bánh: {$product->name} | Giá: {$price} VNĐ. \n";
                $productListStr .= "  + GIAO DIỆN HIỂN THỊ (COPY Y NGUYÊN ĐOẠN SAU KHÔNG THÊM BỚT, KHÔNG DÙNG MARKDOWN HTML): <a href='product.php?slug={$slug}' target='_blank' style='display:flex; align-items:center; gap:10px; margin-top:8px; margin-bottom:8px; text-decoration:none; color:#333; padding:8px; border:1px solid #ddd; border-radius:8px; background:#fff;'><img src='{$img}' style='width:50px; height:50px; object-fit:cover; border-radius:4px;'><div><strong style='font-size:14px;'>{$product->name}</strong><br><span style='color:#e74c3c; font-weight:bold; font-size:13px;'>{$price}₫</span></div></a> \n";
            }
        }

        $systemPrompt = "Bạn là trợ lý AI chuyên nghiệp của tiệm bánh ngọt 'La Pâtisserie'.
Nguyên tắc trả lời:
1. Nếu khách hỏi chung chung 'muốn mua bánh', hãy liệt kê các danh mục: {$categoryNames} và hỏi khách thích loại nào.
2. Khi khách hỏi một danh mục cụ thể (vd: Bánh kem), bạn PHẢI liệt kê đầy đủ TẤT CẢ sản phẩm trong danh mục đó.
3. TUYỆT ĐỐI BẮT BUỘC: Mỗi khi nhắc đến một sản phẩm, bạn KHÔNG ĐƯỢC chỉ ghi tên chay, mà PHẢI dán nguyên vẹn đoạn mã HTML bắt đầu bằng <a href=...> của sản phẩm đó vào câu trả lời để khách hàng bấm xem. Đừng dùng ký tự markdown ``` bao quanh HTML.

Dữ liệu cửa hàng:
{$productListStr}";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=' . $apiKey, [
                        'contents' => [
                            [
                                'role' => 'user',
                                'parts' => [
                                    ['text' => $systemPrompt . "\n\nKhách hàng: " . $userMessage]
                                ]
                            ]
                        ],
                        'generationConfig' => [
                            'temperature' => 0.5,
                            'maxOutputTokens' => 4000,
                        ]
                    ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi đang gặp chút sự cố khi xử lý câu trả lời.';

                // Loại bỏ markdown code blocks
                $reply = preg_replace('/```(?:html)?\n?(.*?)\n?```/s', '$1', $reply);
                
                // Loại bỏ các thẻ in đậm thừa
                $reply = str_replace(['**', '*'], '', $reply);

                return response()->json([
                    'reply' => $reply
                ]);
            }

            Log::error('Gemini API Error: ' . $response->body());
            return response()->json([
                'reply' => 'Xin lỗi, hệ thống AI đang quá tải hoặc gặp lỗi kết nối. Bạn vui lòng thử lại sau nhé!'
            ]);

        } catch (\Exception $e) {
            Log::error('Chatbot Exception: ' . $e->getMessage());
            return response()->json([
                'reply' => 'Đã xảy ra lỗi hệ thống, vui lòng thử lại sau.'
            ]);
        }
    }
}
