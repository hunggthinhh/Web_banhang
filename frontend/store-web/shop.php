<?php
$pageTitle = "Sản phẩm";
include 'includes/header.php';
?>
<h1 style="text-align: center; margin-top: 20px;">Tất Cả Sản Phẩm</h1>
<div id="products-list" class="products-grid">
    <!-- Loaded via JS -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const products = await apiFetch('/products');
        const grid = document.getElementById('products-list');
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