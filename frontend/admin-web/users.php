<?php
$pageTitle = "Quản lý Người Dùng";
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Danh Sách Người Dùng</h1>
</div>

<div class="card" style="padding: 20px;">
    <table id="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Người Dùng</th>
                <th>Email</th>
                <th>Phân Quyền</th>
                <th>Ngày Tạo</th>
                <th>Đơn Hàng</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loaded via JS -->
        </tbody>
    </table>
</div>

<!-- Edit Role Modal -->
<div id="roleModal" class="modal">
    <div class="modal-content" style="max-width: 400px;">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Thay Đổi Phân Quyền</h2>
        <p id="userDisplay" style="margin: 10px 0; color: #666;"></p>
        <form id="roleForm">
            <input type="hidden" id="editUserId">
            <div class="form-group">
                <label>Chọn Quyền Mới</label>
                <select id="newRole" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                    <option value="user">User (Khách hàng)</option>
                    <option value="admin">Admin (Quản trị viên)</option>
                </select>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Cập Nhật</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', loadUsers);

    async function loadUsers() {
        const data = await adminFetch('/admin/users');
        if (!data) return;

        const tbody = document.querySelector('#users-table tbody');
        tbody.innerHTML = data.map(u => `
            <tr>
                <td>#${u.id}</td>
                <td>
                    <strong>${u.name}</strong>
                </td>
                <td>${u.email}</td>
                <td>
                    <span class="badge" style="background: ${u.role === 'admin' ? 'rgba(231, 76, 60, 0.1)' : 'rgba(52, 152, 219, 0.1)'}; 
                                               color: ${u.role === 'admin' ? '#e74c3c' : '#3498db'}; 
                                               padding: 5px 10px; border-radius: 15px; font-weight: 700; font-size: 11px; text-transform: uppercase;">
                        ${u.role}
                    </span>
                </td>
                <td style="color: #888; font-size: 13px;">${new Date(u.created_at).toLocaleDateString('vi-VN')}</td>
                <td><span style="font-weight: 600;">${u.orders_count || 0}</span> đơn</td>
                <td>
                    <button class="btn btn-warning" onclick="openRoleModal(${u.id}, '${u.name}', '${u.role}')">Sửa Quyền</button>
                    <button class="btn btn-danger" onclick="deleteUser(${u.id})">Xóa</button>
                </td>
            </tr>
        `).join('');
    }

    function openRoleModal(id, name, role) {
        document.getElementById('editUserId').value = id;
        document.getElementById('userDisplay').innerText = `Người dùng: ${name}`;
        document.getElementById('newRole').value = role;
        document.getElementById('roleModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('roleModal').style.display = 'none';
    }

    document.getElementById('roleForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('editUserId').value;
        const role = document.getElementById('newRole').value;

        const res = await adminFetch(`/admin/users/${id}/role`, {
            method: 'PUT',
            body: JSON.stringify({ role })
        });

        if (res) {
            closeModal();
            loadUsers();
        }
    });

    async function deleteUser(id) {
        if (confirm('Bạn có chắc chắn muốn xóa người dùng này? Thao tác này có thể gây mất dữ liệu đơn hàng liên quan.')) {
            const res = await adminFetch(`/admin/users/${id}`, { method: 'DELETE' });
            if (res) loadUsers();
        }
    }
</script>

<?php include 'includes/footer.php'; ?>
