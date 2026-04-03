<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #3b2c24;
            color: #fff;
            padding: 20px;
        }

        .sidebar a {
            color: #f0ddd1;
            display: block;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar a:hover {
            color: #fff;
            padding-left: 10px;
        }

        .admin-content {
            flex: 1;
            padding: 20px;
            background: #fdfaf7;
        }
    </style>
</head>

<body>
    <div class="admin-layout">
        <div class="sidebar">
            <h2 style="color: #fff; margin-bottom: 30px;">Admin Panel</h2>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.products.index') }}">Quản lý Sản phẩm</a>
            <a href="{{ route('admin.orders.index') }}">Quản lý Đơn hàng</a>
            <a href="{{ route('home') }}" target="_blank">Xem Trang Chủ</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</body>

</html>