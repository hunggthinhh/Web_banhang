<div class="sidebar">
    <div style="padding: 20px 0; text-align: center;">
        <img src="img/logo.png" alt="Logo" style="width: 50px; margin-bottom: 10px;">
        <div style="color: var(--primary); font-weight: bold; font-size: 18px;">La Pâtisserie</div>
    </div>
    <a href="dashboard.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a>
    <a href="products.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'products.php') ? 'active' : ''; ?>">Sản Phẩm</a>
    <a href="categories.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'categories.php') ? 'active' : ''; ?>">Danh Mục</a>
    <a href="orders.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'orders.php') ? 'active' : ''; ?>">Đơn Hàng</a>
    <a href="../store-web/index.php">Xem Website</a>
</div>
<div class="admin-wrapper">
    <header class="admin-header">
        <h2 id="page-display-title"><?php echo isset($pageTitle) ? $pageTitle : "Dashboard"; ?></h2>
        <div style="display: flex; align-items: center; gap: 20px;">
            <span style="font-size: 14px; color: #666;">Xin chào, <strong id="admin-name">Admin</strong></span>
            <a href="#" class="btn btn-danger" id="logout-btn" style="padding: 5px 15px; font-size: 13px;">Đăng Xuất</a>
        </div>
    </header>
    <div class="main-content">
