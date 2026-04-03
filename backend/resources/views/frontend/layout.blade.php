<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiệm Bánh Hạnh Phúc - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <div class="container header-container">
            <a href="{{ route('home') }}" class="logo">La Pâtisserie</a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                <li><a href="{{ route('shop') }}">Thực đơn</a></li>
                <li><a href="#">Về chúng tôi</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
            <div class="header-actions">
                <a href="{{ route('cart.index') }}">Giỏ hàng ({{ session('cart') ? count(session('cart')) : 0 }})</a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                        xuất</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Đăng nhập</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="container mt-5">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="container mt-5">
                <div class="alert alert-danger">{{ session('error') }}</div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <h3>La Pâtisserie</h3>
                    <p>Mang đến hương vị vô tận của hạnh phúc trong từng chiếc bánh nướng mỗi ngày.</p>
                </div>
                <div class="footer-col">
                    <h3>Khám phá</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="{{ route('shop') }}">Thực đơn</a></li>
                        <li><a href="#">Câu chuyện</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Liên hệ</h3>
                    <ul>
                        <li>123 Đường Ngọc Bích, TP.HCM</li>
                        <li>Hotline: 0123 456 789</li>
                        <li>Email: hello@lapatisserie.vn</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; {{ date('Y') }} La Pâtisserie. Thực hiện bài học tạo trang bánh web bằng Laravel.
            </div>
        </div>
    </footer>
</body>

</html>