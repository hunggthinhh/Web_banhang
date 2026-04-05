<?php 
$pageTitle = "Liên Hệ"; 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Danh Sách Liên Hệ</h1>
    </div>
    <div style="overflow-x: auto; background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <table id="contacts-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Khách</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Tiêu đề</th>
                    <th>Ngày gửi</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody><!-- Loaded via JS --></tbody>
        </table>
    </div>

    <!-- View Message Modal -->
    <div id="viewContactModal" class="modal">
        <div class="modal-content" style="max-width: 650px;">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Chi Tiết Liên Hệ</h2>
            <div id="contactDetail" style="font-family: 'Outfit', sans-serif;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                    <p><strong>Người gửi:</strong> <br><span id="view-name" style="color: #555;"></span></p>
                    <p><strong>ID Khách hàng:</strong> <br><span id="view-user-id" style="color: #666;"></span></p>
                    <p><strong>Email:</strong> <br><span id="view-email" style="color: #555;"></span></p>
                    <p><strong>Số điện thoại:</strong> <br><span id="view-phone" style="color: #555;"></span></p>
                </div>
                <p><strong>Tiêu đề:</strong> <br><span id="view-subject" style="color: var(--primary); font-weight: 500;"></span></p>
                <p><strong>Ngày gửi:</strong> <br><span id="view-date" style="color: #888; font-size: 13px;"></span></p>
                <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
                <p><strong>Nội dung:</strong></p>
                <div id="view-message" style="background: #fdf8f5; padding: 20px; border-radius: 12px; border: 1px dashed var(--primary); white-space: pre-wrap; color: #444; line-height: 1.6;"></div>
            </div>
            <button class="btn btn-primary" onclick="closeModal()" style="margin-top: 25px; width: 100%; border-radius: 8px;">Đóng cửa sổ</button>
        </div>
    </div>

    <script>
        let allContacts = [];

        document.addEventListener('DOMContentLoaded', loadContacts);

        async function loadContacts() {
            allContacts = await adminFetch('/admin/contacts');
            const tbody = document.querySelector('#contacts-table tbody');
            
            if (!allContacts || allContacts.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 40px; color: #888;">Chưa có tin nhắn nào từ khách hàng.</td></tr>';
                return;
            }

            tbody.innerHTML = allContacts.map(c => `
                <tr class="${c.is_read ? 'read-row' : ''}">
                    <td><strong>#${c.id}</strong></td>
                    <td><span class="badge" style="background: #eef1f4; color: #666; font-size: 11px;">${c.user_id ? 'UID: ' + c.user_id : 'Khách vãng lai'}</span></td>
                    <td><strong>${c.fullname}</strong></td>
                    <td><a href="mailto:${c.email}" style="color: #3182ce; text-decoration: none;">${c.email}</a></td>
                    <td>${c.phone || '-'}</td>
                    <td><div style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${c.subject || '(Trống)'}</div></td>
                    <td style="font-size: 13px; color: #888;">${new Date(c.created_at).toLocaleString('vi-VN')}</td>
                    <td>
                        <button class="btn btn-warning" onclick="viewContact(${c.id})" title="Xem chi tiết">Xem</button>
                        <button class="btn btn-danger" onclick="deleteContact(${c.id})" title="Xoá">Xoá</button>
                    </td>
                </tr>
            `).join('');
        }

        function viewContact(id) {
            const c = allContacts.find(item => item.id === id);
            if (!c) return;

            document.getElementById('viewContactModal').style.display = 'block';
            document.getElementById('view-name').innerText = c.fullname;
            document.getElementById('view-user-id').innerText = c.user_id ? '#' + c.user_id : 'Chưa đăng ký';
            document.getElementById('view-email').innerText = c.email;
            document.getElementById('view-phone').innerText = c.phone || 'Không cung cấp';
            document.getElementById('view-subject').innerText = c.subject || 'Không có tiêu đề';
            document.getElementById('view-date').innerText = new Date(c.created_at).toLocaleString('vi-VN');
            document.getElementById('view-message').innerText = c.message;
            
        if (!c.is_read) {
            adminFetch(`/admin/contacts/${c.id}`, { method: 'PUT' });
        }
        }

        function closeModal() {
            document.getElementById('viewContactModal').style.display = 'none';
        }

        async function deleteContact(id) {
            if (confirm('Bạn có chắc chắn muốn xóa tin nhắn này không?')) {
                const res = await adminFetch(`/admin/contacts/${id}`, { method: 'DELETE' });
                if (res) loadContacts();
            }
        }

        window.onclick = function(event) {
            const modal = document.getElementById('viewContactModal');
            if (event.target == modal) closeModal();
        }
    </script>
    <style>
        .read-row { opacity: 0.8; }
        #contacts-table th { white-space: nowrap; }
    </style>
<?php include 'includes/footer.php'; ?>