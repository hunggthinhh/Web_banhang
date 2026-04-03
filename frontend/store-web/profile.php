<?php 
$pageTitle = "Tài khoản"; 
include 'includes/header.php'; 
?>
        <h1 class="cart-title" style="margin-top: 20px;">Tài khoản</h1>
        <div class="profile-layout">
            <div class="profile-sidebar">
                <div class="avatar-container">
                    <img src="https://ui-avatars.com/api/?name=User&background=random" class="avatar-img" id="user-avatar">
                    <div class="avatar-edit"><i class="fas fa-camera"></i></div>
                </div>
                <h3 id="display-name">Username</h3>
                <p id="display-email">email@example.com</p>
                <div class="sidebar-menu">
                    <a href="#" class="sidebar-item active"><i class="fas fa-box"></i> Đơn hàng</a>
                    <a href="#" class="sidebar-item"><i class="fas fa-map-marker-alt"></i> Số địa chỉ</a>
                    <a href="#" class="sidebar-item"><i class="fas fa-user"></i> Tài khoản</a>
                    <a href="#" class="sidebar-item" id="logout-btn-profile"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                </div>
            </div>
            <div class="profile-content">
                <div id="orders-list">
                    <div class="empty-msg"><p>! &nbsp;&nbsp; Bạn chưa có đơn hàng nào.</p><a href="shop.php" class="btn-empty" style="padding: 10px 20px;">Duyệt sản phẩm</a></div>
                </div>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const name = localStorage.getItem('user_name') || 'Khách';
            const email = localStorage.getItem('user_email') || 'Chưa cập nhật';
            document.getElementById('display-name').innerText = name;
            document.getElementById('display-email').innerText = email;
            document.getElementById('user-avatar').src = `https://ui-avatars.com/api/?name=${name}&background=ffd699&color=4a3b32`;
            
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const count = document.getElementById('cart-count');
            if(count) count.innerText = cart.length;

            const response = await apiFetch('/orders');
            if (response && response.length > 0) {
                const list = document.getElementById('orders-list');
                list.innerHTML = `
                    <h2 style="margin-bottom: 20px; font-family: 'Playfair Display', serif;">Lịch sử đơn hàng</h2>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead><tr style="background: #f8f9fa;">
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">Mã ĐH</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">Ngày đặt</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">Tổng tiền</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">Trạng thái</th>
                        </tr></thead>
                        <tbody>${response.map(o => `
                            <tr>
                                <td style="padding: 15px; border-bottom: 1px solid #eee;">#${o.id}</td>
                                <td style="padding: 15px; border-bottom: 1px solid #eee;">${new Date(o.created_at).toLocaleDateString('vi-VN')}</td>
                                <td style="padding: 15px; border-bottom: 1px solid #eee;">${formatPrice(o.total_amount)}</td>
                                <td style="padding: 15px; border-bottom: 1px solid #eee;"><span style="padding: 5px 12px; border-radius: 20px; background: #e2f2e5; color: #2d6a4f; font-size: 13px;">${o.status}</span></td>
                            </tr>
                        `).join('')}</tbody>
                    </table>
                `;
            }

            document.getElementById('logout-btn-profile').onclick = (e) => {
                e.preventDefault();
                localStorage.clear();
                window.location.href = 'index.php';
            };
        });
    </script>
<?php include 'includes/footer.php'; ?>
