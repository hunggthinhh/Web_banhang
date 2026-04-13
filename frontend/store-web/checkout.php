<?php
$pageTitle = "Thanh toán";
include 'includes/header.php';
?>

<!-- Bank Payment Modal (Reverted to Simple Version) -->
<div id="bank-payment-modal"
    style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7); z-index:9999; align-items:center; justify-content:center;">
    <div
        style="background:#fff; width:450px; border-radius:30px; padding:40px; text-align:center; box-shadow:0 20px 50px rgba(0,0,0,0.2); position:relative; overflow:hidden;">
        <i class="fas fa-times" onclick="document.getElementById('bank-payment-modal').style.display='none'"
            style="position:absolute; top:25px; right:25px; cursor:pointer; font-size:20px; color:#999;"></i>

        <h2 style="font-family:'Playfair Display', serif; color:#001f3f; margin-bottom:10px;">Thanh toán đơn hàng</h2>
        <p style="color:#666; font-size:15px; margin-bottom:25px;">Quét mã VietQR bên dưới để hoàn tất việc thanh toán.
        </p>

        <div
            style="background:#fdfaf7; border:2px solid #f0c07d; border-radius:20px; padding:25px; margin-bottom:25px;">
            <img id="web-qr-code" src=""
                style="width:100%; max-width:280px; border-radius:15px; border:1px solid #eee;">
            <div style="margin-top:20px; text-align:left; border-top:1px dashed #ccc; padding-top:20px;">
                <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                    <span style="color:#888; font-size:13px;">Ngân hàng</span>
                    <b style="color:#001f3f; font-size:14px;">MB BANK</b>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                    <span style="color:#888; font-size:13px;">Số tài khoản</span>
                    <b style="color:#001f3f; font-size:16px;">100012113979</b>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                    <span style="color:#888; font-size:13px;">Chủ tài khoản</span>
                    <b style="color:#001f3f; font-size:14px; text-transform:uppercase;">PHAN HUNG THINH</b>
                </div>
            </div>
        </div>

        <button onclick="confirmBankTransferWeb()" class="btn-place-order" style="margin-top:0; background:#001f3f;">TÔI
            ĐÃ CHUYỂN TIỀN</button>
        <p style="margin-top:15px; font-size:12px; color:#999;">Chúng tôi sẽ xử lý đơn hàng ngay khi tiền về tài khoản.
        </p>
    </div>
</div>

