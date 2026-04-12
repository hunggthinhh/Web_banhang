<?php
$pageTitle = "Trang Chủ";
include 'includes/header.php';
?>
<div class="hero">
</div>

<div class="container">
    <h2 style="margin-top: 40px; text-align: center;">Sản phẩm nổi bật</h2>
    <div style="position: relative;">
        <button id="prev-btn" class="slider-btn prev"><i class="fas fa-chevron-left"></i></button>
        <div id="featured-products" class="products-grid-5">
            <!-- Products will be loaded here -->
        </div>
        <button id="next-btn" class="slider-btn next"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>

<!-- Categories Section -->
<section class="home-categories-wrapper">
    <div class="container">
        <div class="home-categories-section">
            <div class="home-categories-left">
                <h2>Danh mục sản phẩm</h2>
                <div id="home-category-list" class="home-category-list">
                    <!-- Loaded via JS -->
                </div>
            </div>
            <div class="home-categories-right">
                <img src="https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Cake Decoration">
            </div>
        </div>
    </div>
</section>

<!-- Confidence Section -->
<div class="container">
    <section class="confidence-section">
        <div class="confidence-faded-bg">CHÚNG TÔI TỰ TIN</div>
        <div class="confidence-content">
            <h2 class="confidence-title">CHÚNG TÔI TỰ TIN</h2>
            <div class="commitment-grid">
                <div class="commitment-item">
                    <div class="commitment-icon" style="position: relative;">
                        <i class="fas fa-industry" style="font-size: 40px;"></i>
                        <i class="fas fa-ban" style="position: absolute; top: -5px; right: -5px; font-size: 30px; color: #ff6b35;"></i>
                    </div>
                    <p class="commitment-text">Nói không với<br>nhà máy</p>
                </div>
                <div class="commitment-item">
                    <div class="commitment-icon">
                        <i class="fas fa-seedling" style="font-size: 45px;"></i>
                        <i class="fas fa-long-arrow-alt-right" style="margin: 0 10px;"></i>
                        <i class="fas fa-store" style="font-size: 40px;"></i>
                    </div>
                    <p class="commitment-text">Bao tiêu sản phẩm<br>nguyên vườn</p>
                </div>
                <div class="commitment-item">
                    <div class="commitment-icon">
                        <i class="fas fa-boxes" style="font-size: 50px;"></i>
                    </div>
                    <p class="commitment-text">Đảm bảo nguồn cung<br>ổn định suốt mùa</p>
                </div>
                <div class="commitment-item">
                    <div class="commitment-icon">
                        <i class="fas fa-award" style="font-size: 50px;"></i>
                    </div>
                    <p class="commitment-text">Cam kết chất lượng<br>cho mọi sản phẩm</p>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const products = await apiFetch('/products?featured=1') || [];
        const grid = document.getElementById('featured-products');

        if (products.length === 0) {
            grid.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #666; margin: 40px 0;">Hiện chưa có sản phẩm nổi bật.</p>';
            return;
        }

        grid.innerHTML = products.map(p => `
                <div class="product-card" onclick="location.href='product.php?slug=${p.slug || p.id}'">
                    <div class="card-image-wrap">
                        <img src="${p.image}" alt="${p.name}">
                    </div>
                    <div class="card-body">
                        <h3>${p.name}</h3>
                        <p class="card-price">Giá từ: <span>${formatPrice(p.price)}</span></p>
                    </div>
                </div>
            `).join('');

        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const count = document.getElementById('cart-count');
        if (count) count.innerText = cart.length;

        // Implement Drag-to-Scroll
        let isDown = false;
        let startX;
        let scrollLeft;

        grid.addEventListener('mousedown', (e) => {
            isDown = true;
            grid.classList.add('active');
            startX = e.pageX - grid.offsetLeft;
            scrollLeft = grid.scrollLeft;
            grid.style.cursor = 'grabbing';
            grid.style.scrollSnapType = 'none'; // Disable snap while dragging
        });

        grid.addEventListener('dragstart', (e) => {
            e.preventDefault(); // Prevent default image drag
        });

        grid.addEventListener('mouseleave', () => {
            isDown = false;
            grid.style.cursor = 'grab';
            grid.style.scrollSnapType = 'x mandatory';
        });

        grid.addEventListener('mouseup', () => {
            isDown = false;
            grid.style.cursor = 'grab';
            grid.style.scrollSnapType = 'x mandatory';
        });

        grid.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - grid.offsetLeft;
            const walk = (x - startX) * 2; // scroll-fast
            grid.scrollLeft = scrollLeft - walk;
        });

        // Prevention of click when dragging
        grid.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (Math.abs(grid.scrollLeft - scrollLeft) > 5) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);
        });

        // Navigation buttons logic
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');

        nextBtn.addEventListener('click', () => {
            const cardWidth = grid.querySelector('.product-card').offsetWidth + 20; // width + gap
            grid.scrollLeft += cardWidth * 2; // Scroll 2 items
        });

        prevBtn.addEventListener('click', () => {
            const cardWidth = grid.querySelector('.product-card').offsetWidth + 20;
            grid.scrollLeft -= cardWidth * 2;
        });

        // Hide buttons if not scrollable
        const toggleBtns = () => {
            prevBtn.style.display = grid.scrollLeft <= 0 ? 'none' : 'flex';
            nextBtn.style.display = grid.scrollLeft + grid.offsetWidth >= grid.scrollWidth ? 'none' : 'flex';
        };

        grid.addEventListener('scroll', toggleBtns);
        window.addEventListener('resize', toggleBtns);
        setTimeout(toggleBtns, 500); // Initial check

        // Load Categories for Home Section
        const homeCatList = document.getElementById('home-category-list');
        const categories = await apiFetch('/categories') || [];
        
        homeCatList.innerHTML = categories.map((cat, index) => `
            <a href="shop.php#section-${cat.id}" class="home-category-item">
                <div class="cat-info">
                    <span class="cat-num">${(index + 1).toString().padStart(2, '0')}.</span>
                    <span class="cat-name">${cat.name}</span>
                </div>
                <div class="cat-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        `).join('');
    });
</script>
<?php include 'includes/footer.php'; ?>