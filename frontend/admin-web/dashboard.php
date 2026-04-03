<?php 
$pageTitle = "Dashboard"; 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
    <h1>Tổng Quan</h1>
    <div class="stats-cards">
        <div class="card"><h3>Sản Phẩm</h3><p id="products-count">0</p></div>
        <div class="card"><h3>Đơn Hàng</h3><p id="orders-count">0</p></div>
        <div class="card"><h3>Khách Hàng</h3><p id="users-count">0</p></div>
        <div class="card"><h3>Doanh Thu</h3><p id="revenue">0 đ</p></div>
    </div>
    <h3>Đơn Hàng Gần Đây</h3>
    <table id="recent-orders">
        <thead><tr><th>Mã ĐH</th><th>Khách</th><th>Tổng</th><th>Trạng thái</th></tr></thead>
        <tbody><!-- Loaded via JS --></tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const data = await adminFetch('/admin/dashboard');
            if (data) {
                document.getElementById('products-count').innerText = data.productsCount;
                document.getElementById('orders-count').innerText = data.ordersCount;
                document.getElementById('users-count').innerText = data.usersCount;
                document.getElementById('revenue').innerText = formatPrice(data.revenue);
                const tbody = document.querySelector('#recent-orders tbody');
                tbody.innerHTML = data.recentOrders.map(o => `
                    <tr><td>#${o.id}</td><td>${o.customer_name}</td><td>${formatPrice(o.total_amount)}</td><td>${o.status}</td></tr>
                `).join('');
            }
        });
    </script>
<?php include 'includes/footer.php'; ?>