<div class="checkout-layout">
    <div class="checkout-left">
        <h1 class="page-title">Thanh toán và giao hàng</h1>

        <div class="checkout-section">
            <h3 class="section-title">Thông tin tài khoản</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label>Họ và tên <span class="required">*</span></label>
                    <input type="text" id="name" placeholder="Họ tên của bạn" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại <span class="required">*</span></label>
                    <input type="text" id="phone" placeholder="Số điện thoại" required>
                </div>
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label>Địa chỉ email <span class="required">*</span></label>
                <input type="email" id="email" placeholder="Email của bạn" required>
            </div>
        </div>

        <div class="checkout-section">
            <h3 class="section-title">Thông tin Giao hàng</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label>Tỉnh/Thành phố <span class="required">*</span></label>
                    <select id="city" required>
                        <option value="">Chọn tỉnh thành</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quận/Huyện <span class="required">*</span></label>
                    <select id="district" required disabled>
                        <option value="">Chọn quận huyện</option>
                    </select>
                </div>
            </div>
            <div class="form-grid" style="margin-top: 15px;">
                <div class="form-group">
                    <label>Xã/Phường <span class="required">*</span></label>
                    <select id="ward" required disabled>
                        <option value="">Chọn xã/phường</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Địa chỉ <span class="required">*</span></label>
                    <input type="text" id="address" placeholder="Ví dụ: Số 20, ngõ 90" required>
                </div>
            </div>

            <div class="delivery-date-container"
                style="margin-top: 25px; padding: 25px; background: #fffaf5; border: 1.5px solid #f0c07d; border-radius: 20px;">
                <label
                    style="display: block; font-weight: 700; margin-bottom: 15px; color: #001f3f; font-size: 16px;">Ngày
                    giao hàng (tùy chọn)</label>
                <div style="display: flex; gap: 15px; align-items: center;">
                    <div class="date-select-item">
                        <select id="deliv-day-sel"
                            style="width: 100px; padding: 12px; border: 1.5px solid #001f3f; border-radius: 12px;">
                            <option value="">Ngày</option>
                            <?php for ($i = 1; $i <= 31; $i++)
                                echo "<option value='$i'>$i</option>"; ?>
                        </select>
                    </div>

                    <div class="date-select-item">
                        <select id="deliv-month-sel"
                            style="width: 100px; padding: 12px; border: 1.5px solid #001f3f; border-radius: 12px;">
                            <option value="">Tháng</option>
                            <?php for ($i = 1; $i <= 12; $i++)
                                echo "<option value='$i'>$i</option>"; ?>
                        </select>
                    </div>

                    <div class="date-select-item">
                        <select id="deliv-year-sel"
                            style="width: 100px; padding: 12px; border: 1.5px solid #001f3f; border-radius: 12px;">
                            <option value="">Năm</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label>Khung giờ giao (tùy chọn)</label>
                <select id="deliv-time">
                    <option value="">Chọn khung giờ</option>
                    <option value="08:00 - 10:00">08:00 - 10:00</option>
                    <option value="10:00 - 12:00">10:00 - 12:00</option>
                    <option value="13:00 - 15:00">13:00 - 15:00</option>
                    <option value="15:00 - 17:00">15:00 - 17:00</option>
                </select>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label>Yêu cầu khác (tùy chọn)</label>
                <textarea id="note" placeholder="Ví dụ: Giao lên lầu 3, gọi trước khi đến..."
                    style="height: 80px;"></textarea>
            </div>
        </div>

        <div class="checkout-section">
            <h3 class="section-title">Phương thức thanh toán</h3>
            <div class="payment-options">
                <label class="payment-item">
                    <input type="radio" name="payment" value="cod" checked>
                    <span>Thanh toán khi nhận hàng (COD)</span>
                </label>
                <label class="payment-item">
                    <input type="radio" name="payment" value="bank">
                    <span>Thanh toán qua ngân hàng (VietQR)</span>
                </label>
            </div>
        </div>
    </div>

    <div class="checkout-sidebar">
        <div class="sidebar-inner">
            <h3 class="section-title">Chi tiết đơn hàng</h3>
            <div id="checkout-items"></div>
            <div class="summary-line">
                <span>Tạm tính</span>
                <span id="sub-total">0 đ</span>
            </div>
            <div class="summary-line">
                <span>Phí giao hàng</span>
                <span>Miễn phí</span>
            </div>
            <div class="summary-total">
                <span>Tổng cộng</span>
                <span id="final-total">0 đ</span>
            </div>
            <button type="button" onclick="placeOrder()" id="btn-submit" class="btn-place-order">XÁC NHẬN ĐẶT
                HÀNG</button>
            <p style="text-align: center; font-size: 13px; color: #666; margin-top: 15px;">Bằng cách đặt hàng, bạn đồng
                ý với Điều khoản dịch vụ của chúng tôi.</p>
        </div>
    </div>
</div>

