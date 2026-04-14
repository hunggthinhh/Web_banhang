<?php
$pageTitle = "Đơn Hàng";
include 'includes/header.php';
include 'includes/sidebar.php';
?>
<style>
    .status-badge {
        padding: 8px 15px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: rgba(255, 193, 7, 0.1);
        color: #856404;
    }

    .status-processing {
        background: rgba(0, 123, 255, 0.1);
        color: #004085;
    }

    .status-shipped {
        background: rgba(111, 66, 193, 0.1);
        color: #4a148c;
    }

    .status-delivered {
        background: rgba(40, 167, 69, 0.1);
        color: #155724;
    }

    .status-cancelled {
        background: rgba(220, 53, 69, 0.1);
        color: #721c24;
    }

    .pm-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .pm-bank { background: #e3f2fd; color: #0d47a1; }
    .pm-cod { background: #f5f5f5; color: #616161; }

    .ps-badge {
        font-size: 11px;
        font-weight: 700;
    }
    .ps-paid { color: #28a745; }
    .ps-unpaid { color: #dc3545; }
    .ps-waiting { color: #fd7e14; }

    .btn-simulate {
        background: #6f42c1;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 11px;
        cursor: pointer;
        margin-left: 5px;
    }
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Quản Lý Đơn Hàng</h1>
    <div style="display: flex; gap: 10px; align-items: center;">
        <label for="filter-status" style="font-weight: 600;">Xem trạng thái:</label>
        <select id="filter-status" onchange="loadOrders()"
            style="padding: 8px; border-radius: 8px; border: 1px solid #ddd; outline: none;">
            <option value="all">Tất cả đơn hàng</option>
            <option value="pending">Chờ xử lý</option>
            <option value="processing">Đang làm bánh</option>
            <option value="shipped">Đang giao hàng</option>
            <option value="delivered">Hoàn tất</option>
            <option value="cancelled">Đã hủy</option>
        </select>
    </div>
</div>
<table id="orders-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ngày đặt</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Thanh toán</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody><!-- Loaded via JS --></tbody>
</table>

<div id="orderModal" class="modal">
    <div class="modal-content" style="max-width: 650px;">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 style="margin-bottom: 20px;">Chi Tiết Đơn Hàng #<span id="modalOrderId"></span></h2>

        <div id="order-details-content">
            <!-- Content injected via JS -->
        </div>

        <div class="status-update-section" style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #eee;">
            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label style="display: block; font-weight: 700; margin-bottom: 5px;">Cập nhật đơn hàng</label>
                    <select id="update-status" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                        <option value="pending">Chờ xử lý</option>
                        <option value="processing">Đang làm bánh</option>
                        <option value="shipped">Đang giao hàng</option>
                        <option value="delivered">Đã giao hàng / Hoàn tất</option>
                        <option value="cancelled">Đã hủy đơn</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-weight: 700; margin-bottom: 5px;">Thanh toán</label>
                    <select id="update-payment-status" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                        <option value="unpaid">Chưa thanh toán</option>
                        <option value="waiting_verification">Chờ xác minh (QR)</option>
                        <option value="paid">Đã thanh toán (Paid)</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" onclick="updateOrderInfo()" style="width: 100%;">Cập nhật thông tin đơn hàng</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('status')) {
            const statusVal = urlParams.get('status');
            const statusSelect = document.getElementById('filter-status');
            if ([...statusSelect.options].some(o => o.value === statusVal)) {
                statusSelect.value = statusVal;
            }
        }
        loadOrders().then(() => {
            if (urlParams.has('search')) loadOrderById(urlParams.get('search'));
        });
    });

    async function loadOrders() {
        const status = document.getElementById('filter-status').value;
        const data = await adminFetch(`/admin/orders?status=${status}`);
        if (!data) return;
        const tbody = document.querySelector('#orders-table tbody');

        const statusLabels = {
            'pending': 'Chờ xử lý',
            'processing': 'Đang làm bánh',
            'shipped': 'Đang giao hàng',
            'delivered': 'Hoàn tất',
            'cancelled': 'Đã hủy'
        };

        tbody.innerHTML = data.map(o => `
                <tr>
                    <td>#${o.id}</td>
                    <td>${new Date(o.created_at).toLocaleString('vi-VN')}</td>
                    <td>${o.customer_name}</td>
                    <td>${formatPrice(o.total_amount)}</td>
                    <td>
                        <div class="pm-badge pm-${o.payment_method || 'cod'}">${(o.payment_method === 'bank') ? 'Bán qua Ngân hàng' : 'Tiền mặt (COD)'}</div>
                        <div class="ps-badge ps-${o.payment_status || 'unpaid'}">
                            ${(o.payment_status === 'paid') ? '● Đã thanh toán' : (o.payment_status === 'waiting_verification' ? '◐ Đang chờ xác minh' : '○ Chưa nhận tiền')}
                            ${(o.payment_status !== 'paid' && o.payment_method === 'bank') ? `<button class="btn-simulate" onclick="event.stopPropagation(); simulateOrderPayment(${o.id})">Giả lập nhận tiền</button>` : ''}
                        </div>
                    </td>
                    <td><span class="status-badge status-${o.status}">${statusLabels[o.status] || o.status}</span></td>
                    <td>
                        <button class="btn btn-info" onclick='loadOrderById(${o.id})'>Chi tiết</button>
                        <button class="btn btn-danger" onclick="deleteOrder(${o.id})">Xóa</button>
                    </td>
                </tr>
            `).join('');
    }

    async function loadOrderById(id) {
        const orders = await adminFetch('/admin/orders');
        const o = orders.find(x => x.id == id);
        if (o) viewOrder(o);
    }

    function viewOrder(o) {
        document.getElementById('orderModal').style.display = 'block';
        document.getElementById('modalOrderId').innerText = o.id;
        document.getElementById('update-status').value = o.status;
        document.getElementById('update-payment-status').value = o.payment_status || 'unpaid';

        const statusLabels = {
            'pending': 'CHỜ XỬ LÝ',
            'processing': 'ĐANG LÀM BÁNH',
            'shipped': 'ĐANG GIAO HÀNG',
            'delivered': 'HOÀN TẤT',
            'cancelled': 'ĐÃ HỦY'
        };

        const baseUrl = window.location.origin + '/Web_banhang/backend/public/';

        let html = `
                <div style="margin-bottom: 20px;">
                    <p style="margin-bottom: 8px;"><strong>Ngày đặt:</strong> ${new Date(o.created_at).toLocaleString('vi-VN')}</p>
                    <p style="margin-bottom: 8px;"><strong>Hình thức:</strong> <span class="pm-badge pm-${o.payment_method || 'cod'}">${o.payment_method === 'bank' ? 'Chuyển khoản Ngân hàng' : 'Tiền mặt (COD)'}</span></p>
                    <p style="margin-bottom: 8px;"><strong>Thanh toán:</strong> <span class="ps-badge ps-${o.payment_status || 'unpaid'}">${o.payment_status === 'paid' ? 'Đã nhận tiền' : 'Chưa nhận tiền'}</span></p>
                    <p style="margin-bottom: 8px;"><strong>Trạng thái:</strong> <span class="status-badge status-${o.status}" style="font-size: 12px; padding: 4px 10px;">${statusLabels[o.status]}</span></p>
                    <hr style="border: none; border-top: 1px solid #eee; margin: 15px 0;">
                    <p style="margin-bottom: 8px;"><strong>Khách hàng:</strong> ${o.customer_name}</p>
                    <p style="margin-bottom: 8px;"><strong>Số điện thoại:</strong> ${o.customer_phone}</p>
                    <p style="margin-bottom: 8px;"><strong>Địa chỉ giao:</strong> ${o.customer_address}</p>
                    <p style="margin-bottom: 8px;"><strong>Ghi chú:</strong> ${o.note || 'Không có'}</p>
                </div>
                
                <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-top: 25px;">Sản phẩm đã mua</h3>
                <div class="order-items-list" style="margin-top: 15px;">
            `;

        o.items.forEach(i => {
            let imgPath = '../assets/images/default-cake.jpg';
            if (i.product && i.product.image) {
                // Nếu là URL tuyệt đối (bắt đầu bằng http) thì dùng luôn, nếu không thì ghép với baseUrl
                imgPath = (i.product.image.indexOf('http') === 0) ? i.product.image : baseUrl + i.product.image;
            }
            html += `
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #eee;">
                        <img src="${imgPath}" style="width: 70px; height: 70px; border-radius: 8px; object-fit: cover; border: 1px solid #eee;" onerror="this.src='../assets/images/default-cake.jpg'">
                        <div style="flex: 1;">
                            <h4 style="margin: 0; font-size: 16px;">${i.product_name}</h4>
                            <p style="margin: 5px 0 0; color: #666; font-size: 14px;">Số lượng: ${i.quantity} x ${formatPrice(i.price)}</p>
                        </div>
                        <div style="font-weight: 700; color: #d1b06b;">
                            ${formatPrice(i.price * i.quantity)}
                        </div>
                    </div>
                `;
        });

        html += `
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; padding: 15px; background: #fafafa; border-radius: 8px;">
                    <span style="font-weight: 700; font-size: 18px;">Tổng thanh toán:</span>
                    <span style="font-weight: 700; font-size: 20px; color: var(--primary);">${formatPrice(o.total_amount)}</span>
                </div>
            `;

        document.getElementById('order-details-content').innerHTML = html;
    }

    function closeModal() { document.getElementById('orderModal').style.display = 'none'; }
    async function updateOrderInfo() {
        const id = document.getElementById('modalOrderId').innerText;
        const status = document.getElementById('update-status').value;
        const payment_status = document.getElementById('update-payment-status').value;
        
        const res = await adminFetch(`/admin/orders/${id}`, { 
            method: 'PUT', 
            body: JSON.stringify({ status, payment_status }) 
        });
        if (res) { closeModal(); loadOrders(); }
    }

    async function deleteOrder(id) {
        if (confirm('Bạn có chắc muốn xóa đơn hàng này?')) {
            const res = await adminFetch(`/admin/orders/${id}`, { method: 'DELETE' });
            if (res) loadOrders();
        }
    }

    async function simulateOrderPayment(id) {
        if (confirm('Bạn muốn giả lập hệ thống vừa nhận được tiền từ ngân hàng cho đơn này?')) {
            const res = await adminFetch(`/orders/${id}/simulate-payment`, { method: 'POST' });
            if (res) {
                alert('Mô phỏng thành công! Đơn hàng đã được Pay check tự động.');
                loadOrders();
            }
        }
    }
</script>
<?php include 'includes/footer.php'; ?>