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

    .status-return_requested {
        background: rgba(255, 107, 53, 0.1);
        color: #e65100;
    }

    .status-returned {
        background: rgba(40, 167, 69, 0.1);
        color: #1b5e20;
    }

    .status-return_rejected {
        background: rgba(117, 117, 117, 0.1);
        color: #424242;
    }

    .pm-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .pm-bank {
        background: #e3f2fd;
        color: #0d47a1;
    }

    .pm-cod {
        background: #f5f5f5;
        color: #616161;
    }

    .ps-badge {
        font-size: 11px;
        font-weight: 700;
    }

    .ps-paid {
        color: #28a745;
    }

    .ps-unpaid {
        color: #dc3545;
    }

    .ps-waiting {
        color: #fd7e14;
    }
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Quản Lý Đơn Hàng</h1>
    <div style="display: flex; gap: 15px; align-items: center;">
        <div style="position: relative; display: flex; align-items: center;">
            <input type="text" id="order-search" placeholder="Số điện thoại, tên khách..."
                onkeyup="if(event.key === 'Enter') loadOrders()"
                style="padding: 8px 15px; border-radius: 8px; border: 1px solid #ddd; outline: none; width: 250px;">
            <button onclick="loadOrders()"
                style="position: absolute; right: 8px; background: none; border: none; cursor: pointer; color: #888;">
                <i class="fas fa-search"></i>
            </button>
        </div>
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
                <option value="return_requested">Yêu cầu trả hàng</option>
                <option value="returned">Đã hoàn trả</option>
                <option value="return_rejected">Bị từ chối trả hàng</option>
            </select>
        </div>
    </div>
