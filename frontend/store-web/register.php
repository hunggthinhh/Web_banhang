<?php 
$pageTitle = "Đăng Ký"; 
include 'includes/header.php'; 
?>
    <div style="max-width: 400px; margin: 100px auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <h2 style="text-align: center; font-family: 'Playfair Display', serif; margin-bottom: 25px;">Đăng Ký Thành Viên</h2>
        <form id="register-form">
            <input type="text" id="name" placeholder="Họ và tên" required style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px;">
            <input type="text" id="username" placeholder="Username" required style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px;">
            <input type="email" id="email" placeholder="Email" required style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px;">
            <input type="password" id="password" placeholder="Mật khẩu" required style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px;">
            <input type="password" id="password_confirmation" placeholder="Xác nhận mật khẩu" required style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px;">
            <button type="submit" class="btn" style="width: 100%; padding: 12px; font-weight: bold;">ĐĂNG KÝ</button>
        </form>
        <p style="text-align: center; margin-top: 20px; font-size: 14px;">Đã có tài khoản? <a href="login.php" style="color: var(--primary); font-weight: bold;">Đăng nhập ngay</a></p>
    </div>

    <script>
        const registerForm = document.getElementById('register-form');
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const payload = {
                name: document.getElementById('name').value,
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value
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
