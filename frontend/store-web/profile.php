<?php
$pageTitle = "Tài khoản";
include 'includes/header.php';
?>
<h1 class="cart-title"
    style="margin-top: 20px; font-family: 'Playfair Display', serif; text-align: left; max-width: 1200px; margin-inline: auto; padding: 0 20px;">
    Tài khoản khách hàng</h1>
<div class="profile-layout">
    <div class="profile-sidebar">
        <div class="avatar-container" style="background: #fef0e4;">
            <img src="https://ui-avatars.com/api/?name=User&background=ffd699&color=4a3b32" class="avatar-img"
                id="user-avatar">
            <div class="avatar-edit"><i class="fas fa-camera"></i></div>
        </div>
        <h3 id="display-name" style="color: #001f3f;">Username</h3>
        <p id="display-email" style="color: #8c7e73;">email@example.com</p>
        <div class="sidebar-menu">
            <a href="javascript:void(0)" onclick="switchTab('orders')" id="menu-orders" class="sidebar-item active"><i
                    class="fas fa-box"></i> Đơn hàng</a>
            <a href="javascript:void(0)" onclick="switchTab('account')" id="menu-account" class="sidebar-item"><i
                    class="fas fa-user-circle"></i> Tài khoản</a>
            <a href="javascript:void(0)" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Sổ địa chỉ</a>
            <a href="javascript:void(0)" id="logout-btn-profile" class="sidebar-item" style="color: #e53e3e;"><i
                    class="fas fa-sign-out-alt"></i> Đăng xuất</a>
        </div>
    </div>
    <div class="profile-content">
        <!-- Orders Tab -->
        <div id="orders-section" class="tab-pane active">
            <div id="orders-list">
                <div class="empty-msg">
                    <p>! &nbsp;&nbsp; Bạn chưa có đơn hàng nào.</p><a href="shop.php" class="btn-empty"
                        style="padding: 10px 20px;">Duyệt sản phẩm</a>
                </div>
            </div>
        </div>

        <!-- Account Tab -->
        <div id="account-section" class="tab-pane">
            <h2 class="form-section-title">Thông tin tài khoản</h2>
            <div class="info-grid">
                <div class="form-group">
                    <label>Tên <span class="required">*</span></label>
                    <input type="text" id="full-name" value="Hùng Thịnh">
                </div>
                <div class="form-group">
                    <label>Tên hiển thị <span class="required">*</span></label>
                    <input type="text" id="user-display-name" value="thinh123">
                </div>
                <div class="form-group">
                    <label>Địa chỉ email <span class="required">*</span></label>
                    <input type="email" id="user-email" value="phanhungthinh0123@gmail.com">
                </div>
                <div class="form-group">
                    <label>Số điện thoại <span class="required">*</span></label>
                    <input type="text" id="user-phone" value="0965050142">
                </div>
            </div>

            <h2 class="form-section-title" style="margin-top: 50px;">Thông tin Giao hàng</h2>
            <div class="info-grid">
                <div class="form-group">
                    <label>Tỉnh/Thành phố <span class="required">*</span></label>
                    <select id="city">
                        <option value="">Chọn tỉnh thành</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quận/Huyện <span class="required">*</span></label>
                    <select id="district" disabled>
                        <option value="">Chọn quận huyện</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Xã/Phường <span class="required">*</span></label>
                    <select id="ward" disabled>
                        <option value="">Chọn xã/phường</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Địa chỉ <span class="required">*</span></label>
                    <input type="text" id="address" placeholder="Ví dụ: Số 20, ngõ 90">
                </div>
            </div>

            <h2 class="form-section-title" style="margin-top: 50px;">Thay đổi mật khẩu</h2>
            <div class="password-group">
                <div class="form-group">
                    <label>Mật khẩu hiện tại (bỏ trống nếu không đổi)</label>
                    <div class="pass-wrapper">
                        <input type="password" id="cur-pass">
                        <i class="far fa-eye-slash toggle-pass" onclick="togglePass('cur-pass', this)"></i>
                    </div>
                </div>
                <div class="form-grid-pass">
                    <div class="form-group">
                        <label>Mật khẩu mới (bỏ trống nếu không đổi)</label>
                        <div class="pass-wrapper">
                            <input type="password" id="new-pass">
                            <i class="far fa-eye-slash toggle-pass" onclick="togglePass('new-pass', this)"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Xác nhận mật khẩu mới</label>
                        <div class="pass-wrapper">
                            <input type="password" id="cfm-pass">
                            <i class="far fa-eye-slash toggle-pass" onclick="togglePass('cfm-pass', this)"></i>
                        </div>
                    </div>
                </div>
            </div>

            <button id="btn-save-profile" onclick="saveProfile()" class="btn-save-profile">Lưu thay đổi</button>
        </div>
    </div>
