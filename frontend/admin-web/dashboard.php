<?php
$pageTitle = "Dashboard";
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px;">
    <div>
        <h1 style="margin: 0; font-size: 26px;">Tổng Quan</h1>
        <p style="margin: 4px 0 0; color: #888; font-size: 13px;">Cập nhật theo thời gian thực</p>
    </div>
</div>

<!-- Summary Cards -->
<div class="stats-cards" style="grid-template-columns: repeat(5, 1fr); margin-bottom: 30px;">
    <div class="card" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
        <h3 style="color: rgba(255,255,255,0.85); font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">
            Sản Phẩm</h3>
        <p id="products-count" style="font-size: 36px; font-weight: 800; margin: 8px 0 0; color: white;">-</p>
    </div>
    <div class="card" style="background: linear-gradient(135deg, #f093fb, #f5576c); color: white; border: none;">
        <h3 style="color: rgba(255,255,255,0.85); font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">
            Đơn Hàng</h3>
        <p id="orders-count" style="font-size: 36px; font-weight: 800; margin: 8px 0 0; color: white;">-</p>
    </div>
    <div class="card" style="background: linear-gradient(135deg, #4facfe, #00f2fe); color: white; border: none;">
        <h3 style="color: rgba(255,255,255,0.85); font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">
            Khách Hàng</h3>
        <p id="users-count" style="font-size: 36px; font-weight: 800; margin: 8px 0 0; color: white;">-</p>
    </div>
    <div class="card" style="background: linear-gradient(135deg, #43e97b, #38f9d7); color: white; border: none;">
        <h3 style="color: rgba(255,255,255,0.85); font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">
            Tổng Doanh Thu</h3>
        <p id="revenue" style="font-size: 22px; font-weight: 800; margin: 8px 0 0; color: white;">-</p>
    </div>
    <div class="card" style="background: linear-gradient(135deg, #fa709a, #fee140); color: white; border: none;">
        <h3 style="color: rgba(255,255,255,0.85); font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">
            Liên Hệ Mới</h3>
        <p id="contacts-count" style="font-size: 36px; font-weight: 800; margin: 8px 0 0; color: white;">-</p>
    </div>
</div>

<!-- Revenue Period + Order Status Row -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 28px;">
    <!-- Revenue by Period -->
    <div class="card" style="padding: 24px;">
        <h3 style="margin: 0 0 20px; font-size: 16px;">Doanh Thu Theo Thời Kỳ</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
            <div id="card-week" style="background: #fef3f2; border-radius: 12px; padding: 16px; text-align: center; cursor: pointer; transition: transform 0.2s;" onclick="applyFilter('week')">
                <div style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Tuần này</div>
                <div id="revenue-week" style="font-size: 18px; font-weight: 700; color: #e74c3c;">-</div>
            </div>
            <div id="card-month" style="background: #fdf6ec; border-radius: 12px; padding: 16px; text-align: center; cursor: pointer; transition: transform 0.2s;" onclick="applyFilter('month')">
                <div style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Tháng này</div>
                <div id="revenue-month" style="font-size: 18px; font-weight: 700; color: #e67e22;">-</div>
            </div>
            <div id="card-year" style="background: #efffef; border-radius: 12px; padding: 16px; text-align: center;">
                <div style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Năm nay</div>
                <div id="revenue-year" style="font-size: 18px; font-weight: 700; color: #27ae60;">-</div>
            </div>
        </div>
    </div>

    <!-- Order Status Breakdown -->
    <div class="card" style="padding: 24px;">
        <h3 style="margin: 0 0 20px; font-size: 16px;">Trạng Thái Đơn Hàng</h3>
        <div id="order-status-list" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <!-- Loaded via JS -->
        </div>
    </div>
</div>

