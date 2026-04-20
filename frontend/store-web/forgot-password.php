<?php
$pageTitle = "Quên Mật Khẩu";
include 'includes/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="auth-title">Khôi phục mật khẩu</h2>
            <p class="auth-subtext">Nhập email đã đăng ký để nhận hướng dẫn khôi phục mật khẩu.</p>
        </div>

        <form id="forgot-password-form">
            <div class="form-group">
                <label for="email" class="form-label">Email tài khoản <span class="required">*</span></label>
                <input type="email" id="email" class="form-input" placeholder="Nhập email (VD: user@gmail.com)" required>
            </div>

            <button type="submit" id="btn-submit" class="auth-btn" style="margin-top: 20px;">Gửi yêu cầu</button>
            <div style="text-align: center; margin-top: 20px;">
                <a href="login.php" style="color: #666; text-decoration: none; font-size: 14px;"> Quay lại Đăng nhập</a>
            </div>
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('forgot-password-form');
    const btn = document.getElementById('btn-submit');
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        
        if (!email.endsWith('@gmail.com')) {
            alert('Vui lòng sử dụng email định dạng @gmail.com');
            return;
        }

        btn.disabled = true;
        btn.innerText = 'Đang xử lý...';

        try {
            const apiUrl = window.location.origin + '/Web_banhang/backend/public/api/forgot-password';
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ email })
            });

            const data = await response.json();
            if (response.ok) {
                alert(data.message);
                window.location.href = 'login.php';
            } else {
                alert(data.message || 'Có lỗi xảy ra, vui lòng thử lại sau.');
            }
        } catch (error) {
            alert('Lỗi kết nối đến máy chủ.');
        } finally {
            btn.disabled = false;
            btn.innerText = 'Gửi yêu cầu';
        }
    });
</script>
<?php include 'includes/footer.php'; ?>
