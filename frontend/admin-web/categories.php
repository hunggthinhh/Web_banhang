<?php 
$pageTitle = "Danh Mục"; 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Danh Sách Danh Mục</h1>
        <button class="btn" onclick="openModal()">Thêm Danh Mục</button>
    </div>
    <table id="categories-table">
        <thead><tr><th>ID</th><th>Tên danh mục</th><th>Mô tả</th><th>Sản phẩm</th><th>Thao tác</th></tr></thead>
        <tbody><!-- Loaded via JS --></tbody>
    </table>

    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Thêm Danh Mục</h2>
            <form id="categoryForm">
                <input type="hidden" id="categoryId">
                <div class="form-group"><label>Tên Danh Mục</label><input type="text" id="catName" required></div>
                <div class="form-group"><label>Mô tả</label><textarea id="catDescription"></textarea></div>
                <button type="submit" class="btn" style="width: 100%;">Lưu Lại</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', loadCategories);
        async function loadCategories() {
            const data = await adminFetch('/categories');
            const tbody = document.querySelector('#categories-table tbody');
            tbody.innerHTML = data.map(c => `
                <tr><td>${c.id}</td><td>${c.name}</td><td>${c.description || ''}</td><td>${c.products_count}</td><td>
                    <button class="btn btn-warning" onclick='editCategory(${JSON.stringify(c)})'>Sửa</button>
                    <button class="btn btn-danger" onclick="deleteCategory(${c.id})">Xóa</button>
                </td></tr>
            `).join('');
        }
        function openModal(c = null) {
            document.getElementById('categoryModal').style.display = 'block';
            document.getElementById('modalTitle').innerText = c ? 'Sửa Danh Mục' : 'Thêm Danh Mục';
            document.getElementById('categoryId').value = c ? c.id : '';
            document.getElementById('catName').value = c ? c.name : '';
            document.getElementById('catDescription').value = c ? c.description : '';
        }
        function closeModal() { document.getElementById('categoryModal').style.display = 'none'; }
        document.getElementById('categoryForm').onsubmit = async (e) => {
            e.preventDefault();
            const id = document.getElementById('categoryId').value;
            const payload = { name: document.getElementById('catName').value, description: document.getElementById('catDescription').value };
            const method = id ? 'PUT' : 'POST';
            const endpoint = id ? `/categories/${id}` : '/categories';
            const res = await adminFetch(endpoint, { method, body: JSON.stringify(payload) });
            if (res) { closeModal(); loadCategories(); }
        }
    </script>
<?php include 'includes/footer.php'; ?>
