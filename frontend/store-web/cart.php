<?php
$pageTitle = "Giỏ hàng";
include 'includes/header.php';
?>
<div class="cart-wrapper">
    <h1 class="cart-title">Giỏ hàng</h1>
    <div class="cart-underline"></div>

    <div id="cart-content">
        <!-- Loaded via JS -->
    </div>
</div>

<style>
    .cart-wrapper {
        background: var(--white);
        border-radius: 20px;
        padding: 40px;
        margin-top: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        min-height: 500px;
    }

    .cart-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 700;
        color: #001f3f;
        margin-bottom: 5px;
    }

    .cart-underline {
        border-bottom: 1px solid #f0ddd1;
        margin-bottom: 20px;
        padding-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th {
        font-family: 'Playfair Display', serif;
        text-align: left;
        padding: 15px;
        color: #001f3f;
        border-bottom: 2px solid #f0ddd1;
    }

    td {
        padding: 20px 15px;
        border-bottom: 1px solid #f0ddd1;
        vertical-align: middle;
    }

    .empty-cart {
        text-align: center;
        padding: 80px 0;
    }

    .empty-cart h2 {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        color: #001f3f;
        margin-bottom: 30px;
    }

    .btn-empty {
        background: #ffd699;
        color: #4a3b32;
        padding: 12px 30px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        transition: background 0.3s;
    }

    .btn-empty:hover {
        background: #f0c07d;
    }

    .total-section {
        text-align: right;
        margin-top: 30px;
        padding: 20px;
    }

    .total-price {
        font-size: 24px;
        font-weight: bold;
        color: var(--price-color);
        margin-bottom: 20px;
    }

    .remove-btn {
        color: #e53e3e;
        text-decoration: underline;
        cursor: pointer;
        background: none;
        border: none;
        font-size: 14px;
    }

    .qty-controls {
        display: flex;
        align-items: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        width: fit-content;
    }

    .qty-btn {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: none;
        cursor: pointer;
        font-size: 18px;
        color: #64748b;
        transition: background 0.3s;
    }

    .qty-btn:hover {
        background: #e2e8f0;
    }

    #qty-val {
        width: 45px;
        text-align: center;
        border: none;
        background: none;
        font-weight: 700;
        font-size: 16px;
        color: #1e293b;
    }
</style>

<script>
    const renderCart = () => {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const container = document.getElementById('cart-content');
        if (cart.length === 0) {
            container.innerHTML = `
                <div class="empty-cart">
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 28px; margin-bottom: 25px;">Giỏ hàng của bạn đang trống!</h2>
                    <a href="shop.php" class="btn" style="padding: 12px 30px; border-radius: 10px; text-decoration: none; font-weight: 600;">Tiếp tục mua hàng</a>
                </div>
            `;
            if (typeof updateCartBadge === 'function') updateCartBadge();
            return;
        }

        let total = 0;
        let html = `<table style="min-width: 900px;"><thead><tr><th>Sản phẩm</th><th>Giá</th><th style="width: 120px;">Số lượng</th><th>Lời chúc</th><th>Tổng cộng</th><th>Thao tác</th></tr></thead><tbody>`;
        cart.forEach((item, index) => {
            const subtotal = item.price * (item.quantity || 1);
            total += subtotal;
            html += `
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <img src="${item.image}" width="80" height="80" style="border-radius: 12px; object-fit: cover; border: 1px solid #eee;">
                            <div style="text-align: left;">
                                <strong style="font-size: 16px; color: var(--name-color); display: block; margin-bottom: 5px;">${item.name}</strong>
                                <span style="font-size: 13px; color: #8c7e73;">Giao hàng nhanh trong 2h</span>
                            </div>
                        </div>
                    </td>
                    <td style="font-weight: 500; color: var(--price-color);">${formatPrice(item.price)}</td>
                    <td>
                        <div class="qty-controls">
                            <button class="qty-btn" onclick="updateQty(${index}, -1)">-</button>
                            <input type="number" id="qty-val-${index}" value="${item.quantity || 1}" min="1" onchange="setQty(${index}, this.value)" style="width: 40px; text-align: center; border: none; background: transparent; font-weight: 700;">
                            <button class="qty-btn" onclick="updateQty(${index}, 1)">+</button>
                        </div>
                    </td>
                    <td>
                        <textarea 
                            onchange="updateGreeting(${index}, this.value)" 
                            placeholder="Nhập lời chúc cho bánh..." 
                            style="width: 180px; height: 60px; padding: 10px; border-radius: 12px; border: 1.5px solid #f0c07d; background: #fffaf2; font-family: 'Outfit', sans-serif; font-size: 13px; resize: none; outline: none;"
                        >${item.greeting || ''}</textarea>
                    </td>
                    <td><strong style="color: var(--price-color); font-size: 16px;">${formatPrice(subtotal)}</strong></td>
                    <td><button class="remove-btn" onclick="removeItem(${index})">Xóa</button></td>
                </tr>
            `;
        });
        html += `
            </tbody></table>
            <div class="total-section">
                <div style="margin-bottom: 10px; color: #666;">Tạm tính: ${formatPrice(total)}</div>
                <p class="total-price" style="font-size: 28px;">Tổng cộng: ${formatPrice(total)}</p>
                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <a href="shop.php" style="padding: 15px 30px; border: 1.5px solid #f0c07d; border-radius: 12px; text-decoration: none; color: #7a5a3a; font-weight: 600;">Tiếp tục mua bánh</a>
                    <a href="checkout.php" class="btn" style="padding: 15px 50px; font-size: 18px; border-radius: 12px; font-weight: 700; background: var(--price-color); color: #fff; border: none; box-shadow: 0 5px 15px rgba(230, 81, 0, 0.3);">Tiến hành đặt hàng </a>
                </div>
            </div>
        `;
        container.innerHTML = html;
        if (typeof updateCartBadge === 'function') updateCartBadge();
    };

    const updateQty = (index, change) => {
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        if (cart[index]) {
            cart[index].quantity = (cart[index].quantity || 1) + change;
            if (cart[index].quantity < 1) cart[index].quantity = 1;
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
        }
    };

    const setQty = (index, val) => {
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        if (cart[index]) {
            let num = parseInt(val);
            if (isNaN(num) || num < 1) num = 1;
            cart[index].quantity = num;
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
        }
    };

    const updateGreeting = (index, text) => {
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        if (cart[index]) {
            cart[index].greeting = text;
            localStorage.setItem('cart', JSON.stringify(cart));
        }
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