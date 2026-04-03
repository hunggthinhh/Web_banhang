<?php 
$pageTitle = "Chi tiết sản phẩm"; 
include 'includes/header.php'; 
?>
        <div id="product-detail" style="display: flex; gap: 50px; margin-top: 50px;">
            <!-- Loaded via JS -->
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const urlParams = new URLSearchParams(window.location.search);
            const slug = urlParams.get('slug');
            if (slug) {
                const product = await apiFetch(`/products/${slug}`);
                const detail = document.getElementById('product-detail');
                detail.innerHTML = `
                    <div style="flex: 1;"><img src="${product.image}" alt="${product.name}" style="width: 100%; border-radius: 10px;"></div>
                    <div style="flex: 1;">
                        <h1 style="font-family: 'Playfair Display', serif;">${product.name}</h1>
                        <p style="font-size: 24px; color: var(--primary); font-weight: bold; margin: 20px 0;">${formatPrice(product.price)}</p>
                        <p style="line-height: 1.6; margin-bottom: 30px;">${product.description || 'Đang cập nhật mô tả...'}</p>
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <input type="number" id="qty" value="1" min="1" style="width: 60px; padding: 10px; border: 1px solid var(--border); border-radius: 5px;">
                            <button onclick="addToCart(${product.id}, '${product.name}', ${product.price}, '${product.image}')" class="btn" style="padding: 15px 40px;">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                `;
            }
            
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const count = document.getElementById('cart-count');
            if(count) count.innerText = cart.length;
        });

        const addToCart = (id, name, price, image) => {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const qty = parseInt(document.getElementById('qty').value);
            const index = cart.findIndex(item => item.id === id);
            if (index > -1) {
                cart[index].quantity += qty;
            } else {
                cart.push({ id, name, price, image, quantity: qty });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Đã thêm vào giỏ hàng!');
            window.location.reload();
        };
    </script>
<?php include 'includes/footer.php'; ?>
