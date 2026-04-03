<?php 
$pageTitle = "Đơn Hàng"; 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Quản Lý Đơn Hàng</h1>
    </div>
    <table id="orders-table">
        <thead><tr><th>ID</th><th>Khách hàng</th><th>Địa chỉ</th><th>Số điện thoại</th><th>Tổng tiền</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
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
                    <option value="processing">Đang xử lý</option>
                    <option value="shipped">Đã giao hàng</option>
                    <option value="cancelled">Đã hủy</option>
                </select>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', loadOrders);
        async function loadOrders() {
            const data = await adminFetch('/orders');
            const tbody = document.querySelector('#orders-table tbody');
            tbody.innerHTML = data.map(o => `
                <tr><td>#${o.id}</td><td>${o.customer_name}</td><td>${o.shipping_address}</td><td>${o.customer_phone}</td><td>${formatPrice(o.total_amount)}</td><td><span class="status-badge status-${o.status}">${o.status}</span></td><td>
                    <button class="btn btn-info" onclick='viewOrder(${JSON.stringify(o)})'>Chi tiết</button>
                    <button class="btn btn-danger" onclick="deleteOrder(${o.id})">Xóa</button>
                </td></tr>
            `).join('');
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
            const res = await adminFetch(`/orders/${id}`, { method: 'PUT', body: JSON.stringify({ status }) });
            if (res) { closeModal(); loadOrders(); }
        }
        async function deleteOrder(id) {
            if (confirm('Bạn có chắc muốn xóa đơn hàng này?')) {
                const res = await adminFetch(`/orders/${id}`, { method: 'DELETE' });
                if (res) loadOrders();
            }
        }
    </script>
<?php include 'includes/footer.php'; ?>
