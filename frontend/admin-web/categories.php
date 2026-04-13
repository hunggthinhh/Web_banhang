<?php 
$pageTitle = "Danh Mục"; 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
<style>
    .cat-name-cell {
        cursor: pointer;
        color: var(--primary-color, #8b5cf6);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
    }
    .cat-name-cell:hover {
        color: #7c3aed;
        transform: translateX(5px);
    }
    .product-details-row {
        background: #f9fafb;
        animation: fadeIn 0.3s ease;
    }
    .product-list-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
        padding: 15px;
    }
    .product-item-mini {
        display: flex;
        align-items: center;
        gap: 10px;
        background: white;
        padding: 8px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        border: 1px solid #eee;
    }
    .product-item-mini img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
    }
    .product-item-mini .p-info {
        display: flex;
        flex-direction: column;
    }
    .product-item-mini .p-name {
        font-size: 0.9rem;
        font-weight: 500;
        color: #374151;
    }
    .product-item-mini .p-price {
        font-size: 0.8rem;
        color: #8b5cf6;
        font-weight: 600;
    }
    .loading-products, .no-products {
        padding: 20px;
        text-align: center;
        color: #6b7280;
        font-style: italic;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
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
                    <td>
                        <div class="cat-name-cell" onclick="toggleProducts(${c.id}, this)">
                            <i class="fas fa-chevron-right"></i>
                            <strong>${c.name}</strong>
                        </div>
                    </td>
                    <td><span class="badge">${c.products_count || 0}</span></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editCategory(${c.id})"><i class="fas fa-edit"></i> Sửa</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteCategory(${c.id})"><i class="fas fa-trash"></i> Xóa</button>
                    </td>
                </tr>
            `).join('');
        }

        async function toggleProducts(id, element) {
            const row = element.closest('tr');
            const icon = element.querySelector('i');
            let productRow = row.nextElementSibling;
            
            // Check if already expanded
            if (productRow && productRow.classList.contains('product-details-row')) {
                const isHidden = productRow.style.display === 'none';
                productRow.style.display = isHidden ? 'table-row' : 'none';
                icon.className = isHidden ? 'fas fa-chevron-down' : 'fas fa-chevron-right';
                return;
            }

            // Create new row
            productRow = document.createElement('tr');
            productRow.className = 'product-details-row';
            productRow.innerHTML = `<td colspan="4"><div class="loading-products"><i class="fas fa-spinner fa-spin"></i> Đang tải sản phẩm...</div></td>`;
            row.after(productRow);
            icon.className = 'fas fa-chevron-down';

            // Fetch products
            try {
                const products = await adminFetch(`/products?category_id=${id}`);
                if (products && products.length > 0) {
                    productRow.innerHTML = `
                        <td colspan="4">
                            <div class="product-list-container">
                                ${products.map(p => `
                                    <div class="product-item-mini">
                                        <img src="${p.image}" alt="${p.name}">
                                        <div class="p-info">
                                            <span class="p-name">${p.name}</span>
                                            <span class="p-price">${formatPrice(p.price)}</span>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </td>
                    `;
                } else {
                    productRow.innerHTML = `<td colspan="4"><div class="no-products">Không có sản phẩm nào trong danh mục này.</div></td>`;
                }
            } catch (err) {
                productRow.innerHTML = `<td colspan="4"><div class="no-products text-danger">Lỗi khi tải sản phẩm.</div></td>`;
            }
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