<style>
    .checkout-layout {
        display: flex;
        gap: 40px;
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .checkout-left {
        flex: 1.6;
    }

    .checkout-sidebar {
        flex: 1;
    }

    .sidebar-inner {
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        position: sticky;
        top: 120px;
    }

    .checkout-section {
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        margin-bottom: 25px;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        margin-bottom: 20px;
        color: #001f3f;
        border-bottom: 1.5px solid #fef0e4;
        padding-bottom: 10px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #001f3f;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 16px 20px;
        border: 1.5px solid #001f3f;
        border-radius: 12px;
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        background: #fff;
        transition: all 0.3s;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%2212%22%20viewBox%3D%220%200%2012%2012%22%3E%3Cpath%20fill%3D%22%23001f3f%22%20d%3D%22M10.293%203.293L6%207.586%201.707%203.293A1%201%200%2000.293%204.707l5%205a1%201%200%20001.414%200l5-5a1%201%200%2010-1.414-1.414z%22%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        cursor: pointer;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 4px rgba(0, 31, 63, 0.05);
    }

    .required {
        color: #e53e3e;
    }

    .payment-options {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .payment-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 18px;
        border: 1.5px solid #001f3f;
        border-radius: 15px;
        cursor: pointer;
        transition: 0.3s;
    }

    .payment-item:hover {
        border-color: var(--primary);
        background: #fefaf7;
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        color: #666;
        font-size: 15px;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #001f3f;
        font-size: 24px;
        font-weight: 800;
        color: var(--price-color);
    }

    .btn-place-order {
        width: 100%;
        padding: 20px;
        background: var(--price-color);
        color: #fff;
        border: none;
        border-radius: 15px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 25px;
        transition: 0.3s;
        letter-spacing: 1px;
    }

    .btn-place-order:hover {
        filter: brightness(1.1);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(230, 81, 0, 0.2);
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        margin-bottom: 30px;
    }

    @media (max-width: 900px) {
        .checkout-layout {
            flex-direction: column;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    let cart = [];
    let total = 0;

    document.addEventListener('DOMContentLoaded', async () => {
        cart = JSON.parse(localStorage.getItem('cart') || '[]');
        if (cart.length === 0) {
            alert('Giỏ hàng trống!');
            window.location.href = 'shop.php';
            return;
        }

        window.reRenderCheckout = () => {
            let totalVal = 0;
            const itemsContainer = document.getElementById('checkout-items');
            const selectedItems = cart.filter(i => i.selected !== false);

            itemsContainer.innerHTML = selectedItems.map((item, index) => {
                const sub = item.price * item.quantity;
                totalVal += sub;
                return `
                    <div style="display: flex; gap: 15px; margin-bottom: 25px; align-items: flex-start;">
                        <img src="${item.image}" width="65" height="65" style="border-radius: 12px; object-fit: cover; border: 1.5px solid #eee;">
                        <div style="flex: 1;">
                            <div style="font-weight: 700; font-size: 15px; color: var(--name-color);">${item.name}</div>
                            <div style="font-size: 13px; color: #666; margin-top: 2px;">Số lượng: ${item.quantity} × ${formatPrice(item.price)}</div>
                            <div style="margin-top: 10px;">
                                <small style="display: block; font-size: 11px; font-weight: 600; color: #f0c07d; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px;">Lời chúc cho bánh:</small>
                                <textarea onchange="updateCheckoutGreeting(${index}, this.value)" 
                                    placeholder="Nhập lời chúc..." 
                                    style="width: 100%; height: 50px; padding: 8px; border: 1px dashed #f0c07d; border-radius: 8px; font-size: 12px; background: #fffaf2; resize: none; font-family: inherit; outline: none; transition: 0.3s;">${item.greeting || ''}</textarea>
                            </div>
                        </div>
                        <div style="font-weight: 700; color: var(--price-color); font-size: 15px;">${formatPrice(sub)}</div>
                    </div>
                `;
            }).join('');

            document.getElementById('sub-total').innerText = formatPrice(totalVal);
            document.getElementById('final-total').innerText = formatPrice(totalVal);
            total = totalVal; // Sync global total
        };

        reRenderCheckout();

        // Mặc định lấy từ thông tin tài khoản (Profile)
        const user = await apiFetch('/me');
        if (user) {
            document.getElementById('name').value = user.name || '';
            document.getElementById('email').value = user.email || '';
            document.getElementById('phone').value = user.phone || '';
        }

        // Ưu tiên cực kỳ: Nếu có địa chỉ mặc định trong Sổ địa chỉ thì ghi đè thông tin giao hàng
        const addresses = await apiFetch('/addresses');
        let defaultAddr = null;
        if (addresses && addresses.length > 0) {
            defaultAddr = addresses.find(a => a.is_default);
            if (defaultAddr) {
                // Ghi đè thông tin người nhận theo địa chỉ mặc định
                document.getElementById('name').value = defaultAddr.receiver_name || user.name;
                document.getElementById('phone').value = defaultAddr.receiver_phone || user.phone;
                if (defaultAddr.receiver_email) document.getElementById('email').value = defaultAddr.receiver_email;

                // Điền địa chỉ chi tiết
                document.getElementById('address').value = defaultAddr.detail_address || '';

                // Lưu code để auto-select tỉnh/huyện/xã bên dưới
                localStorage.setItem('user_city_code', defaultAddr.province_code);
                localStorage.setItem('user_district_code', defaultAddr.district_code);
                localStorage.setItem('user_ward_code', defaultAddr.ward_code);
            }
        }

        const savedCityCode = localStorage.getItem('user_city_code');
        const savedDistCode = localStorage.getItem('user_district_code');
        const savedWardCode = localStorage.getItem('user_ward_code');

        const citySelect = document.getElementById('city');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');

        // Fetch Provinces
        const resP = await fetch('https://provinces.open-api.vn/api/p/');
        const provinces = await resP.json();
        provinces.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.code;
            opt.dataset.name = p.name;
            opt.innerText = p.name;
            citySelect.appendChild(opt);
        });

        // Auto-select from Profile
        if (savedCityCode) {
            citySelect.value = savedCityCode;
            const resD = await fetch(`https://provinces.open-api.vn/api/p/${savedCityCode}?depth=2`);
            const dataD = await resD.json();
            dataD.districts.forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.code;
                opt.dataset.name = d.name;
                opt.innerText = d.name;
                districtSelect.appendChild(opt);
            });
            districtSelect.disabled = false;

            if (savedDistCode) {
                districtSelect.value = savedDistCode;
                const resW = await fetch(`https://provinces.open-api.vn/api/d/${savedDistCode}?depth=2`);
                const dataW = await resW.json();
                dataW.wards.forEach(w => {
                    const opt = document.createElement('option');
                    opt.value = w.code;
                    opt.dataset.name = w.name;
                    opt.innerText = w.name;
                    wardSelect.appendChild(opt);
                });
                wardSelect.disabled = false;

                if (savedWardCode) {
                    wardSelect.value = savedWardCode;
                }
            }
        }

        // City Change -> Fetch Districts
        citySelect.addEventListener('change', async (e) => {
            const pCode = e.target.value;
            districtSelect.innerHTML = '<option value="">Chọn quận huyện</option>';
            wardSelect.innerHTML = '<option value="">Chọn xã/phường</option>';
            wardSelect.disabled = true;

            if (pCode) {
                fetch(`https://provinces.open-api.vn/api/p/${pCode}?depth=2`)
                    .then(res => res.json())
                    .then(data => {
                        data.districts.forEach(d => {
                            const opt = document.createElement('option');
                            opt.value = d.code;
                            opt.dataset.name = d.name;
                            opt.innerText = d.name;
                            districtSelect.appendChild(opt);
                        });
                        districtSelect.disabled = false;
                    });
            } else {
                districtSelect.disabled = true;
            }
        });

        // District Change -> Fetch Wards
        districtSelect.addEventListener('change', (e) => {
            const dCode = e.target.value;
            wardSelect.innerHTML = '<option value="">Chọn xã/phường</option>';

            if (dCode) {
                fetch(`https://provinces.open-api.vn/api/d/${dCode}?depth=2`)
                    .then(res => res.json())
                    .then(data => {
                        data.wards.forEach(w => {
                            const opt = document.createElement('option');
                            opt.value = w.code;
                            opt.dataset.name = w.name;
                            opt.innerText = w.name;
                            wardSelect.appendChild(opt);
                        });
                        wardSelect.disabled = false;
                    });
            } else {
                wardSelect.disabled = true;
            }
        });
    });

    window.updateCheckoutGreeting = (index, text) => {
        cart[index].greeting = text;
        localStorage.setItem('cart', JSON.stringify(cart));
        // No need to re-render to avoid losing focus, the text is already there
    };

    async function placeOrder() {
        const token = localStorage.getItem('auth_token');
        if (!token) {
            alert('Vui lòng đăng nhập để thanh toán!');
            window.location.href = 'login.php';
            return;
        }

        // Basic validation
        const fields = ['name', 'phone', 'email', 'city', 'district', 'ward', 'address'];
        for (let f of fields) {
            if (!document.getElementById(f).value) {
                alert('Vui lòng điền đầy đủ các thông tin giao hàng bắt buộc!');
                document.getElementById(f).focus();
                return;
            }
        }

        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;

        if (!email.endsWith('@gmail.com')) {
            alert('Email phải có định dạng @gmail.com');
            return;
        }

        if (!/^0\d{9}$/.test(phone)) {
            alert('Số điện thoại phải bao gồm đúng 10 chữ số và bắt đầu bằng số 0');
            return;
        }

        const cityTxt = document.getElementById('city').options[document.getElementById('city').selectedIndex].dataset.name;
        const distTxt = document.getElementById('district').options[document.getElementById('district').selectedIndex].dataset.name;
        const wardTxt = document.getElementById('ward').options[document.getElementById('ward').selectedIndex].dataset.name;
        const fullAddress = `${document.getElementById('address').value}, ${wardTxt}, ${distTxt}, ${cityTxt}`;

        const btn = document.getElementById('btn-submit');
        btn.disabled = true;
        btn.innerText = 'Đang xử lý...';

        const d = document.getElementById('deliv-day-sel').value;
        const m = document.getElementById('deliv-month-sel').value;
        const y = document.getElementById('deliv-year-sel').value;
        const delivDate = (d && m && y) ? `${y}-${m.padStart(2, '0')}-${d.padStart(2, '0')}` : null;

        const orderData = {
            customer_name: document.getElementById('name').value,
            customer_phone: document.getElementById('phone').value,
            customer_email: document.getElementById('email').value,
            customer_address: fullAddress,
            delivery_date: delivDate,
            delivery_time: document.getElementById('deliv-time').value,
            note: document.getElementById('note').value,
            total_amount: total,
            payment_method: document.querySelector('input[name="payment"]:checked').value,
            items: cart.filter(i => i.selected !== false).map(i => ({
                id: i.id,
                quantity: i.quantity,
                price: i.price,
                name: i.name,
                greeting: i.greeting || ''
            }))
        };

        try {
            const response = await apiFetch('/orders', {
                method: 'POST',
                body: JSON.stringify(orderData)
            });

            if (response.order && response.order.id) {
                const orderId = response.order.id;
                
                if (orderData.payment_method === 'bank') {
                    // Update QR with Order ID for SePay tracking
                    const amount = orderData.total_amount;
                    const addInfo = `LPS${orderId}`;
                    const accountName = 'PHAN HUNG THINH';
                    document.getElementById('web-qr-code').src = `https://api.vietqr.io/image/970422-100012113979-compact2.jpg?amount=${amount}&addInfo=${addInfo}&accountName=${accountName}`;
                    document.getElementById('bank-payment-modal').style.display = 'flex';
                    
                    window.currentCheckoutOrderId = orderId;
                    startPaymentPolling(orderId);
                    
                    btn.disabled = false;
                    btn.innerText = 'XÁC NHẬN ĐẶT HÀNG';
                    return;
                }

                // COD success
                localStorage.setItem('cart', JSON.stringify(cart.filter(i => i.selected === false)));
                if (window.pushCartToBackend) await window.pushCartToBackend();
                alert('Đặt hàng thành công! Cảm ơn bạn đã ủng hộ tiệm bánh.');
                window.location.href = 'profile.php?tab=orders';
            } else {
                throw new Error('Order failed');
            }
        } catch (err) {
            alert('Có lỗi xảy ra khi đặt hàng, vui lòng thử lại!');
            btn.disabled = false;
            btn.innerText = 'XÁC NHẬN ĐẶT HÀNG';
        }
    }

    let pollingInterval = null;
    function startPaymentPolling(orderId) {
        if (pollingInterval) clearInterval(pollingInterval);
        
        pollingInterval = setInterval(async () => {
            try {
                const res = await apiFetch(`/orders/${orderId}/payment-status`);
                if (res && res.payment_status === 'paid') {
                    clearInterval(pollingInterval);
                    handlePaymentSuccess();
                }
            } catch (e) {
                console.error('Polling error:', e);
            }
        }, 3000); // Check every 3 seconds
    }

    async function handlePaymentSuccess() {
        // Clear cart
        localStorage.setItem('cart', JSON.stringify(cart.filter(i => i.selected === false)));
        if (window.pushCartToBackend) await window.pushCartToBackend();
        
        alert('Thanh toán thành công! Đơn hàng của bạn đã được xác nhận.');
        window.location.href = 'profile.php?tab=orders';
    }

    async function confirmBankTransferWeb() {
        const orderId = window.currentCheckoutOrderId;
        const btn = document.querySelector('#bank-payment-modal button');
        btn.disabled = true;
        btn.innerText = 'Đang kiểm tra...';

        try {
            const res = await apiFetch(`/orders/${orderId}/payment-status`);
            if (res && res.payment_status === 'paid') {
                if (pollingInterval) clearInterval(pollingInterval);
                handlePaymentSuccess();
            } else {
                alert('Hệ thống chưa nhận được thanh toán. V vui lòng chờ hoặc thử lại sau vài giây!');
                btn.disabled = false;
                btn.innerText = 'TÔI ĐÃ CHUYỂN TIỀN';
            }
        } catch (err) {
            alert('Có lỗi xảy ra, vui lòng thử lại!');
            btn.disabled = false;
            btn.innerText = 'TÔI ĐÃ CHUYỂN TIỀN';
        }
    }
</script>

<?php include 'includes/footer.php'; ?>