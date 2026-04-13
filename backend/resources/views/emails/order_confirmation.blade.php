<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Xác nhận đơn hàng - La Pâtisserie</title>
</head>

<body
    style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4;">
    <div
        style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <!-- Header -->
        <div style="background-color: #c68e67; padding: 30px; text-align: left; position: relative;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px;">La Pâtisserie</h1>
            <div
                style="position: absolute; top: 0; right: 0; width: 100px; height: 100%; background: linear-gradient(135deg, transparent 50%, rgba(255,255,255,0.1) 50%);">
            </div>
        </div>

        <div style="padding: 30px;">
            <h2 style="color: #c68e67; margin-top: 0;">Chúc bạn ngon miệng!</h2>

            <table style="width: 100%; margin-bottom: 20px;">
                <tr>
                    <td style="width: 50%;">
                        <p style="margin: 0; color: #888; font-size: 14px;">Tổng cộng</p>
                        <p style="margin: 5px 0 0 0; color: #c68e67; font-size: 28px; font-weight: bold;">
                            {{ number_format($order->total_amount, 0, ',', '.') }}đ</p>
                    </td>
                    <td style="width: 50%; text-align: right; vertical-align: top;">
                        <p style="margin: 0; color: #888; font-size: 14px;">Ngày | Giờ</p>
                        <p style="margin: 5px 0 0 0; color: #333; font-size: 14px;">
                            {{ $order->created_at->format('d M y H:i') }} +0700</p>
                    </td>
                </tr>
            </table>

            <div style="border-top: 1px solid #eee; padding-top: 20px; display: flex;">
                <div style="width: 50%; display: inline-block; vertical-align: top;">
                    <h4 style="color: #c68e67; margin-bottom: 15px; text-transform: uppercase; font-size: 13px;">Chi
                        tiết đơn hàng</h4>
                    <p style="margin: 0 0 15px 0; font-size: 13px;">
                        <span style="color: #888;">Người dùng</span><br>
                        <strong style="color: #333;">{{ $order->customer_name }}</strong>
                    </p>
                    <p style="margin: 0 0 15px 0; font-size: 13px;">
                        <span style="color: #888;">Mã đơn hàng</span><br>
                        <strong style="color: #333;">#{{ $order->id }}</strong>
                    </p>
                    <p style="margin: 0 0 15px 0; font-size: 13px;">
                        <span style="color: #888;">Giao đến</span><br>
                        <strong style="color: #333;">{{ $order->customer_address }}</strong>
                    </p>
                </div>

                <div
                    style="width: 45%; display: inline-block; vertical-align: top; background-color: #fafafa; padding: 15px; border-radius: 8px; margin-left: 4%;">
                    <h4 style="color: #c68e67; margin-top: 0; margin-bottom: 10px; font-size: 13px;">HÓA ĐƠN CỦA BẠN
                    </h4>
                    <p style="font-size: 12px; margin: 0 0 5px 0; color: #888;">Bạn trả bằng:</p>
                    <strong style="font-size: 13px; color: #333;">Tiền mặt (COD)</strong>

                    <div style="border-top: 1px dashed #ccc; margin: 10px 0;"></div>

                    @foreach($order->items as $item)
                        <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 8px;">
                            <span style="color: #333;">{{ $item->quantity }}x {{ $item->product_name }}</span>
                            <span
                                style="color: #333;">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</span>
                        </div>
                    @endforeach

                    <div style="border-top: 1px dashed #ccc; margin: 10px 0;"></div>

                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px;">
                        <span style="color: #888;">Phí giao hàng</span>
                        <span style="color: #333;">0đ</span>
                    </div>

                    <div
                        style="display: flex; justify-content: space-between; font-weight: bold; font-size: 15px; margin-top: 10px; color: #000;">
                        <span>BẠN TRẢ: </span>
                        <span>{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                    </div>
                </div>
            </div>

            <div style="margin-top: 40px; text-align: center;">
                <p style="color: #888; font-size: 12px;">ĐÁNH GIÁ BỮA ĂN NÀY!</p>
                <div style="font-size: 24px;">⭐⭐⭐⭐⭐</div>
            </div>
        </div>

        <!-- Footer Banner -->
        <div style="background-color: #fdf5ed; padding: 20px; text-align: center;">
            <p style="color: #c68e67; margin: 0; font-weight: bold; font-size: 14px;">Cùng La Pâtisserie lan tỏa niềm
                vui ngọt ngào</p>
        </div>

        <!-- Footer Info -->
        <div style="padding: 20px; text-align: center; color: #aaa; font-size: 11px;">
            <p style="margin: 5px 0;">Đây là email tự động, vui lòng không trả lời.</p>
            <p style="margin: 5px 0;">© 2026 La Pâtisserie. 116/3 Hùng Vương, Diên Khánh, Khánh Hòa.</p>
        </div>
    </div>
</body>

</html>