</div>
<table id="orders-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ngày đặt</th>
            <th>Khách hàng</th>
            <th>SĐT</th>
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
                    <select id="update-status"
                        style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                        <option value="pending">Chờ xử lý</option>
                        <option value="processing">Đang làm bánh</option>
                        <option value="shipped">Đang giao hàng</option>
                        <option value="delivered">Đã giao hàng / Hoàn tất</option>
                        <option value="cancelled">Đã hủy đơn</option>
                        <option value="return_requested">Đang yêu cầu trả hàng</option>
                        <option value="returned">Đã hoàn trả (Chấp nhận)</option>
                        <option value="return_rejected">Từ chối trả hàng</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-weight: 700; margin-bottom: 5px;">Thanh toán</label>
                    <select id="update-payment-status"
                        style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                        <option value="unpaid">Chưa thanh toán</option>
                        <option value="waiting_verification">Chờ xác minh (QR)</option>
                        <option value="paid">Đã thanh toán (Paid)</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" onclick="updateOrderInfo()" style="width: 100%;">Cập nhật thông tin đơn
                hàng</button>
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
        try {
            const status = document.getElementById('filter-status').value || 'all';
            const searchInput = document.getElementById('order-search');
            const search = searchInput ? searchInput.value : '';
            const data = await adminFetch(`/admin/orders?status=${status}&search=${encodeURIComponent(search)}`);
            if (!data) return;
            const tbody = document.querySelector('#orders-table tbody');

            const statusLabels = {
                'pending': 'Chờ xử lý',
                'processing': 'Đang làm bánh',
                'shipped': 'Đang giao hàng',
                'delivered': 'Hoàn tất',
                'confirmed': 'Đã xác nhận',
                'cancelled': 'Đã hủy',
                'return_requested': 'Yêu cầu trả hàng',
                'returned': 'Đã hoàn trả',
                'return_rejected': 'Từ chối trả hàng'
            };

            tbody.innerHTML = data.map(o => `
                <tr style="${o.status === 'return_requested' ? 'background-color: rgba(255, 107, 53, 0.05); border-left: 4px solid #e65100;' : ''}">
                    <td>#${o.id}</td>
                    <td>${new Date(o.created_at).toLocaleString('vi-VN')}</td>
                    <td><strong>${o.customer_name}</strong></td>
                    <td>${o.customer_phone}</td>
                    <td>${formatPrice(o.total_amount)}</td>
                    <td>
                        <div class="pm-badge pm-${o.payment_method || 'cod'}">${(o.payment_method === 'bank') ? 'Bán qua Ngân hàng' : 'Tiền mặt (COD)'}</div>
                        <div class="ps-badge ps-${o.payment_status || 'unpaid'}">
                            ${(o.payment_status === 'paid') ? '● Đã thanh toán' : (o.payment_status === 'waiting_verification' ? '◐ Đang chờ xác minh' : '○ Chưa nhận tiền')}
                        </div>
                    </td>
                    <td><span class="status-badge status-${o.status}">${statusLabels[o.status] || o.status}</span></td>
                    <td>
                        <button class="btn btn-info" onclick='loadOrderById(${o.id})'>Chi tiết</button>
                        <button class="btn btn-danger" onclick="deleteOrder(${o.id})">Xóa</button>
                    </td>
                </tr>
            `).join('');
        } catch (error) {
            console.error('Error loading orders:', error);
        }
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
            'cancelled': 'ĐÃ HỦY',
            'return_requested': 'YÊU CẦU TRẢ HÀNG',
            'returned': 'ĐÃ HOÀN TRẢ',
            'return_rejected': 'TỪ CHỐI TRẢ HÀNG'
        };

        const baseUrl = window.location.origin + '/Web_banhang/backend/public/';

        let html = `
                <!-- Nhóm 1: Thông tin đơn hàng & Trạng thái -->
                <div style="background: #f8f9fa; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #eee;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div>
                            <p style="margin: 0 0 5px; font-size: 13px; color: #666;">Ngày đặt đơn:</p>
                            <p style="margin: 0; font-weight: 600;">${new Date(o.created_at).toLocaleString('vi-VN')}</p>
                        </div>
                        <div style="text-align: right;">
                            <p style="margin: 0 0 5px; font-size: 13px; color: #666;">Trạng thái hiện tại:</p>
                            <span class="status-badge status-${o.status}" style="font-size: 11px; padding: 4px 10px;">${statusLabels[o.status]}</span>
                        </div>
                    </div>
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px dashed #ddd; display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div>
                            <p style="margin: 0 0 5px; font-size: 13px; color: #666;">Hình thức thanh toán:</p>
                            <span class="pm-badge pm-${o.payment_method || 'cod'}">${o.payment_method === 'bank' ? 'Chuyển khoản Ngân hàng' : 'Tiền mặt (COD)'}</span>
                        </div>
                        <div style="text-align: right;">
                            <p style="margin: 0 0 5px; font-size: 13px; color: #666;">Tình trạng thanh toán:</p>
                            <span class="ps-badge ps-${o.payment_status || 'unpaid'}">${o.payment_status === 'paid' ? '● Đã nhận tiền' : '○ Chưa nhận tiền'}</span>
                        </div>
                    </div>
                </div>

                <!-- Nhóm 2: Lịch hẹn & Giao hàng -->
                <div style="background: #fffdf5; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #f0e4b8;">
                    <h4 style="margin: 0 0 15px; font-size: 15px; color: #856404; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-truck"></i> THÔNG TIN GIAO NHẬN & HẸN GIỜ
                    </h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                        <div style="background: #fff; padding: 10px; border-radius: 8px; border: 1px solid #f0e4b8;">
                            <p style="margin: 0 0 5px; font-size: 12px; color: #856404; font-weight: 600;">📅 NGÀY HẸN GIAO:</p>
                            <p style="margin: 0; font-size: 16px; font-weight: 700; color: #000;">${o.delivery_date ? new Date(o.delivery_date).toLocaleDateString('vi-VN') : 'Chưa chọn'}</p>
                        </div>
                        <div style="background: #fff; padding: 10px; border-radius: 8px; border: 1px solid #f0e4b8;">
                            <p style="margin: 0 0 5px; font-size: 12px; color: #856404; font-weight: 600;">⏰ GIỜ HẸN GIAO:</p>
                            <p style="margin: 0; font-size: 16px; font-weight: 700; color: #000;">${o.delivery_time || 'Chưa chọn'}</p>
                        </div>
                    </div>
                    <div>
                        <p style="margin: 0 0 5px; font-size: 13px; color: #666;">📍 Địa chỉ nhận hàng:</p>
                        <p style="margin: 0; font-weight: 600; line-height: 1.4;">${o.customer_address}</p>
                    </div>
                </div>

                <!-- Nhóm 3: Thông tin khách hàng -->
                <div style="padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #eee;">
                    <h4 style="margin: 0 0 12px; font-size: 15px; display: flex; align-items: center; gap: 8px; color: #333;">
                        <i class="fas fa-user"></i> THÔNG TIN KHÁCH HÀNG
                    </h4>
                    <div style="display: flex; gap: 20px;">
                         <p style="margin: 0;"><strong>Tên:</strong> ${o.customer_name}</p>
                         <p style="margin: 0;"><strong>SĐT:</strong> ${o.customer_phone}</p>
                    </div>
                </div>

                <!-- Nhóm 4: Danh sách sản phẩm -->
                <h4 style="margin: 25px 0 15px; font-size: 15px; border-bottom: 2px solid #eee; padding-bottom: 8px; color: #333;">
                    <i class="fas fa-birthday-cake"></i> SẢN PHẨM ĐÃ ĐẶT
                </h4>
                <div class="order-items-list">
            `;

        o.items.forEach(i => {
            let imgPath = '../assets/images/default-cake.jpg';
            if (i.product && i.product.image) {
                imgPath = (i.product.image.indexOf('http') === 0) ? i.product.image : baseUrl + i.product.image;
            }
            html += `
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px; padding: 10px; border: 1px dashed #eee; border-radius: 10px;">
                        <img src="${imgPath}" style="width: 60px; height: 60px; border-radius: 8px; object-fit: cover; border: 1px solid #eee;" onerror="this.src='../assets/images/default-cake.jpg'">
                        <div style="flex: 1;">
                            <h4 style="margin: 0; font-size: 15px; color: #001f3f;">${i.product_name}</h4>
                            <p style="margin: 4px 0; color: #666; font-size: 13px;">SL: ${i.quantity} x ${formatPrice(i.price)}</p>
                            ${i.greeting ? `<p style="margin: 5px 0 0; color: #856404; font-size: 12px; font-style: italic; background: #fff8e1; display: inline-block; padding: 3px 8px; border-radius: 4px; border-left: 2px solid #ffca28;"><strong>Lời chúc:</strong> "${i.greeting}"</p>` : ''}
                        </div>
                        <div style="font-weight: 700; color: #d1b06b; font-size: 15px;">
                            ${formatPrice(i.price * i.quantity)}
                        </div>
                    </div>
                `;
        });

        html += `
                </div>

                <!-- Nhóm 5: Ghi chú & Tổng cộng -->
                <div style="margin-top: 20px; display: grid; grid-template-columns: 1.5fr 1fr; gap: 15px;">
                    <div style="background: #fdf2f2; padding: 12px; border-radius: 10px; border: 1px solid #fbd5d5;">
                        <p style="margin: 0 0 5px; font-size: 12px; color: #c53030; font-weight: 700;">📝 GHI CHÚ CỦA KHÁCH:</p>
                        <p style="margin: 0; font-size: 13px; color: #2d3748;">${o.note || 'Không có ghi chú'}</p>
                    </div>
                    <div style="background: #333; color: #fff; padding: 12px; border-radius: 10px; text-align: right; display: flex; flex-direction: column; justify-content: center;">
                        <p style="margin: 0 0 4px; font-size: 12px; color: #aaa; text-transform: uppercase;">Tổng thanh toán</p>
                        <p style="margin: 0; font-size: 18px; font-weight: 800; color: #f0c07d;">${formatPrice(o.total_amount)}</p>
                    </div>
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

</script>
<?php include 'includes/footer.php'; ?>