<?php 
$pageTitle = "Sản Phẩm"; 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
    <!-- Quill Rich Text Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Danh Sách Sản Phẩm</h1>
        <button class="btn btn-primary" onclick="openModal()">Thêm Sản Phẩm</button>
    </div>
    <table id="products-table">
        <thead><tr><th>ID</th><th>Ảnh</th><th>Tên sản phẩm</th><th>Danh mục</th><th>Giá</th><th>Mô tả</th><th>Thao tác</th></tr></thead>
        <tbody><!-- Loaded via JS --></tbody>
    </table>

    <div id="productModal" class="modal">
        <div class="modal-content" style="max-width: 800px;">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Thêm Sản Phẩm</h2>
            <form id="productForm">
                <input type="hidden" id="productId">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Tên Sản Phẩm</label>
                        <input type="text" id="pName" required placeholder="Nhập tên bánh...">
                    </div>
                    <div class="form-group">
                        <label>Danh Mục</label>
                        <select id="pCategory" required></select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Giá (VNĐ)</label>
                        <input type="number" id="pPrice" required placeholder="Ví dụ: 50000">
                    </div>
                    <div class="form-group">
                        <label>Ảnh Sản Phẩm</label>
                        <input type="file" id="pImage" accept="image/*">
                        <div id="currentImageContainer" style="margin-top: 10px;"></div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label>Mô tả chi tiết</label>
                    <div id="editor-container" style="height: 250px; background: white;"></div>
                </div>

                <div style="margin-top: 60px;">
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-weight: 600;">Lưu Lại Sản Phẩm</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let allProducts = [];
        let quill;

        document.addEventListener('DOMContentLoaded', async () => {
            console.log("Loading initial data...");
            // Initialize Quill
            try {
                quill = new Quill('#editor-container', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['link', 'image'],
                            ['clean']
                        ]
                    },
                    placeholder: 'Nhập mô tả sản phẩm tại đây...'
                });
            } catch (e) {
                console.error("Quill initialization failed:", e);
            }

            // Load Categories for select
            const categories = await adminFetch('/admin/categories');
            const select = document.getElementById('pCategory');
            if (select && Array.isArray(categories)) {
                select.innerHTML = '<option value="">Chọn danh mục</option>' + 
                    categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
            } else {
                console.warn("Categories data format invalid or empty:", categories);
            }
            
            loadProducts();
        });

        async function loadProducts() {
            console.log("Fetching products...");
            const data = await adminFetch('/admin/products');
            allProducts = Array.isArray(data) ? data : (data.data || []);
            
            const tbody = document.querySelector('#products-table tbody');
            if (!tbody) return;

            if (allProducts.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align: center;">Chưa có sản phẩm nào.</td></tr>';
                return;
            }

            tbody.innerHTML = allProducts.map(p => `
                <tr>
                    <td>${p.id}</td>
                    <td><img src="${p.image}" width="60" height="45" style="object-fit: cover; border-radius: 6px;"></td>
                    <td><strong>${p.name}</strong></td>
                    <td><span class="badge" style="background: #e9ecef; padding: 4px 8px; border-radius: 4px; font-size: 12px;">${p.category ? p.category.name : 'N/A'}</span></td>
                    <td><span style="color: var(--primary); font-weight: bold;">${formatPrice(p.price || 0)}</span></td>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        ${(p.description || '-').replace(/<[^>]*>?/gm, '')}
                    </td>
                    <td>
                        <button class="btn btn-warning" onclick="editProduct(${p.id})">Sửa</button>
                        <button class="btn btn-danger" onclick="deleteProduct(${p.id})">Xóa</button>
                    </td>
                </tr>
            `).join('');
        }

        function editProduct(id) {
            const p = allProducts.find(item => item.id === id);
            if (p) openModal(p);
        }

        async function deleteProduct(id) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
                const res = await adminFetch(`/admin/products/${id}`, { method: 'DELETE' });
                if (res) loadProducts();
            }
        }

        function openModal(p = null) {
            document.getElementById('productModal').style.display = 'block';
            document.getElementById('modalTitle').innerText = p ? 'Sửa Sản Phẩm' : 'Thêm Sản Phẩm';
            document.getElementById('productId').value = p ? p.id : '';
            document.getElementById('pName').value = p ? p.name : '';
            document.getElementById('pCategory').value = (p && p.category) ? p.category.id : '';
            document.getElementById('pPrice').value = p ? p.price : '';
            
            // Set Quill content
            if (p && p.description) {
                quill.root.innerHTML = p.description;
            } else {
                quill.root.innerHTML = '';
            }

            document.getElementById('currentImageContainer').innerHTML = p ? 
                `<img src="${p.image}" width="100" style="border-radius: 8px; border: 1px solid #ddd;">` : '';
        }

        function closeModal() { document.getElementById('productModal').style.display = 'none'; }

        document.getElementById('productForm').onsubmit = async (e) => {
            e.preventDefault();
            const id = document.getElementById('productId').value;
            const formData = new FormData();
            formData.append('name', document.getElementById('pName').value);
            formData.append('category_id', document.getElementById('pCategory').value);
            formData.append('price', document.getElementById('pPrice').value);
            
            // Get HTML from Quill
            formData.append('description', quill.root.innerHTML);
            
            const imageFile = document.getElementById('pImage').files[0];
            if (imageFile) formData.append('image', imageFile);
            
            const endpoint = id ? `/admin/products/${id}` : '/admin/products';
            const method  = id ? 'PUT' : 'POST';
            const res = await adminFetch(endpoint, { method, body: formData });
            if (res) { closeModal(); loadProducts(); }
        }

        window.onclick = function(event) {
            const modal = document.getElementById('productModal');
            if (event.target == modal) closeModal();
        }
    </script>
<?php include 'includes/footer.php'; ?>