<!-- Revenue Chart + Top Products Row -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 28px;">
    <!-- Revenue Chart -->
    <div class="card" style="padding: 24px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <h3 id="chart-title" style="margin: 0; font-size: 16px;">Doanh Thu</h3>
            <div style="display: flex; align-items: center; gap: 10px;">
                <select id="filter-type" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #ddd; font-size: 13px;">
                    <option value="day">Theo ngày</option>
                    <option value="week">Theo tuần</option>
                    <option value="month" selected>Theo tháng</option>
                </select>
                <input type="date" id="filter-date" value="<?= date('Y-m-d') ?>" style="padding: 5px 10px; border-radius: 6px; border: 1px solid #ddd; font-size: 13px;">
            </div>
        </div>
        <canvas id="revenueChart" height="100"></canvas>
    </div>

    <!-- Top Products -->
    <div class="card" style="padding: 24px;">
        <h3 style="margin: 0 0 20px; font-size: 16px;">Top Bán Chạy</h3>
        <div id="top-products-list"><!-- Loaded via JS --></div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card" style="padding: 24px; margin-bottom: 20px;">
    <h3 style="margin: 0 0 20px; font-size: 16px;">Đơn Hàng Mới Nhất</h3>
    <table id="recent-orders" style="width: 100%;">
        <thead>
            <tr>
                <th>Mã ĐH</th>
                <th>Khách hàng</th>
                <th>SĐT</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
            </tr>
        </thead>
        <tbody><!-- Loaded via JS --></tbody>
    </table>
</div>

