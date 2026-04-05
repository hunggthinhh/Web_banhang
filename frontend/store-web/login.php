<?php
$pageTitle = "Đăng Nhập";
include 'includes/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="auth-title">Cùng La Pâtisserie tạo nên điều khác biệt</h2>
            <p class="auth-subtext">Bạn mới bắt đầu? <a href="register.php">Đăng ký ngay</a></p>
        </div>

        <form id="login-form">
            <div class="form-group">
                <label for="identifier" class="form-label">Tên đăng nhập hoặc Email <span
                        class="required">*</span></label>
                <input type="text" id="identifier" class="form-input" placeholder="Nhập tên đăng nhập hoặc email"
                    required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu <span class="required">*</span></label>
                <div class="password-wrapper">
                    <input type="password" id="password" class="form-input" placeholder="Nhập mật khẩu" required>
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
                </div>
            </div>

            <button type="submit" class="auth-btn">Đăng nhập</button>
            <a href="#" class="forgot-password">Quên mật khẩu?</a>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<script>
    const loginForm = document.getElementById('login-form');
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const identifier = document.getElementById('identifier').value;
        const password = document.getElementById('password').value;
        const response = await fetch('http://127.0.0.1:8000/api/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ email: identifier, password })
        });
        const data = await response.json();
        if (response.ok) {
            localStorage.setItem('auth_token', data.access_token);
            localStorage.setItem('user_role', data.user.role);
            localStorage.setItem('user_name', data.user.name);
            localStorage.setItem('user_email', data.user.email);
            alert('Đăng nhập thành công!');
            window.location.href = data.user.role === 'admin' ? '../admin-web/dashboard.php' : 'index.php';
        } else {
            alert(data.message || 'Đăng nhập thất bại!');
        }
    });
</script>
<?php include 'includes/footer.php'; ?>