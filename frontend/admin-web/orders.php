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
        .status-pending { background: rgba(255, 193, 7, 0.1); color: #856404; }
        .status-processing { background: rgba(0, 123, 255, 0.1); color: #004085; }
        .status-shipped { background: rgba(111, 66, 193, 0.1); color: #4a148c; }
        .status-delivered { background: rgba(40, 167, 69, 0.1); color: #155724; }
        .status-cancelled { background: rgba(220, 53, 69, 0.1); color: #721c24; }
    </style>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Quản Lý Đơn Hàng</h1>
    </div>
    <table id="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody><!-- Loaded via JS --></tbody>
    </table>

    <div id="orderModal" class="modal">
        <div class="modal-content" style="max-width: 600px;">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Chi Tiết Đơn Hàng #<span id="modalOrderId"></span></h2>
            <div id="order-details-content"></div>
            <div class="form-group" style="margin-top: 20px;">
                <label>Cập nhật trạng thái</label>
                <select id="update-status" onchange="updateOrderStatus()">
                    <option value="pending">Chờ xử lý</option>
                    <option value="processing">Đang làm bánh</option>
                    <option value="shipped">Đang giao hàng</option>
                    <option value="delivered">Đã giao hàng / Hoàn tất</option>
                    <option value="cancelled">Đã hủy đơn</option>
                </select>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', loadOrders);
        async function loadOrders() {
            const data = await adminFetch('/admin/orders');
            if(!data) return;
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
                    <td>${o.customer_name}</td>
                    <td>${o.customer_address}</td>
                    <td>${o.customer_phone}</td>
                    <td>${formatPrice(o.total_amount)}</td>
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
            if(o) viewOrder(o);
        }

        function viewOrder(o) {
            document.getElementById('orderModal').style.display = 'block';
            document.getElementById('modalOrderId').innerText = o.id;
            document.getElementById('update-status').value = o.status;
            let html = `<p><strong>Ngày đặt:</strong> ${new Date(o.created_at).toLocaleString('vi-VN')}</p><h3>Sản phẩm:</h3><ul>`;
            o.items.forEach(i => { html += `<li>${i.product_name} x ${i.quantity} - ${formatPrice(i.price * i.quantity)}</li>`; });
            html += `</ul><p><strong>Ghi chú:</strong> ${o.note || 'Không có'}</p>`;
            document.getElementById('order-details-content').innerHTML = html;
        }

        function closeModal() { document.getElementById('orderModal').style.display = 'none'; }
        async function updateOrderStatus() {
            const id = document.getElementById('modalOrderId').innerText;
            const status = document.getElementById('update-status').value;
            const res = await adminFetch(`/admin/orders/${id}`, { method: 'PUT', body: JSON.stringify({ status }) });
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