</div>

<style>
    .profile-layout {
        display: flex;
        gap: 40px;
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
    }

    .profile-sidebar {
        flex: 1;
        background: #fff;
        padding: 40px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        height: fit-content;
        text-align: center;
    }

    .profile-content {
        flex: 3;
        background: #fff;
        padding: 50px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        min-height: 600px;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        color: #001f3f;
        margin-bottom: 30px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .form-grid-pass {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-top: 10px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 25px;
    }

    .form-group label {
        font-size: 15px;
        font-weight: 500;
        color: #001f3f;
    }

    .form-group input,
    .form-group select {
        padding: 16px 20px;
        border: 1.5px solid #001f3f;
        border-radius: 12px;
        font-size: 16px;
        font-family: 'Outfit', sans-serif;
        transition: 0.3s;
        width: 100%;
        box-sizing: border-box;
        background-color: #fff;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(0, 31, 63, 0.05);
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

    .pass-wrapper {
        position: relative;
        width: 100%;
    }

    .pass-wrapper input {
        width: 100%;
        padding-right: 50px;
    }

    .toggle-pass {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #001f3f;
        opacity: 0.6;
        z-index: 10;
        padding: 5px;
    }

    .toggle-pass:hover {
        opacity: 1;
    }

    .btn-save-profile {
        margin-top: 20px;
        background: #ffcc80;
        color: #001f3f;
        border: none;
        padding: 18px 50px;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-save-profile:hover {
        background: #ffb74d;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 183, 77, 0.3);
    }

    .required {
        color: #e53e3e;
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 20px;
        border-radius: 12px;
        color: #666;
        text-decoration: none;
        transition: 0.3s;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .sidebar-item.active {
        background: #fef0e4;
        color: #001f3f;
        font-weight: 700;
    }

    .sidebar-item:hover:not(.active) {
        background: #f8f9fa;
        color: #001f3f;
    }
</style>

<script>
    async function loadOrders() {
        const list = document.querySelector('#orders-section .orders-list');
        try {
            const orders = await apiFetch('/orders');
            if (!orders || orders.length === 0) {
                list.innerHTML = `
                        <div style="text-align: center; padding: 40px; color: #666; background: #fffaf5; border-radius: 20px;">
                            <i class="fas fa-shopping-basket" style="font-size: 50px; margin-bottom: 20px; opacity: 0.3;"></i>
                            <p style="font-size: 16px;">Bạn chưa có đơn hàng nào.</p>
                            <a href="shop.php" class="sidebar-item active" style="display: inline-block; margin-top: 15px; width: auto; padding: 10px 25px;">MUA BÁNH NGAY</a>
                        </div>
                    `;
                return;
            }

            list.innerHTML = orders.map(order => {
                const date = new Date(order.created_at).toLocaleDateString('vi-VN');
                let statusColor = '#f39c12'; // Amber
                let statusText = 'Chờ xử lý';

                if (order.status === 'processing') { statusColor = '#3498db'; statusText = 'Đang làm bánh'; }
                else if (order.status === 'shipped') { statusColor = '#9b59b6'; statusText = 'Đang giao hàng'; }
                else if (order.status === 'delivered') { statusColor = '#2ecc71'; statusText = 'Hoàn tất'; }
                else if (order.status === 'cancelled') { statusColor = '#e74c3c'; statusText = 'Đã hủy'; }

                return `
                        <div class="order-card" style="background: #fff; border: 1.5px solid #001f3f15; border-radius: 20px; padding: 25px; margin-bottom: 20px; transition: 0.3s; cursor: pointer;" onmouseover="this.style.borderColor='${statusColor}'" onmouseout="this.style.borderColor='#001f3f15'">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <span style="font-weight: 800; color: #001f3f; font-size: 18px;">MÃ ĐƠN #${order.id}</span>
                                <span style="background: ${statusColor}15; color: ${statusColor}; padding: 6px 15px; border-radius: 12px; font-size: 13px; font-weight: 700;">${statusText}</span>
                            </div>
                            <div style="display: flex; gap: 30px; font-size: 14px; color: #666;">
                                <div><i class="far fa-calendar-alt"></i> Ngày đặt: ${date}</div>
                                <div><i class="far fa-credit-card"></i> Thanh toán: ${order.total_amount.toLocaleString()} đ</div>
                            </div>
                            <div style="margin-top: 15px; padding-top: 15px; border-top: 1px dashed #eee; display: flex; justify-content: space-between; align-items: center;">
                                <div style="font-size: 13px; color: #888;">Giao đến: ${order.customer_address.substring(0, 40)}${order.customer_address.length > 40 ? '...' : ''}</div>
                                <a href="#" style="color: #001f3f; font-weight: 700; text-decoration: none; font-size: 13px;">CHI TIẾT <i class="fas fa-chevron-right" style="font-size: 10px;"></i></a>
                            </div>
                        </div>
                    `;
            }).join('');
        } catch (err) {
            list.innerHTML = `<p style="color: red;">Không thể tải đơn hàng: ${err.message}</p>`;
        }
    }

    function switchTab(tab) {
        // Sections
        document.getElementById('orders-section').classList.remove('active');
        document.getElementById('account-section').classList.remove('active');
        document.getElementById(tab + '-section').classList.add('active');

        // Menu Items
        document.getElementById('menu-orders').classList.remove('active');
        document.getElementById('menu-account').classList.remove('active');
        document.getElementById('menu-' + tab).classList.add('active');

        if (tab === 'orders') loadOrders();
    }

    function togglePass(id, icon) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'far fa-eye toggle-pass';
        } else {
            input.type = 'password';
            icon.className = 'far fa-eye-slash toggle-pass';
        }
    }

    async function saveProfile() {
        const btn = document.getElementById('btn-save-profile');
        const originalText = btn.innerText;
        btn.innerText = 'Đang lưu...';
        btn.disabled = true;

        try {
            const citySelect = document.getElementById('city');
            const districtSelect = document.getElementById('district');
            const wardSelect = document.getElementById('ward');

            // Get data
            const name = document.getElementById('full-name').value;
            const email = document.getElementById('user-email').value;
            const phone = document.getElementById('user-phone').value;
            const addr = document.getElementById('address').value;

            const cityIdx = citySelect.selectedIndex;
            const distIdx = districtSelect.selectedIndex;
            const wardIdx = wardSelect.selectedIndex;

            const cityCode = citySelect.value;
            const distCode = districtSelect.value;
            const wardCode = wardSelect.value;

            const cityTxt = cityIdx > 0 ? citySelect.options[cityIdx].dataset.name : '';
            const distTxt = distIdx > 0 ? districtSelect.options[distIdx].dataset.name : '';
            const wardTxt = wardIdx > 0 ? wardSelect.options[wardIdx].dataset.name : '';

            // Save to localStorage (Local Persistence)
            localStorage.setItem('user_name', name);
            localStorage.setItem('user_email', email);
            localStorage.setItem('user_phone', phone);
            localStorage.setItem('user_address', addr);
            localStorage.setItem('user_city', cityTxt);
            localStorage.setItem('user_city_code', cityCode);
            localStorage.setItem('user_district', distTxt);
            localStorage.setItem('user_district_code', distCode);
            localStorage.setItem('user_ward', wardTxt);
            localStorage.setItem('user_ward_code', wardCode);

            // Update UI Sidebar
            document.getElementById('display-name').innerText = name;
            document.getElementById('display-email').innerText = email;
            document.getElementById('user-avatar').src = `https://ui-avatars.com/api/?name=${name}&background=ffd699&color=4a3b32`;

            // Update Header (if exists)
            const headerName = document.getElementById('user-name-header');
            if (headerName) headerName.innerText = name;

            alert('Cập nhật thông tin thành công!');
        } catch (err) {
            console.error(err);
            alert('Có lỗi xảy ra: ' + err.message);
        } finally {
            btn.innerText = originalText;
            btn.disabled = false;
        }
    }

    document.addEventListener('DOMContentLoaded', async () => {
        const name = localStorage.getItem('user_name') || 'Khách';
        const email = localStorage.getItem('user_email') || 'Chưa cập nhật';
        const phone = localStorage.getItem('user_phone') || '';
        const addr = localStorage.getItem('user_address') || '';

        const savedCityCode = localStorage.getItem('user_city_code');
        const savedDistCode = localStorage.getItem('user_district_code');
        const savedWardCode = localStorage.getItem('user_ward_code');

        // Sidebar Display
        document.getElementById('display-name').innerText = name;
        document.getElementById('display-email').innerText = email;
        document.getElementById('user-avatar').src = `https://ui-avatars.com/api/?name=${name}&background=ffd699&color=4a3b32`;

        // Form Populate
        document.getElementById('full-name').value = name;
        document.getElementById('user-display-name').value = name;
        document.getElementById('user-email').value = email;
        document.getElementById('user-phone').value = phone;
        document.getElementById('address').value = addr;

        // --- Address API Logic (Profile) ---
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

        // Re-select City
        if (savedCityCode) {
            citySelect.value = savedCityCode;
            // Fetch Districts
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

            // Re-select District
            if (savedDistCode) {
                districtSelect.value = savedDistCode;
                // Fetch Wards
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

                // Re-select Ward
                if (savedWardCode) {
                    wardSelect.value = savedWardCode;
                }
            }
        }

        // City Change
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

        // District Change
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

        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const count = document.getElementById('cart-count');
        if (count) count.innerText = cart.length;

        const response = await apiFetch('/orders');
        if (response && response.length > 0) {
            const list = document.getElementById('orders-list');
            list.innerHTML = `
                    <h2 style="margin-bottom: 30px; font-family: 'Playfair Display', serif; font-size: 32px; color: #001f3f;">Lịch sử đơn hàng</h2>
                    <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                        <thead><tr style="background: #fdf5ec;">
                            <th style="padding: 18px; text-align: left; border-bottom: 2px solid #f0c07d; font-family: 'Playfair Display', serif;">Mã ĐH</th>
                            <th style="padding: 18px; text-align: left; border-bottom: 2px solid #f0c07d; font-family: 'Playfair Display', serif;">Ngày đặt</th>
                            <th style="padding: 18px; text-align: left; border-bottom: 2px solid #f0c07d; font-family: 'Playfair Display', serif;">Tổng tiền</th>
                            <th style="padding: 18px; text-align: left; border-bottom: 2px solid #f0c07d; font-family: 'Playfair Display', serif;">Trạng thái</th>
                        </tr></thead>
                        <tbody>${response.map(o => `
                            <tr>
                                <td style="padding: 18px; border-bottom: 1px solid #eee; font-weight: 600; color: #001f3f;">#${o.id}</td>
                                <td style="padding: 18px; border-bottom: 1px solid #eee; color: #666;">${new Date(o.created_at).toLocaleDateString('vi-VN')}</td>
                                <td style="padding: 18px; border-bottom: 1px solid #eee; font-weight: 700; color: var(--primary);">${formatPrice(o.total_amount)}</td>
                                <td style="padding: 18px; border-bottom: 1px solid #eee;"><span style="padding: 6px 14px; border-radius: 20px; background: #e2f2e5; color: #2d6a4f; font-size: 13px; font-weight: 600;">${o.status}</span></td>
                            </tr>
                        `).join('')}</tbody>
                    </table>
                    </div>
                `;
        }

        document.getElementById('logout-btn-profile').onclick = (e) => {
            e.preventDefault();
            localStorage.clear();
            window.location.href = 'index.php';
        };
        // ... existing listeners ...
        await loadOrders();
    });
</script>
<?php include 'includes/footer.php'; ?>