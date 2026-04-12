<?php 
$pageTitle = "Danh Mục"; 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Danh Sách Danh Mục</h1>
        <button class="btn btn-primary" onclick="openModal()">Thêm Danh Mục</button>
    </div>
    <table id="categories-table">
        <thead><tr><th>ID</th><th>Tên danh mục</th><th>Sản phẩm</th><th>Thao tác</th></tr></thead>
        <tbody><!-- Loaded via JS --></tbody>
    </table>

    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Thêm Danh Mục</h2>
            <form id="categoryForm">
                <input type="hidden" id="categoryId">
                <div class="form-group"><label>Tên Danh Mục</label><input type="text" id="catName" required></div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Lưu Lại</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', loadCategories);
        
        let allCategories = [];

        async function loadCategories() {
            allCategories = await adminFetch('/admin/categories');
            const tbody = document.querySelector('#categories-table tbody');
            tbody.innerHTML = allCategories.map(c => `
                <tr>
                    <td>${c.id}</td>
                    <td><strong>${c.name}</strong></td>
                    <td>${c.products_count || 0}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editCategory(${c.id})">Sửa</button>
                        <button class="btn btn-danger" onclick="deleteCategory(${c.id})">Xóa</button>
                    </td>
                </tr>
            `).join('');
        }

        function editCategory(id) {
            const c = allCategories.find(cat => cat.id === id);
            if (c) openModal(c);
        }

        async function deleteCategory(id) {
            if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
                const res = await adminFetch(`/admin/categories/${id}`, { method: 'DELETE' });
                if (res) loadCategories();
            }
        }

        function openModal(c = null) {
            document.getElementById('categoryModal').style.display = 'block';
            document.getElementById('modalTitle').innerText = c ? 'Sửa Danh Mục' : 'Thêm Danh Mục';
            document.getElementById('categoryId').value = c ? c.id : '';
            document.getElementById('catName').value = c ? c.name : '';
        }

        function closeModal() { document.getElementById('categoryModal').style.display = 'none'; }

        document.getElementById('categoryForm').onsubmit = async (e) => {
            e.preventDefault();
            const id = document.getElementById('categoryId').value;
            const payload = { 
                name: document.getElementById('catName').value
            };
            const endpoint = id ? `/admin/categories/${id}` : '/admin/categories';
            const method  = id ? 'PUT' : 'POST';
            const res = await adminFetch(endpoint, { method, body: JSON.stringify(payload) });
            if (res) { closeModal(); loadCategories(); }
        }

        window.onclick = function(event) {
            const modal = document.getElementById('categoryModal');
            if (event.target == modal) closeModal();
        }
    </script>
<?php include 'includes/footer.php'; ?>
