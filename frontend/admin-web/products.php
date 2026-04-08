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

<div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 30px;">
    <input type="text" id="filter-name" placeholder="Tìm tên bánh..." oninput="applyFilters()"
        style="padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
    <select id="filter-category" onchange="applyFilters()"
        style="padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
        <option value="">Tất cả danh mục</option>
    </select>
    <input type="number" id="filter-price" placeholder="Giá tối đa..." oninput="applyFilters()"
        style="padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
</div>

<table id="products-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Thao tác</th>
        </tr>
    </thead>
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

            <div class="form-group">
                <label>Giá (VNĐ)</label>
                <input type="number" id="pPrice" required placeholder="Ví dụ: 50000">
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="font-weight: 700; color: var(--primary-dark);">Mô tả ngắn (Hiện cạnh giá sản phẩm)</label>
                <textarea id="pDescription" placeholder="Nhập tóm tắt ngắn..."
                    style="width: 100%; height: 80px; padding: 10px; border-radius: 8px; border: 1px solid #ddd;"></textarea>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label>Hình Ảnh (1 Chính - 4 Phụ)</label>
                <div class="image-uploader-grid"
                    style="display: grid; grid-template-columns: 100px 1fr; gap: 15px; margin-top: 10px;">
                    <!-- Sub images -->
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div class="sub-img-box" onclick="document.getElementById('pSub0').click()">
                            <img id="pSub0_preview" src="https://via.placeholder.com/100"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                            <input type="file" id="pSub0" accept="image/*" style="display: none"
                                onchange="previewImage(this, 'pSub0_preview')">
                        </div>
                        <div class="sub-img-box" onclick="document.getElementById('pSub1').click()">
                            <img id="pSub1_preview" src="https://via.placeholder.com/100"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                            <input type="file" id="pSub1" accept="image/*" style="display: none"
                                onchange="previewImage(this, 'pSub1_preview')">
                        </div>
                        <div class="sub-img-box" onclick="document.getElementById('pSub2').click()">
                            <img id="pSub2_preview" src="https://via.placeholder.com/100"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                            <input type="file" id="pSub2" accept="image/*" style="display: none"
                                onchange="previewImage(this, 'pSub2_preview')">
                        </div>
                        <div class="sub-img-box" onclick="document.getElementById('pSub3').click()">
                            <img id="pSub3_preview" src="https://via.placeholder.com/100"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                            <input type="file" id="pSub3" accept="image/*" style="display: none"
                                onchange="previewImage(this, 'pSub3_preview')">
                        </div>
                    </div>
                    <!-- Main image -->
                    <div class="main-img-box" onclick="document.getElementById('pImage').click()"
                        style="height: 430px; border: 2px dashed #ddd; border-radius: 8px; cursor: pointer; position: relative;">
                        <img id="pMain_preview" src="https://via.placeholder.com/400"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                        <input type="file" id="pImage" accept="image/*" style="display: none"
                            onchange="previewImage(this, 'pMain_preview')">
                        <div
                            style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); background: rgba(0,0,0,0.5); color: #fff; padding: 5px 15px; border-radius: 20px; font-size: 12px;">
                            Ảnh Chính</div>
                    </div>
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="font-weight: 700; color: var(--primary-dark);">Thông tin sản phẩm (Hiện ở cuối trang sản
                    phẩm)</label>
                <div id="editor-container"
                    style="height: 250px; background: white; margin-top: 10px; border-radius: 8px;"></div>
            </div>

            <div style="margin-top: 60px;">
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-weight: 600;">Lưu
                    Lại Sản Phẩm</button>
            </div>
        </form>
    </div>
</div>

<style>
    .sub-img-box {
        width: 100px;
        height: 100px;
        border: 2px dashed #000;
        border-radius: 8px;
        cursor: pointer;
        overflow: hidden;
        background: #fdfdfd;
    }

    .main-img-box {
        border: 2.5px solid #000 !important;
    }

    .sub-img-box:hover,
    .main-img-box:hover {
        opacity: 0.8;
        background: #f0f7ff;
    }
