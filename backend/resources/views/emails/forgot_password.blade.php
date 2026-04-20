<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Khôi phục mật khẩu</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #001f3f; margin-bottom: 5px; }
        .content { background-color: #f9f9f9; padding: 25px; border-radius: 8px; }
        .btn { display: inline-block; padding: 12px 25px; background-color: #e65100; color: #fff !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>La Pâtisserie</h1>
            <p>Tiệm bánh ngọt hương vị Pháp</p>
        </div>
        <div class="content">
            <p>Chào <strong>{{ $user->name }}</strong>,</p>
            <p>Chúng tôi nhận được yêu cầu khôi phục mật khẩu cho tài khoản của bạn. Vui lòng nhấp vào nút bên dưới để tiến hành đặt lại mật khẩu mới:</p>
            
            <div style="text-align: center;">
                <a href="{{ env('APP_FRONTEND_URL', 'http://localhost/Web_banhang/frontend/store-web') }}/reset-password.php?token={{ $token }}&email={{ urlencode($user->email) }}" class="btn">Đặt lại mật khẩu</a>
            </div>
            
            <p style="margin-top: 25px;">Nếu bạn không yêu cầu thay đổi này, hãy bỏ qua email này. Liên kết này sẽ hết hạn sau 60 phút.</p>
            <p>Trân trọng,<br>Đội ngũ La Pâtisserie</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} La Pâtisserie. All rights reserved.
        </div>
    </div>
</body>
</html>
