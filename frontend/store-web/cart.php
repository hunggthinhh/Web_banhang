<?php 
$pageTitle = "Giỏ hàng"; 
include 'includes/header.php'; 
?>
        <div class="cart-wrapper">
            <h1 class="cart-title">Giỏ hàng</h1>
            <span class="cart-date" id="current-date"></span>
            
            <div id="cart-content">
                <!-- Loaded via JS -->
            </div>
        </div>

    <style>
        .cart-wrapper { background: var(--white); border-radius: 20px; padding: 40px; margin-top: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); min-height: 500px; }
        .cart-title { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: #001f3f; margin-bottom: 5px; }
        .cart-date { font-size: 14px; color: #8c7e73; margin-bottom: 20px; border-bottom: 1px solid #f0ddd1; padding-bottom: 15px; display: block; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { font-family: 'Playfair Display', serif; text-align: left; padding: 15px; color: #001f3f; border-bottom: 2px solid #f0ddd1; }
        td { padding: 20px 15px; border-bottom: 1px solid #f0ddd1; vertical-align: middle; }
        .empty-cart { text-align: center; padding: 80px 0; }
        .empty-cart h2 { font-family: 'Playfair Display', serif; font-size: 32px; color: #001f3f; margin-bottom: 30px; }
        .btn-empty { background: #ffd699; color: #4a3b32; padding: 12px 30px; border-radius: 10px; text-decoration: none; font-weight: 600; display: inline-block; transition: background 0.3s; }
        .btn-empty:hover { background: #f0c07d; }
        .total-section { text-align: right; margin-top: 30px; padding: 20px; }
        .total-price { font-size: 24px; font-weight: bold; color: var(--primary); margin-bottom: 20px; }
        .remove-btn { color: #e53e3e; text-decoration: underline; cursor: pointer; background: none; border: none; font-size: 14px; }
    </style>

    <script>
        document.getElementById('current-date').innerText = new Date().toLocaleDateString('vi-VN');
        const renderCart = () => {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const container = document.getElementById('cart-content');
            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="empty-cart">
                        <h2>Giỏ hàng đang trống, quay lại mua hàng ?</h2>
                        <a href="shop.php" class="btn-empty">Quay trở lại cửa hàng</a>
                    </div>
                `;
                return;
            }
            let total = 0;
            let html = `<table><thead><tr><th>Sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Tổng</th><th>Tuỳ chỉnh</th></tr></thead><tbody>`;
            cart.forEach((item, index) => {
                const subtotal = item.price * item.quantity;
                total += subtotal;
                html += `
                    <tr>
                        <td><div style="display: flex; align-items: center; gap: 15px;"><img src="${item.image}" width="60" height="60" style="border-radius: 8px; object-fit: cover;"><strong>${item.name}</strong></div></td>
                        <td>${formatPrice(item.price)}</td>
                        <td>${item.quantity}</td>
                        <td><strong>${formatPrice(subtotal)}</strong></td>
                        <td><button class="remove-btn" onclick="removeItem(${index})">Xóa</button></td>
                    </tr>
                `;
            });
            html += `</tbody></table><div class="total-section"><p class="total-price">Tổng cộng: ${formatPrice(total)}</p><a href="checkout.php" class="btn" style="padding: 15px 40px; font-size: 18px;">Thanh Toán Ngay</a></div>`;
            container.innerHTML = html;
            const count = document.getElementById('cart-count');
            if(count) count.innerText = cart.length;
        };
        const removeItem = (index) => {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
        };
        document.addEventListener('DOMContentLoaded', renderCart);
    </script>
<?php include 'includes/footer.php'; ?>
