<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo isset($pageTitle) ? $pageTitle . " - La Pâtisserie" : "La Pâtisserie - Tiệm Bánh Hạnh Phúc"; ?>
    </title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="container nav">
            <a href="index.php" class="logo">
                <img src="img/logo.png" alt="Logo">
                <span>La Pâtisserie</span>
            </a>
            <div class="nav-links">
                <a href="about.php"
                    class="nav-btn <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>">Giới
                    thiệu</a>

                <div class="nav-dropdown">
                    <a href="shop.php"
                        class="nav-btn <?php echo (basename($_SERVER['PHP_SELF']) == 'shop.php' || basename($_SERVER['PHP_SELF']) == 'product.php') ? 'active' : ''; ?>">
                        Sản phẩm <i class="fas fa-chevron-down" style="font-size: 12px; margin-left: 5px;"></i>
                    </a>
                    <div class="dropdown-content" id="product-dropdown-list">
                        <!-- Populated by JS -->
                        <a href="shop.php">Tất cả sản phẩm</a>
                    </div>
                </div>

                <a href="policy.php"
                    class="nav-btn <?php echo (basename($_SERVER['PHP_SELF']) == 'policy.php') ? 'active' : ''; ?>">Chính
                    sách</a>
                <a href="contact.php"
                    class="nav-btn <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>">Liên
                    hệ</a>
                <a href="cart.php"
                    class="nav-cart <?php echo (basename($_SERVER['PHP_SELF']) == 'cart.php' || basename($_SERVER['PHP_SELF']) == 'checkout.php') ? 'active' : ''; ?>">
                    <i class="fas fa-shopping-bag"></i>
                    <span id="cart-count" class="cart-badge">0</span>
                </a>

                <span id="auth-links">
                    <a href="login.php" id="login-link" class="nav-btn">Đăng nhập</a>
                    <a href="register.php" class="nav-btn">Đăng ký</a>
                </span>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                // Fetch categories to populate dropdown
                const response = await fetch(window.location.origin + '/Web_banhang/backend/public/api/categories');
                const data = await response.json();

                const dropdownList = document.getElementById('product-dropdown-list');
                if (data && data.length > 0) {
                    data.forEach(cat => {
                        const item = document.createElement('a');
                        item.href = `shop.php#section-${cat.id}`;
                        item.textContent = cat.name;

                        // If already on shop page, handle smooth scroll directly
                        if (window.location.pathname.includes('shop.php')) {
                            item.addEventListener('click', (e) => {
                                e.preventDefault();
                                scrollToSection(cat.id, document.querySelector(`.category-item[onclick*='${cat.id}']`));
                                // Update URL hash without reload
                                history.pushState(null, null, `#section-${cat.id}`);
                            });
                        }

                        dropdownList.appendChild(item);
                    });
                }
            } catch (err) {
                console.error('Failed to load categories for dropdown:', err);
            }
        });
    </script>

    <?php
    $current = basename($_SERVER['PHP_SELF']);
    $bannerImg = 'banner.png';
    if ($current == 'about.php')
        $bannerImg = 'banner-about.png';
    elseif ($current == 'shop.php' || $current == 'product.php')
        $bannerImg = 'banner-products.png';
    elseif ($current == 'policy.php')
        $bannerImg = 'banner-policy.png';

    // Sub-hero only on specific pages
    $hasBanner = in_array($current, ['about.php', 'shop.php', 'product.php', 'policy.php']);
    if ($hasBanner):
        ?>
        <div class="sub-hero" style="background-image: url('img/<?php echo $bannerImg; ?>');">
            <!-- Banner image -->
        </div>
    <?php endif; ?>

    <?php if ($current != 'index.php' && $current != 'login.php' && $current != 'register.php'): ?>
        <div class="breadcrumbs-wrapper">
            <div class="container">
                <div class="breadcrumbs">
                    <a href="index.php">Trang chủ</a> <span>/</span> <?php echo $pageTitle; ?>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 20px;">
        <?php endif; ?>