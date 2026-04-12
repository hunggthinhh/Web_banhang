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
            <div style="position: relative; cursor: pointer;" onclick="document.getElementById('avatar-input').click()">
                <img id="user-avatar" src="https://ui-avatars.com/api/?name=User&background=ffd699&color=4a3b32"
                    alt="Avatar"
                    style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div
                    style="position: absolute; bottom: 5px; right: 5px; background: var(--primary); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; border: 3px solid white;">
                    <i class="fas fa-camera"></i>
                </div>
                <input type="file" id="avatar-input" style="display: none;" accept="image/*" onchange="uploadAvatar(this)">
            </div>
        </div>
        <h3 id="display-name" style="color: #001f3f;">Username</h3>
        <p id="display-email" style="color: #8c7e73;">email@example.com</p>
        <div class="sidebar-menu">
            <a href="javascript:void(0)" onclick="switchTab('orders')" id="menu-orders" class="sidebar-item active"><i
                    class="fas fa-box"></i> Đơn hàng</a>
            <a href="javascript:void(0)" onclick="switchTab('account')" id="menu-account" class="sidebar-item"><i
                    class="fas fa-user-circle"></i> Tài khoản</a>
            <a href="javascript:void(0)" onclick="switchTab('address')" id="menu-address" class="sidebar-item"><i
                    class="fas fa-map-marker-alt"></i> Sổ địa chỉ</a>
            <a href="javascript:void(0)" id="logout-btn-profile" class="sidebar-item" style="color: #e53e3e;"><i
                    class="fas fa-sign-out-alt"></i> Đăng xuất</a>
        </div>
    </div>
    <div class="profile-content">
        <!-- Orders Tab -->
        <div id="orders-section" class="tab-pane active">
            <h2 class="form-section-title">Lịch sử đơn hàng</h2>
            <div id="orders-list">
                <!-- Loaded via JS -->
            </div>
        </div>

        <!-- Account Tab -->
        <div id="account-section" class="tab-pane">
            <h2 class="form-section-title">Thông tin tài khoản</h2>
            <div class="info-grid">
                <div class="form-group">
                    <label>Tên <span class="required">*</span></label>
                    <input type="text" id="full-name" placeholder="Họ và tên">
                </div>
                <div class="form-group">
                    <label>Tên hiển thị <span class="required">*</span></label>
                    <input type="text" id="user-display-name" placeholder="Tên hiển thị">
                </div>
                <div class="form-group">
                    <label>Địa chỉ email <span class="required">*</span></label>
                    <input type="email" id="user-email" placeholder="email@example.com">
                </div>
                <div class="form-group">
                    <label>Số điện thoại <span class="required">*</span></label>
                    <input type="text" id="user-phone" placeholder="09xxxxxxx">
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

        <!-- Address Tab -->
        <div id="address-section" class="tab-pane">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h2 class="form-section-title" style="margin-bottom: 0;">Sổ địa chỉ</h2>
                <button onclick="openAddressModal()" class="btn-save-profile" style="margin: 0; padding: 10px 20px; font-size: 14px; background: #001f3f; color: white;">+ Thêm địa chỉ mới</button>
            </div>
            
            <div id="address-list" style="display: grid; gap: 20px;">
                <!-- Addresses will be loaded here -->
            </div>
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

    /* Status Badges */
    .status-badge {
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pending { background: rgba(255, 193, 7, 0.15) !important; color: #856404 !important; }
    .status-processing { background: rgba(0, 123, 255, 0.15) !important; color: #004085 !important; }
    .status-shipped { background: rgba(111, 66, 193, 0.15) !important; color: #4a148c !important; }
    .status-delivered { background: rgba(40, 167, 69, 0.15) !important; color: #155724 !important; }
    .status-cancelled { background: rgba(220, 53, 69, 0.15) !important; color: #721c24 !important; }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 3000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 30px;
        border-radius: 20px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        position: relative;
    }

    .close {
        position: absolute;
        right: 20px;
        top: 15px;
        font-size: 24px;
        cursor: pointer;
        color: #666;
    }
</style>

<div id="orderDetailModal" class="modal">
    <div class="modal-content" style="max-width: 600px;">
        <span class="close" onclick="closeOrderModal()">&times;</span>
        <h2 class="form-section-title" style="font-size: 24px; margin-bottom: 20px;">Chi tiết đơn hàng</h2>
        <div id="order-detail-content"></div>
    </div>
</div>

<!-- Address Form Modal -->
<div id="addressModal" class="modal">
    <div class="modal-content" style="max-width: 800px; padding: 40px;">
        <span class="close" onclick="closeAddressModal()">&times;</span>
        <h2 class="form-section-title" id="address-modal-title" style="font-family: 'Playfair Display', serif; font-size: 28px; margin-bottom: 30px;">Thêm địa chỉ mới</h2>
        <input type="hidden" id="edit-address-id">
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label style="font-weight: 600; color: #001f3f;">Tên gợi nhớ (VD: Nhà riêng, Công ty)</label>
                <input type="text" id="addr-alias" placeholder="Nhà riêng, Công ty..." style="border: 1px solid #ddd; padding: 12px;">
            </div>
            <div class="form-group">
                <label style="font-weight: 600; color: #001f3f;">Họ và tên người nhận</label>
                <input type="text" id="addr-name" placeholder="Nhập họ và tên" style="border: 1px solid #ddd; padding: 12px;">
            </div>
        </div>

        <div class="form-group">
            <label style="font-weight: 600; color: #001f3f;">Địa chỉ chi tiết (Số nhà, tên đường)</label>
            <input type="text" id="addr-detail" placeholder="Ví dụ: 123 Đường ABC..." style="border: 1px solid #ddd; padding: 12px;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
            <div class="form-group">
                <label style="font-weight: 600; color: #001f3f;">Tỉnh/Thành phố</label>
                <select id="addr-city" style="border: 1px solid #ddd; padding: 12px;"></select>
            </div>
            <div class="form-group">
                <label style="font-weight: 600; color: #001f3f;">Quận/Huyện</label>
                <select id="addr-district" disabled style="border: 1px solid #ddd; padding: 12px;"></select>
            </div>
            <div class="form-group">
                <label style="font-weight: 600; color: #001f3f;">Phường/Xã</label>
                <select id="addr-ward" disabled style="border: 1px solid #ddd; padding: 12px;"></select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label style="font-weight: 600; color: #001f3f;">Số điện thoại người nhận</label>
                <input type="text" id="addr-phone" placeholder="Nhập số điện thoại" style="border: 1px solid #ddd; padding: 12px;">
            </div>
            <div class="form-group">
                <label style="font-weight: 600; color: #001f3f;">Email người nhận</label>
                <input type="email" id="addr-email" placeholder="Nhập địa chỉ email" style="border: 1px solid #ddd; padding: 12px;">
            </div>
        </div>

        <div style="margin-top: 30px; display: flex; justify-content: center; gap: 15px;">
            <button onclick="closeAddressModal()" class="btn-save-profile" style="background: #eee; color: #333; padding: 12px 40px;">Hủy</button>
            <button onclick="saveAddress()" class="btn-save-profile" style="background: var(--primary); color: white; padding: 12px 40px;">Lưu địa chỉ</button>
        </div>
    </div>
</div>

<script>
    async function loadOrders() {
        const list = document.getElementById('orders-list');
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

            const statusLabels = {
                'pending': 'Chờ xử lý',
                'processing': 'Đang làm bánh',
                'shipped': 'Đang giao hàng',
                'delivered': 'Hoàn tất',
                'cancelled': 'Đã hủy'
            };

            list.innerHTML = `
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                        <thead>
                            <tr style="background: #fdf5ec;">
                                <th style="padding: 18px; text-align: left; border-bottom: 2px solid #f0c07d; font-family: 'Playfair Display', serif;">Mã ĐH</th>
                                <th style="padding: 18px; text-align: left; border-bottom: 2px solid #f0c07d; font-family: 'Playfair Display', serif;">Ngày đặt</th>
                                <th style="padding: 18px; text-align: left; border-bottom: 2px solid #f0c07d; font-family: 'Playfair Display', serif;">Tổng tiền</th>
                                <th style="padding: 18px; text-align: left; border-bottom: 2px solid #f0c07d; font-family: 'Playfair Display', serif;">Trạng thái</th>
                                <th style="padding: 18px; text-align: left; border-bottom: 2px solid #f0c07d; font-family: 'Playfair Display', serif;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${orders.map(o => `
                                <tr>
                                    <td style="padding: 18px; border-bottom: 1px solid #eee; font-weight: 600; color: #001f3f;">#${o.id}</td>
                                    <td style="padding: 18px; border-bottom: 1px solid #eee; color: #666;">${new Date(o.created_at).toLocaleDateString('vi-VN')}</td>
                                    <td style="padding: 18px; border-bottom: 1px solid #eee; font-weight: 700; color: var(--primary);">${formatPrice(o.total_amount)}</td>
                                    <td style="padding: 18px; border-bottom: 1px solid #eee;">
                                        <span class="status-badge status-${o.status}">${statusLabels[o.status] || o.status}</span>
                                    </td>
                                    <td style="padding: 18px; border-bottom: 1px solid #eee;">
                                        <button class="btn-save-profile" style="padding: 8px 15px; font-size: 13px; margin: 0;" onclick="viewOrderDetail(${o.id})">Chi tiết</button>
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            `;
        } catch (err) {
            list.innerHTML = `<p style="color: red;">Không thể tải đơn hàng: ${err.message}</p>`;
        }
    }

    async function viewOrderDetail(id) {
        try {
            const orders = await apiFetch('/orders');
            const o = orders.find(x => x.id == id);
            if (!o) return;

            const statusLabels = {
                'pending': 'Chờ xử lý',
                'processing': 'Đang làm bánh',
                'shipped': 'Đang giao hàng',
                'delivered': 'Hoàn tất',
                'cancelled': 'Đã hủy'
            };

            const content = document.getElementById('order-detail-content');
            
            let itemsHtml = o.items.map(item => {
                const img = (item.product && item.product.image) ? item.product.image : 'https://via.placeholder.com/50';
                return `
                    <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <img src="${img}" style="width: 60px; height: 60px; border-radius: 12px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <div>
                                <div style="font-weight: 700; color: #001f3f; font-size: 15px;">${item.product_name}</div>
                                <div style="font-size: 13px; color: #888;">Số lượng: ${item.quantity} x ${formatPrice(item.price)}</div>
                            </div>
                        </div>
                        <div style="font-weight: 8c7e73; color: var(--primary); align-self: center;">${formatPrice(item.price * item.quantity)}</div>
                    </div>
                `;
            }).join('');

            content.innerHTML = `
                <div style="margin-bottom: 20px; font-size: 14px; line-height: 1.6;">
                    <p><strong>Ngày đặt:</strong> ${new Date(o.created_at).toLocaleString('vi-VN')}</p>
                    <p><strong>Trạng thái:</strong> <span class="status-badge status-${o.status}">${statusLabels[o.status] || o.status}</span></p>
                    <p><strong>Địa chỉ giao:</strong> ${o.customer_address}</p>
                </div>
                <div style="margin-top: 20px;">
                    <h4 style="margin-bottom: 10px; color: #001f3f; border-bottom: 2px solid #ddd; padding-bottom: 5px;">Sản phẩm đã mua</h4>
                    ${itemsHtml}
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 25px; padding-top: 15px; border-top: 2px solid #f0c07d; font-weight: 800; font-size: 20px; color: #001f3f;">
                    <span>TỔNG CỘNG:</span>
                    <span>${formatPrice(o.total_amount)}</span>
                </div>
            `;
            document.getElementById('orderDetailModal').style.display = 'flex';
        } catch (err) {
            alert('Lỗi khi tải chi tiết: ' + err.message);
        }
    }

    function closeOrderModal() {
        document.getElementById('orderDetailModal').style.display = 'none';
    }

    function switchTab(tab) {
        // Sections
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('active'));
        document.getElementById(tab + '-section').classList.add('active');

        // Menu Items
        document.querySelectorAll('.sidebar-item').forEach(el => el.classList.remove('active'));
        document.getElementById('menu-' + (tab === 'address' ? 'address' : tab)).classList.add('active');

        if (tab === 'orders') loadOrders();
        if (tab === 'address') loadAddresses();
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

    async function uploadAvatar(input) {
        if (!input.files || !input.files[0]) return;

        const formData = new FormData();
        formData.append('image', input.files[0]);
        formData.append('name', document.getElementById('full-name').value);
        formData.append('email', document.getElementById('user-email').value);

        const res = await apiFetch('/profile', {
            method: 'POST',
            body: formData
        });

        if (res) {
            const baseUrl = window.location.origin + '/Web_banhang/backend/public/';
            const newAvatar = res.user.image.startsWith('http') ? res.user.image : baseUrl + res.user.image;
            document.getElementById('user-avatar').src = newAvatar;
            alert('Cập nhật ảnh đại diện thành công!');
        }
    }

    async function saveProfile() {
        const btn = document.getElementById('btn-save-profile');
        const originalText = btn.innerText;
        btn.innerText = 'Đang lưu...';
        btn.disabled = true;

        try {
            // Get data
            const name = document.getElementById('full-name').value;
            const email = document.getElementById('user-email').value;
            const phone = document.getElementById('user-phone').value;

            if (!email.endsWith('@gmail.com')) {
                alert('Email phải có định dạng @gmail.com');
                btn.innerText = originalText;
                btn.disabled = false;
                return;
            }

            if (!/^0\d{9}$/.test(phone)) {
                alert('Số điện thoại phải bao gồm đúng 10 chữ số và bắt đầu bằng số 0');
                btn.innerText = originalText;
                btn.disabled = false;
                return;
            }

            let payload = {
                name: name,
                email: email,
                phone: phone
            };

            const newPass = document.getElementById('new-pass').value;
            const cfmPass = document.getElementById('cfm-pass').value;
            if (newPass) {
                if (newPass !== cfmPass) {
                    alert('Mật khẩu mới không trùng khớp!');
                    btn.innerText = originalText;
                    btn.disabled = false;
                    return;
                }
                payload.password = newPass;
                payload.password_confirmation = cfmPass;
            }

            const response = await apiFetch('/profile', {
                method: 'POST',
                body: JSON.stringify(payload)
            });

            if (response && response.user) {
                const user = response.user;
                // Update Sidebar
                document.getElementById('display-name').innerText = user.name;
                document.getElementById('display-email').innerText = user.email;
                document.getElementById('user-avatar').src = `https://ui-avatars.com/api/?name=${user.name}&background=ffd699&color=4a3b32`;

                // Update Header
                const headerName = document.querySelector('.nav-btn-user');
                if (headerName) headerName.innerText = user.name;

                alert('Cập nhật thông tin thành công!');
            }
        } catch (err) {
            console.error(err);
            alert('Có lỗi xảy ra: ' + err.message);
        } finally {
            btn.innerText = originalText;
            btn.disabled = false;
        }
    }

    async function loadAddresses() {
        const list = document.getElementById('address-list');
        try {
            const addresses = await apiFetch('/addresses');
            if (!addresses) return;

            list.innerHTML = addresses.map(addr => `
                <div style="background: #fff; border-radius: 16px; padding: 25px; border: 1px solid #eee; display: flex; justify-content: space-between; align-items: flex-start; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.02); margin-bottom: 20px;">
                    <div style="flex: 1;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                            <span style="font-weight: 800; color: #001f3f; font-size: 18px; text-transform: uppercase;">${addr.alias || 'Địa chỉ'}</span>
                            ${addr.is_default ? '<span style="background: #e3f2fd; color: #1976d2; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; border: 1px solid #bbdefb;">Mặc định</span>' : ''}
                        </div>
                        <div style="margin-bottom: 15px;">
                            <span style="font-weight: 600; color: #333; font-size: 16px; display: block; margin-bottom: 5px;">${addr.receiver_name}</span>
                            <span style="color: #666; font-size: 14px;">${addr.receiver_phone} | ${addr.receiver_email || ''}</span>
                        </div>
                        <div style="color: #555; font-size: 15px; line-height: 1.5;">
                            ${addr.detail_address}, ${addr.ward}, ${addr.district}, ${addr.province}
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 8px; min-width: 140px; margin-left: 20px;">
                        <button onclick="editAddress(${addr.id})" style="background: #fff; color: #001f3f; border: 1.5px solid #001f3f; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.background='#f0f0f0'" onmouseout="this.style.background='#fff'">Sửa</button>
                        <button onclick="deleteAddress(${addr.id})" style="background: #fff; color: #d32f2f; border: 1.5px solid #d32f2f; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.background='#ffebee'" onmouseout="this.style.background='#fff'">Xóa</button>
                        ${!addr.is_default ? `<button onclick="setDefault(${addr.id})" style="background: #ffd699; color: #001f3f; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-weight: 800; font-size: 12px; margin-top: 5px;">Đặt làm mặc định</button>` : ''}
                    </div>
                </div>
            `).join('');
        } catch (err) {
            console.error(err);
        }
    }

    let allAddresses = [];
    function openAddressModal(id = null) {
        document.getElementById('edit-address-id').value = id || '';
        document.getElementById('address-modal-title').innerText = id ? 'Chỉnh sửa địa chỉ' : 'Thêm địa chỉ mới';
        
        if (!id) {
            document.getElementById('addr-alias').value = '';
            document.getElementById('addr-name').value = '';
            document.getElementById('addr-phone').value = '';
            document.getElementById('addr-email').value = '';
            document.getElementById('addr-detail').value = '';
        }
        
        document.getElementById('addressModal').style.display = 'flex';
    }

    function closeAddressModal() {
        document.getElementById('addressModal').style.display = 'none';
    }

    async function saveAddress() {
        const id = document.getElementById('edit-address-id').value;
        const phone = document.getElementById('addr-phone').value;
        if (!/^0\d{9}$/.test(phone)) {
            alert('Số điện thoại người nhận phải bao gồm đúng 10 chữ số và bắt đầu bằng số 0');
            return;
        }

        const payload = {
            alias: document.getElementById('addr-alias').value,
            receiver_name: document.getElementById('addr-name').value,
            receiver_phone: document.getElementById('addr-phone').value,
            receiver_email: document.getElementById('addr-email').value,
            province: document.getElementById('addr-city').options[document.getElementById('addr-city').selectedIndex]?.dataset.name,
            district: document.getElementById('addr-district').options[document.getElementById('addr-district').selectedIndex]?.dataset.name,
            ward: document.getElementById('addr-ward').options[document.getElementById('addr-ward').selectedIndex]?.dataset.name,
            province_code: document.getElementById('addr-city').value,
            district_code: document.getElementById('addr-district').value,
            ward_code: document.getElementById('addr-ward').value,
            detail_address: document.getElementById('addr-detail').value,
        };

        const method = id ? 'POST' : 'POST';
        const url = id ? `/addresses/${id}?_method=PUT` : '/addresses';

        try {
            const res = await apiFetch(url, {
                method: method,
                body: JSON.stringify(payload)
            });

            if (res) {
                closeAddressModal();
                loadAddresses();
            }
        } catch (err) {
            alert('Lỗi lưu địa chỉ: ' + err.message);
        }
    }

    async function editAddress(id) {
        const addresses = await apiFetch('/addresses');
        const addr = addresses.find(a => a.id == id);
        if (addr) {
            document.getElementById('addr-alias').value = addr.alias || '';
            document.getElementById('addr-name').value = addr.receiver_name;
            document.getElementById('addr-phone').value = addr.receiver_phone;
            document.getElementById('addr-email').value = addr.receiver_email || '';
            document.getElementById('addr-detail').value = addr.detail_address;
            
            const citySelect = document.getElementById('addr-city');
            citySelect.value = addr.province_code;
            
            await updateDistricts(addr.province_code, addr.district_code);
            await updateWards(addr.district_code, addr.ward_code);
            
            openAddressModal(id);
        }
    }

    async function deleteAddress(id) {
        if (confirm('Bạn có chắc muốn xóa địa chỉ này?')) {
            try {
                await apiFetch(`/addresses/${id}?_method=DELETE`, { method: 'POST' });
                loadAddresses();
            } catch (err) {
                alert('Lỗi xóa địa chỉ: ' + err.message);
            }
        }
    }

    async function setDefault(id) {
        await apiFetch(`/addresses/${id}/default`, { method: 'POST' });
        loadAddresses();
    }

    async function updateDistricts(pCode, selectedCode = '') {
        const districtSelect = document.getElementById('addr-district');
        const wardSelect = document.getElementById('addr-ward');
        districtSelect.innerHTML = '<option value="">Chọn quận huyện</option>';
        wardSelect.innerHTML = '<option value="">Chọn xã/phường</option>';
        wardSelect.disabled = true;

        if (pCode) {
            const res = await fetch(`https://provinces.open-api.vn/api/p/${pCode}?depth=2`);
            const data = await res.json();
            data.districts.forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.code;
                opt.dataset.name = d.name;
                opt.innerText = d.name;
                districtSelect.appendChild(opt);
            });
            districtSelect.value = selectedCode;
            districtSelect.disabled = false;
        } else {
            districtSelect.disabled = true;
        }
    }

    async function updateWards(dCode, selectedCode = '') {
        const wardSelect = document.getElementById('addr-ward');
        wardSelect.innerHTML = '<option value="">Chọn xã/phường</option>';
        if (dCode) {
            const res = await fetch(`https://provinces.open-api.vn/api/d/${dCode}?depth=2`);
            const data = await res.json();
            data.wards.forEach(w => {
                const opt = document.createElement('option');
                opt.value = w.code;
                opt.dataset.name = w.name;
                opt.innerText = w.name;
                wardSelect.appendChild(opt);
            });
            wardSelect.value = selectedCode;
            wardSelect.disabled = false;
        } else {
            wardSelect.disabled = true;
        }
    }

    document.addEventListener('DOMContentLoaded', async () => {
        const user = await apiFetch('/me');
        if (!user) {
            window.location.href = 'login.php';
            return;
        }

        // Sidebar Display
        const baseUrl = window.location.origin + '/Web_banhang/backend/public/';
        const avatarSrc = user.image ? (user.image.startsWith('http') ? user.image : baseUrl + user.image) : `https://ui-avatars.com/api/?name=${user.name}&background=ffd699&color=4a3b32`;
        
        document.getElementById('display-name').innerText = user.name;
        document.getElementById('display-email').innerText = user.email;
        document.getElementById('user-avatar').src = avatarSrc;

        // Form Populate (Account Tab)
        document.getElementById('full-name').value = user.name;
        document.getElementById('user-display-name').value = user.username || user.name;
        document.getElementById('user-email').value = user.email;
        document.getElementById('user-phone').value = user.phone || '';

        // Address Select Listeners
        const citySelect = document.getElementById('addr-city');
        const districtSelect = document.getElementById('addr-district');
        const wardSelect = document.getElementById('addr-ward');

        fetch('https://provinces.open-api.vn/api/p/')
            .then(res => res.json())
            .then(provinces => {
                citySelect.innerHTML = '<option value="">Chọn tỉnh thành</option>';
                provinces.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.code;
                    opt.dataset.name = p.name;
                    opt.innerText = p.name;
                    citySelect.appendChild(opt);
                });
            });

        citySelect.addEventListener('change', (e) => updateDistricts(e.target.value));
        districtSelect.addEventListener('change', (e) => updateWards(e.target.value));

        loadOrders();
        loadAddresses();
    });
</script>
<?php include 'includes/footer.php'; ?>