</style>

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
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
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
        const selectModal = document.getElementById('pCategory');
        const selectFilter = document.getElementById('filter-category');

        if (Array.isArray(categories)) {
            // Populate Modal Select
            selectModal.innerHTML = '<option value="">Chọn danh mục</option>' +
                categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('');

            // Populate Filter Select
            selectFilter.innerHTML = '<option value="">Tất cả danh mục</option>' +
                categories.map(c => `<option value="${c.name}">${c.name}</option>`).join('');
        }

        loadProducts();
    });

    async function loadProducts() {
        console.log("Fetching products...");
        const data = await adminFetch('/admin/products');
        allProducts = Array.isArray(data) ? data : (data.data || []);
        applyFilters();
    }

    function applyFilters() {
        const nameTerm = document.getElementById('filter-name').value.toLowerCase();
        const categorySelect = document.getElementById('filter-category').value;
        const maxPrice = parseFloat(document.getElementById('filter-price').value) || Infinity;

        const filtered = allProducts.filter(p => {
            const matchName = p.name.toLowerCase().includes(nameTerm);
            const matchCategory = !categorySelect || (p.category && p.category.name === categorySelect);
            const matchPrice = (p.price || 0) <= maxPrice;
            return matchName && matchCategory && matchPrice;
        });

        renderTable(filtered);
    }

    function renderTable(dataToRender) {
        const tbody = document.querySelector('#products-table tbody');
        if (!tbody) return;

        if (dataToRender.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align: center;">Không tìm thấy sản phẩm nào.</td></tr>';
            return;
        }

        tbody.innerHTML = dataToRender.map(p => `
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

    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function openModal(p = null) {
        document.getElementById('productModal').style.display = 'block';
        document.getElementById('modalTitle').innerText = p ? 'Sửa Sản Phẩm' : 'Thêm Sản Phẩm';
        document.getElementById('productId').value = p ? p.id : '';
        document.getElementById('pName').value = p ? p.name : '';
        document.getElementById('pCategory').value = (p && p.category) ? p.category.id : '';
        document.getElementById('pPrice').value = p ? p.price : '';
        document.getElementById('pDescription').value = p ? (p.description || '') : '';

        // Set Quill content
        if (p && p.content) {
            quill.root.innerHTML = p.content;
        } else {
            quill.root.innerHTML = '';
        }

        // Set Previews
        document.getElementById('pMain_preview').src = p ? p.image : 'https://via.placeholder.com/400';

        // Sub images previews
        for (let i = 0; i < 4; i++) {
            const src = (p && p.sub_images && p.sub_images[i]) ? p.sub_images[i] : 'https://via.placeholder.com/100';
            document.getElementById(`pSub${i}_preview`).src = src;
        }

        // Reset files
        document.getElementById('pImage').value = '';
        for (let i = 0; i < 4; i++) document.getElementById(`pSub${i}`).value = '';
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
        formData.append('content', quill.root.innerHTML);

        // Main image
        const imageFile = document.getElementById('pImage').files[0];
        if (imageFile) formData.append('image', imageFile);

        // Sub images
        for (let i = 0; i < 4; i++) {
            const subFile = document.getElementById(`pSub${i}`).files[0];
            if (subFile) formData.append(`sub_image_${i}`, subFile);
        }

        const endpoint = id ? `/admin/products/${id}` : '/admin/products';
        const method = id ? 'POST' : 'POST'; // We use POST for both due to FormData (Multipart)

        // For updates, add _method spoofing if needed
        if (id) formData.append('_method', 'PUT');

        const res = await adminFetch(endpoint, { method, body: formData });
        if (res) { closeModal(); loadProducts(); }
    }

    window.onclick = function (event) {
        const modal = document.getElementById('productModal');
        if (event.target == modal) closeModal();
    }
</script>
<?php include 'includes/footer.php'; ?>