<?php
$pageTitle = "Đặt lại mật khẩu";
include 'includes/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="auth-title">Thiết lập mật khẩu mới</h2>
            <p class="auth-subtext">Vui lòng nhập mật khẩu mới để hoàn tất việc khôi phục tài khoản.</p>
        </div>

        <form id="reset-password-form">
            <input type="hidden" id="token" value="<?php echo $_GET['token'] ?? ''; ?>">
            <input type="hidden" id="email" value="<?php echo $_GET['email'] ?? ''; ?>">

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu mới <span class="required">*</span></label>
                <input type="password" id="password" class="form-input" placeholder="Tối thiểu 6 ký tự" required minlength="6">
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu <span class="required">*</span></label>
                <input type="password" id="password_confirmation" class="form-input" placeholder="Nhập lại mật khẩu mới" required minlength="6">
            </div>

            <button type="submit" id="btn-submit" class="auth-btn" style="margin-top: 25px;">Cập nhật mật khẩu</button>
            <div style="text-align: center; margin-top: 20px;">
                <a href="login.php" style="color: #666; text-decoration: none; font-size: 14px;">Quay lại Đăng nhập</a>
            </div>
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('reset-password-form');
    const btn = document.getElementById('btn-submit');
    
    // Auto check if token and email are present
    const token = document.getElementById('token').value;
    const email = document.getElementById('email').value;

    if (!token || !email) {
        alert('Liên kết khôi phục thông tin không hợp lệ. Vui lòng yêu cầu cấp lại.');
        window.location.href = 'forgot-password.php';
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;

        if (password !== password_confirmation) {
            alert('Mật khẩu xác nhận không khớp.');
            return;
        }

        btn.disabled = true;
        btn.innerText = 'Đang cập nhật...';

        try {
            const apiUrl = window.location.origin + '/Web_banhang/backend/public/api/reset-password';
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'Accept': 'application/json' 
                },
                body: JSON.stringify({ 
                    email, 
                    token, 
                    password, 
                    password_confirmation 
                })
            });
            
            const data = await response.json();
            
            if (response.ok) {
                alert(data.message || 'Mật khẩu đã được cập nhật thành công!');
                window.location.href = 'login.php';
            } else {
                alert(data.message || 'Có lỗi xảy ra, vui lòng thử lại sau.');
                if (data.message && data.message.includes('hết hạn')) {
                    window.location.href = 'forgot-password.php';
                }
            }
        } catch (error) {
            alert('Lỗi kết nối đến máy chủ.');
        } finally {
            btn.disabled = false;
            btn.innerText = 'Cập nhật mật khẩu';
        }
    });
</script>

<?php include 'includes/footer.php'; ?>
