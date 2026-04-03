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
        const products = await apiFetch('/products?featured=1');
        const grid = document.getElementById('featured-products');
        grid.innerHTML = products.map(p => `
                <div class="product-card">
                    <img src="${p.image}" alt="${p.name}">
                    <h3>${p.name}</h3>
                    <p>${formatPrice(p.price)}</p>
                    <a href="product.php?slug=${p.slug}" class="btn">Xem chi tiết</a>
                </div>
            `).join('');

        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const count = document.getElementById('cart-count');
        if (count) count.innerText = cart.length;
    });
</script>
<?php include 'includes/footer.php'; ?>