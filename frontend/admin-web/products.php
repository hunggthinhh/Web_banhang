<?php 
$pageTitle = "Sản Phẩm"; 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Danh Sách Sản Phẩm</h1>
        <button class="btn" onclick="openModal()">Thêm Sản Phẩm</button>
    </div>
    <table id="products-table">
        <thead><tr><th>ID</th><th>Ảnh</th><th>Tên sản phẩm</th><th>Danh mục</th><th>Giá</th><th>Mô tả</th><th>Thao tác</th></tr></thead>
        <tbody><!-- Loaded via JS --></tbody>
    </table>

    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Thêm Sản Phẩm</h2>
            <form id="productForm">
                <input type="hidden" id="productId">
                <div class="form-group"><label>Tên Sản Phẩm</label><input type="text" id="pName" required></div>
                <div class="form-group"><label>Danh Mục</label><select id="pCategory" required></select></div>
                <div class="form-group"><label>Giá</label><input type="number" id="pPrice" required></div>
                <div class="form-group"><label>Mô tả</label><textarea id="pDescription"></textarea></div>
                <div class="form-group"><label>Ảnh Sản Phẩm</label><input type="file" id="pImage" accept="image/*"></div>
                <div id="currentImageContainer"></div>
                <button type="submit" class="btn" style="width: 100%;">Lưu Lại</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const categories = await adminFetch('/categories');
            const select = document.getElementById('pCategory');
            select.innerHTML = '<option value="">Chọn danh mục</option>' + categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
            loadProducts();
        });
        async function loadProducts() {
            const data = await adminFetch('/products');
            const tbody = document.querySelector('#products-table tbody');
            tbody.innerHTML = data.map(p => `
                <tr><td>${p.id}</td><td><img src="${p.image}" width="50" height="40" style="object-fit: cover;"></td><td>${p.name}</td><td>${p.category ? p.category.name : 'N/A'}</td><td>${formatPrice(p.price)}</td><td>${p.description || ''}</td><td>
                    <button class="btn btn-warning" onclick='editProduct(${JSON.stringify(p)})'>Sửa</button>
                    <button class="btn btn-danger" onclick="deleteProduct(${p.id})">Xóa</button>
                </td></tr>
            `).join('');
        }
        function openModal(p = null) {
            document.getElementById('productModal').style.display = 'block';
            document.getElementById('modalTitle').innerText = p ? 'Sửa Sản Phẩm' : 'Thêm Sản Phẩm';
            document.getElementById('productId').value = p ? p.id : '';
            document.getElementById('pName').value = p ? p.name : '';
            document.getElementById('pCategory').value = (p && p.category) ? p.category.id : '';
            document.getElementById('pPrice').value = p ? p.price : '';
            document.getElementById('pDescription').value = p ? p.description : '';
        }
        function closeModal() { document.getElementById('productModal').style.display = 'none'; }
        document.getElementById('productForm').onsubmit = async (e) => {
            e.preventDefault();
            const id = document.getElementById('productId').value;
            const formData = new FormData();
            formData.append('name', document.getElementById('pName').value);
            formData.append('category_id', document.getElementById('pCategory').value);
            formData.append('price', document.getElementById('pPrice').value);
            formData.append('description', document.getElementById('pDescription').value);
            const imageFile = document.getElementById('pImage').files[0];
            if (imageFile) formData.append('image', imageFile);
            if (id) formData.append('_method', 'PUT');
            const url = id ? `/products/${id}` : '/products';
            const res = await adminFetch(url, { method: 'POST', body: formData, headers: {} });
            if (res) { closeModal(); loadProducts(); }
        }
    </script>
<?php include 'includes/footer.php'; ?>
