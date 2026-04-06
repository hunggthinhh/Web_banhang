<?php
$pageTitle = "Trang Chủ";
include 'includes/header.php';
?>
<div class="hero">
</div>

<div class="container">
    <h2 style="margin-top: 40px; text-align: center;">Bánh Nổi Bật</h2>
    <div id="featured-products" class="products-grid">
        <!-- Products will be loaded here -->
    </div>
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
    });
</script>
<?php include 'includes/footer.php'; ?>