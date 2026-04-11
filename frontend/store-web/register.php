<?php
$pageTitle = "Đăng Ký";
include 'includes/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="auth-title">Cùng La Pâtisserie tạo nên điều khác biệt</h2>
            <p class="auth-subtext">Bạn mới bắt đầu? <a href="login.php">Đăng nhập ngay</a></p>
        </div>

        <form id="register-form">
            <div class="form-group">
                <label for="username" class="form-label">Tên đăng nhập <span class="required">*</span></label>
                <input type="text" id="username" class="form-input" placeholder="Nhập tên đăng nhập" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email <span class="required">*</span></label>
                <input type="email" id="email" class="form-input" placeholder="Nhập email" required>
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Họ và tên <span class="required">*</span></label>
                <input type="text" id="name" class="form-input" placeholder="Nhập họ và tên" required>
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Số điện thoại <span class="required">*</span></label>
                <input type="text" id="phone" class="form-input" placeholder="Nhập số điện thoại" required>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Địa chỉ <span class="required">*</span></label>
                <input type="text" id="address" class="form-input" placeholder="Nhập địa chỉ" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu <span class="required">*</span></label>
                <div class="password-wrapper">
                    <input type="password" id="password" class="form-input" placeholder="Nhập mật khẩu" required>
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu <span
                        class="required">*</span></label>
                <div class="password-wrapper">
                    <input type="password" id="password_confirmation" class="form-input" placeholder="Xác nhận mật khẩu"required>
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('password_confirmation')"></i>
                </div>
            </div>

            <button type="submit" class="auth-btn">Đăng ký</button>
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
    const registerForm = document.getElementById('register-form');
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;

        if (!email.endsWith('@gmail.com')) {
            alert('Email phải có định dạng @gmail.com');
            return;
        }

        if (!/^0\d{9}$/.test(phone)) {
            alert('Số điện thoại phải bao gồm đúng 10 chữ số và bắt đầu bằng số 0');
            return;
        }

        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;

        if (password !== password_confirmation) {
            alert('Mật khẩu xác nhận không trùng khớp!');
            return;
        }

        const payload = {
            name: document.getElementById('name').value,
            username: document.getElementById('username').value,
            email: email,
            phone: phone,
            address: document.getElementById('address').value,
            password: password,
            password_confirmation: password_confirmation
        };
        const response = await fetch('http://127.0.0.1:8000/api/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(payload)
        });
        const data = await response.json();
        if (response.ok) {
            alert('Đăng ký thành công! Hãy đăng nhập.');
            window.location.href = 'login.php';
        } else {
            alert(data.message || 'Đăng ký thất bại!');
        }
    });
</script>
<?php include 'includes/footer.php'; ?>