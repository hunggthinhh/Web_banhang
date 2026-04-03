<?php 
$pageTitle = "Thanh toán"; 
include 'includes/header.php'; 
?>
        <h1 style="text-align: center; margin-top: 40px; font-family: 'Playfair Display', serif;">Thanh Toán Đơn Hàng</h1>
        <div style="display: flex; gap: 40px; margin-top: 40px;">
            <div style="flex: 1.5;">
                <h3>Thông Tin Giao Hàng</h3>
                <form id="checkout-form" style="display: flex; flex-direction: column; gap: 15px;">
                    <input type="text" id="name" placeholder="Họ và tên" required style="padding: 12px; border: 1px solid var(--border); border-radius: 5px;">
                    <input type="text" id="phone" placeholder="Số điện thoại" required style="padding: 12px; border: 1px solid var(--border); border-radius: 5px;">
                    <input type="text" id="address" placeholder="Địa chỉ giao hàng" required style="padding: 12px; border: 1px solid var(--border); border-radius: 5px;">
                    <textarea id="note" placeholder="Ghi chú thêm" style="padding: 12px; border: 1px solid var(--border); border-radius: 5px; height: 100px;"></textarea>
                </form>
            </div>
            <div style="flex: 1; background: var(--white); padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); height: fit-content;">
                <h3>Tóm Tắt Đơn Hàng</h3>
                <div id="checkout-items" style="margin: 20px 0; border-top: 1px solid var(--border); padding-top: 15px;"></div>
                <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 20px; border-top: 2px solid var(--primary); padding-top: 15px;">
                    <span>Tổng cộng</span>
                    <span id="final-total" style="color: var(--primary);">0 đ</span>
                </div>
                <button type="submit" form="checkout-form" class="btn" style="width: 100%; margin-top: 30px; padding: 15px;">XÁC NHẬN ĐẶT HÀNG</button>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                alert('Giỏ hàng trống!');
                window.location.href = 'shop.php';
                return;
            }
            let total = 0;
            const items = document.getElementById('checkout-items');
            items.innerHTML = cart.map(item => {
                const sub = item.price * item.quantity;
                total += sub;
                return `<div style="display: flex; justify-content: space-between; margin-bottom: 10px;"><span>${item.name} x ${item.quantity}</span><span>${formatPrice(sub)}</span></div>`;
            }).join('');
            document.getElementById('final-total').innerText = formatPrice(total);
            const count = document.getElementById('cart-count');
            if(count) count.innerText = cart.length;

            document.getElementById('checkout-form').onsubmit = async (e) => {
                e.preventDefault();
                const token = localStorage.getItem('auth_token');
                if (!token) {
                    alert('Vui lòng đăng nhập để thanh toán!');
                    window.location.href = 'login.php';
                    return;
                }
                const btn = e.target.querySelector('button');
                btn.disabled = true;
                btn.innerText = 'Đang xử lý...';
                const itemsList = cart.map(i => ({ product_id: i.id, quantity: i.quantity, price: i.price }));
                const response = await apiFetch('/orders', {
                    method: 'POST',
                    body: JSON.stringify({
                        customer_name: document.getElementById('name').value,
                        customer_phone: document.getElementById('phone').value,
                        shipping_address: document.getElementById('address').value,
                        note: document.getElementById('note').value,
                        total_amount: total,
                        items: itemsList
                    })
                });
                if (response.id) {
                    alert('Đặt hàng thành công!');
                    localStorage.removeItem('cart');
                    window.location.href = 'profile.php';
                } else {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                    btn.disabled = false;
                    btn.innerText = 'XÁC NHẬN ĐẶT HÀNG';
                }
            };
        });
    </script>
<?php include 'includes/footer.php'; ?>
