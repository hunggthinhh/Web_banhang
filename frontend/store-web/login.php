<?php 
$pageTitle = "Đăng Nhập"; 
include 'includes/header.php'; 
?>
    <div style="max-width: 400px; margin: 100px auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <h2 style="text-align: center; font-family: 'Playfair Display', serif; margin-bottom: 25px;">Đăng Nhập</h2>
        <form id="login-form">
            <input type="email" id="email" placeholder="Email" required style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px;">
            <input type="password" id="password" placeholder="Mật khẩu" required style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px;">
            <button type="submit" class="btn" style="width: 100%; padding: 12px; font-weight: bold;">ĐĂNG NHẬP</button>
        </form>
        <p style="text-align: center; margin-top: 20px; font-size: 14px;">Chưa có tài khoản? <a href="register.php" style="color: var(--primary); font-weight: bold;">Đăng ký ngay</a></p>
    </div>

    <script>
        const loginForm = document.getElementById('login-form');
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const response = await fetch('http://127.0.0.1:8000/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ email, password })
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
