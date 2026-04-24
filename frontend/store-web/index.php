<?php
$pageTitle = "Trang Chủ";
include 'includes/header.php';
?>
    <div class="hero">
        <div class="hero-content">
            <!-- Content removed for clean banner look -->
        </div>
    </div>

<div class="container reveal reveal-up">
    <h2 style="margin-top: 60px; text-align: center; font-size: 36px; margin-bottom: 40px;">Sản phẩm nổi bật</h2>
    <div style="position: relative;">
        <button id="prev-btn" class="slider-btn prev"><i class="fas fa-chevron-left"></i></button>
        <div id="featured-products" class="products-grid-5">
            <!-- Products will be loaded here -->
        </div>
        <button id="next-btn" class="slider-btn next"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>

<!-- Our Story Snippet -->
<section class="about-snippet reveal reveal-up">
    <div class="container">
        <div class="about-snippet-grid">
            <div class="about-snippet-image reveal reveal-up">
                <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Baking Process">
            </div>
            <div class="about-snippet-content reveal reveal-up" style="transition-delay: 0.2s;">
                <h2>Câu Chuyện Về Đam Mê</h2>
                <p>Tại La Pâtisserie, chúng tôi tin rằng mỗi chiếc bánh đều mang trong mình một câu chuyện. Từ khâu chọn lựa nguyên liệu hữu cơ đến quy trình nhào bột truyền thống, mỗi bước đều được thực hiện bằng cả trái tim của những người thợ lành nghề.</p>
                <p>Chúng tôi không chỉ bán bánh, chúng tôi mang đến niềm hạnh phúc trong từng miếng thưởng thức.</p>
                <a href="about.php" class="btn-primary">Tìm hiểu thêm</a>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="home-categories-wrapper reveal reveal-up">
    <div class="container">
        <div class="home-categories-section">
            <div class="home-categories-left">
                <h2>Danh mục sản phẩm</h2>
                <div id="home-category-list" class="home-category-list">
                    <!-- Loaded via JS -->
                </div>
            </div>
            <div class="home-categories-right reveal reveal-up" style="transition-delay: 0.2s;">
                <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Bakery">
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section reveal reveal-up">
    <div class="container">
        <h2 style="font-size: 38px; color: var(--text-main); margin-bottom: 20px; text-align: center;">Khách Hàng Nói Gì Về Chúng Tôi</h2>
        <div class="testimonial-grid">
            <div class="testimonial-card reveal reveal-up" style="transition-delay: 0.1s;">
                <i class="fas fa-quote-left"></i>
                <p>"Bánh ở đây thực sự rất khác biệt, vị ngọt thanh và rất đậm đà hương vị tự nhiên. Gia đình tôi rất thích!"</p>
                <div class="testimonial-user">
                    <img src="https://i.pravatar.cc/150?u=1" alt="User">
                    <h4>Chị Lan Anh</h4>
                </div>
            </div>
            <div class="testimonial-card reveal reveal-up" style="transition-delay: 0.2s;">
                <i class="fas fa-quote-left"></i>
                <p>"Dịch vụ giao hàng rất nhanh và đóng gói cũng rất cẩn thận. Chắc chắn tôi sẽ quay lại ủng hộ tiệm bánh."</p>
                <div class="testimonial-user">
                    <img src="https://i.pravatar.cc/150?u=2" alt="User">
                    <h4>Anh Minh Tuấn</h4>
                </div>
            </div>
            <div class="testimonial-card reveal reveal-up" style="transition-delay: 0.3s;">
                <i class="fas fa-quote-left"></i>
                <p>"Không gian tiệm rất đẹp và bánh thì khỏi bàn, cực kỳ chất lượng. Rất xứng đáng với giá tiền!"</p>
                <div class="testimonial-user">
                    <img src="https://i.pravatar.cc/150?u=3" alt="User">
                    <h4>Chị Hồng Phượng</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Confidence Section -->
<div class="container reveal reveal-up">
    <section class="confidence-section">
        <div class="confidence-faded-bg">CHÚNG TÔI TỰ TIN</div>
        <div class="confidence-content">
            <h2 class="confidence-title">CHÚNG TÔI TỰ TIN</h2>
            <div class="commitment-grid">
                <div class="commitment-item reveal reveal-up" style="transition-delay: 0.1s;">
                    <div class="commitment-icon" style="position: relative;">
                        <i class="fas fa-industry" style="font-size: 40px;"></i>
                        <i class="fas fa-ban" style="position: absolute; top: -5px; right: -5px; font-size: 30px; color: #ff6b35;"></i>
                    </div>
                    <p class="commitment-text">Nói không với<br>nhà máy</p>
                </div>
                <div class="commitment-item reveal reveal-up" style="transition-delay: 0.2s;">
                    <div class="commitment-icon">
                        <i class="fas fa-seedling" style="font-size: 45px;"></i>
                        <i class="fas fa-long-arrow-alt-right" style="margin: 0 10px;"></i>
                        <i class="fas fa-store" style="font-size: 40px;"></i>
                    </div>
                    <p class="commitment-text">Bao tiêu sản phẩm<br>nguyên vườn</p>
                </div>
                <div class="commitment-item reveal reveal-up" style="transition-delay: 0.3s;">
                    <div class="commitment-icon">
                        <i class="fas fa-boxes" style="font-size: 50px;"></i>
                    </div>
                    <p class="commitment-text">Đảm bảo nguồn cung<br>ổn định suốt mùa</p>
                </div>
                <div class="commitment-item reveal reveal-up" style="transition-delay: 0.4s;">
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
                        <div style="display: flex; gap: 10px; align-items: center; margin-top: 15px;">
                            <button class="btn-add-cart" onclick="event.stopPropagation(); addCart(${p.id}, '${p.name}', ${p.price}, '${p.image}')" 
                                    style="width: 45px; height: 45px; padding: 0; border-radius: 50%; flex-shrink: 0; background:#f0f4f8; color:#001f3f; border:1.5px solid #d1d5db; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-shopping-basket" style="font-size: 18px;"></i>
                            </button>
                            <button onclick="event.stopPropagation(); buyNow(${p.id}, '${p.name}', ${p.price}, '${p.image}')" 
                                    style="flex: 1; height: 45px; background: #e53e3e; color: #fff; border: none; border-radius: 25px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.3s ease;">
                                Mua ngay
                            </button>
                        </div>
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
            <a href="shop.php#section-${cat.id}" class="home-category-item reveal reveal-up" style="transition-delay: ${index * 0.1}s;">
                <div class="cat-info">
                    <span class="cat-num">${(index + 1).toString().padStart(2, '0')}.</span>
                    <span class="cat-name">${cat.name}</span>
                </div>
                <div class="cat-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        `).join('');

        // Initialize Scroll Reveal
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    });
</script>
<?php include 'includes/footer.php'; ?>