<script>
    let revenueChart = null;

    const statusConfig = {
        'pending': { label: 'Chờ xử lý', color: '#e67e22', icon: '⏳', html: '<span style="background: #fef3e2; color: #e67e22; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">⏳ Chờ xử lý</span>' },
        'processing': { label: 'Đang xử lý', color: '#3498db', icon: '🔄', html: '<span style="background: #e8f4fd; color: #3498db; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">🔄 Đang xử lý</span>' },
        'shipped': { label: 'Đã giao', color: '#27ae60', icon: '✅', html: '<span style="background: #eafaf1; color: #27ae60; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">✅ Đã giao</span>' },
        'cancelled': { label: 'Đã hủy', color: '#e74c3c', icon: '❌', html: '<span style="background: #fdf0f0; color: #e74c3c; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">❌ Đã hủy</span>' },
        'completed': { label: 'Hoàn thành', color: '#8e44ad', icon: '🎉', html: '<span style="background: #f4ecfc; color: #8e44ad; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">🎉 Hoàn thành</span>' },
    };

    const updateChart = (labels, values) => {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        if (revenueChart) {
            revenueChart.data.labels = labels;
            revenueChart.data.datasets[0].data = values;
            revenueChart.update();
        } else {
            revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Doanh thu (đ)',
                        data: values,
                        backgroundColor: 'rgba(102, 126, 234, 0.7)',
                        borderColor: 'rgba(102, 126, 234, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => formatPrice(ctx.parsed.y)
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: val => new Intl.NumberFormat('vi-VN', { notation: 'compact', compactDisplay: 'short' }).format(val) + 'đ'
                            }
                        }
                    }
                }
            });
        }
    };

    const applyFilter = async (type = null) => {
        if (type) document.getElementById('filter-type').value = type;
        
        const filterType = document.getElementById('filter-type').value;
        const filterDate = document.getElementById('filter-date').value;

        // Update UI state
        document.querySelectorAll('[id^="card-"]').forEach(el => el.style.border = 'none');
        if (filterType !== 'day') {
            const card = document.getElementById(`card-${filterType}`);
            if (card) card.style.border = '2px solid #667eea';
        }

        const report = await adminFetch(`/admin/dashboard/revenue-report?type=${filterType}&date=${filterDate}`);
        if (!report) return;

        // Update Title
        const dateObj = new Date(filterDate);
        document.getElementById('chart-title').innerText = `Doanh Thu ${filterType === 'day' ? 'Ngày ' + dateObj.toLocaleDateString('vi-VN') : (filterType === 'week' ? 'Tuần' : 'Tháng')}`;

        // Update Chart
        updateChart(report.chartData.map(d => d.label), report.chartData.map(d => d.amount));

        // Update Details Table
        const tbody = document.querySelector('#recent-orders tbody');
        if (report.orders && report.orders.length > 0) {
            tbody.innerHTML = report.orders.map(o => `
                <tr>
                    <td><strong>#${o.id}</strong></td>
                    <td>${o.customer_name}</td>
                    <td>${o.customer_phone || '-'}</td>
                    <td style="color: var(--primary); font-weight: 700;">${formatPrice(o.total_amount)}</td>
                    <td>${(statusConfig[o.status] || {html: o.status}).html}</td>
                    <td style="color: #888; font-size: 13px;">${new Date(o.created_at).toLocaleString('vi-VN')}</td>
                </tr>
            `).join('');
        } else {
            tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 30px; color: #aaa;">Không có đơn hàng nào trong thời gian này.</td></tr>';
        }
    };

    document.addEventListener('DOMContentLoaded', async () => {
        // Initial dashboard stats
        const data = await adminFetch('/admin/dashboard');
        if (!data) return;

        // Summary cards
        document.getElementById('products-count').innerText = data.productsCount;
        document.getElementById('orders-count').innerText = data.ordersCount;
        document.getElementById('users-count').innerText = data.usersCount;
        document.getElementById('contacts-count').innerText = data.contactsCount;
        document.getElementById('revenue').innerText = formatPrice(data.revenue || 0);

        // Revenue by period
        document.getElementById('revenue-week').innerText = formatPrice(data.revenueWeek || 0);
        document.getElementById('revenue-month').innerText = formatPrice(data.revenueMonth || 0);
        document.getElementById('revenue-year').innerText = formatPrice(data.revenueYear || 0);

        // Order Status Breakdown
        const statusEl = document.getElementById('order-status-list');
        const statuses = data.ordersByStatus || {};
        const allStatuses = ['pending', 'processing', 'shipped', 'cancelled', 'completed'];
        statusEl.innerHTML = allStatuses.map(key => {
            const cfg = statusConfig[key] || { label: key, color: '#999', icon: '📌' };
            const count = statuses[key] || 0;
            return `<div style="background: #f9f9f9; border-radius: 12px; padding: 14px; display: flex; align-items: center; gap: 12px; border-left: 4px solid ${cfg.color};">
            <span style="font-size: 22px;">${cfg.icon}</span>
            <div>
                <div style="font-size: 11px; color: #888; text-transform: uppercase;">${cfg.label}</div>
                <div style="font-size: 24px; font-weight: 800; color: ${cfg.color};">${count}</div>
            </div>
        </div>`;
        }).join('');

        // Top Products
        const topEl = document.getElementById('top-products-list');
        if (data.topProducts && data.topProducts.length > 0) {
            topEl.innerHTML = data.topProducts.map((p, i) => `
                <div style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                    <div style="width: 28px; height: 28px; border-radius: 50%; background: ${['#667eea', '#f093fb', '#4facfe', '#43e97b', '#fa709a'][i]}; color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 13px; flex-shrink: 0;">${i + 1}</div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-weight: 600; font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${p.product_name}</div>
                        <div style="font-size: 11px; color: #888;">Đã bán: ${p.total_sold} sản phẩm</div>
                    </div>
                    <div style="font-size: 13px; font-weight: 700; color: var(--primary); flex-shrink: 0;">${formatPrice(p.total_revenue)}</div>
                </div>
            `).join('');
        } else {
            topEl.innerHTML = '<p style="color: #aaa; text-align: center; padding: 20px 0;">Chưa có dữ liệu</p>';
        }

        // Initialize Filter Events
        document.getElementById('filter-type').addEventListener('change', () => applyFilter());
        document.getElementById('filter-date').addEventListener('change', () => applyFilter());

        // Load Default Report (Month)
        applyFilter('month');
    });
</script>

<?php include 'includes/footer.php'; ?>