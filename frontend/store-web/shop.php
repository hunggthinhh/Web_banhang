<?php
$pageTitle = "Sản phẩm";
include 'includes/header.php';
?>

<div class="shop-container">
    <aside class="shop-sidebar">
        <h2 class="sidebar-title">Sản phẩm</h2>
        <div id="category-list" class="category-menu">
            <!-- Loaded via JS -->
            <div class="category-skeleton"></div>
            <div class="category-skeleton"></div>
        </div>
    </aside>

    <main class="shop-content">
        <div class="shop-toolbar">
            <div class="toolbar-left">
                <h2 id="current-category-name" class="current-cat-title">Tất cả sản phẩm</h2>
            </div>
            <div class="toolbar-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="shop-search" placeholder="Tìm tên bánh..." oninput="handleSearch(this.value)">
                </div>
                <div class="sort-controls">
                    <span>Sắp xếp:</span>
                    <div class="select-wrapper">
                        <select id="sort-select" onchange="handleSortChange(this.value)">
                            <option value="latest">Mới nhất</option>
                            <option value="price_asc">Giá: Thấp đến Cao</option>
                            <option value="price_desc">Giá: Cao đến Thấp</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div id="products-list">
            <!-- Loaded via JS -->
        </div>
    </main>
</div>

<style>
    :root {
        --primary-dark: #001f3f;
        --accent-orange: #ff6b35;
        --soft-bg: #fff9f0;
        --border-color: #f0ddd1;
    }

    .shop-container {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 40px;
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Sidebar Styles */
    .shop-sidebar {
        position: sticky;
        top: 100px;
        height: max-content;
        align-self: start;
    }
    
    .sidebar-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 900;
        color: var(--primary-dark);
        margin-bottom: 40px;
    }

    .category-menu {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .category-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 18px 25px;
        background: #fff;
        border: 1.5px solid #eee;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #4a5568;
        font-size: 14px;
    }

    .category-item img {
        width: 24px;
        height: 24px;
        opacity: 0.6;
    }

    .category-item:hover {
        border-color: var(--accent-orange);
        background: var(--soft-bg);
        transform: translateX(5px);
    }

    .category-item.active {
        background: var(--soft-bg);
        border-color: #ff6b35;
        color: var(--primary-dark);
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.1);
    }

    /* Toolbar Styles */
    .shop-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1.5px solid #f0ddd1;
        gap: 20px;
    }

    .toolbar-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    /* Search Box Styles */
    .search-box {
        position: relative;
        display: flex;
        align-items: center;
        background: #fff;
        border: 1.5px solid #d1d5db;
        border-radius: 12px;
        padding: 0 15px;
        transition: all 0.3s ease;
        width: 280px;
    }

    .search-box:focus-within {
        border-color: var(--accent-orange);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
    }

    .search-box i {
        color: #9ca3af;
        margin-right: 10px;
    }

    .search-box input {
        border: none;
        outline: none;
        padding: 10px 0;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        color: var(--primary-dark);
        width: 100%;
        font-weight: 500;
    }

    .current-cat-title {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        color: var(--primary-dark);
        margin: 0;
    }

    .sort-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: #666;
        font-weight: 600;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        padding: 8px 30px 8px 12px;
        border: 1.5px solid var(--primary-dark);
        border-radius: 10px;
        background: #fff;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: var(--primary-dark);
        cursor: pointer;
        appearance: none;
        outline: none;
        transition: 0.3s;
        font-size: 13px;
    }

    .select-wrapper::after {
        content: '\f107';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: var(--primary-dark);
    }

    /* Products Grid Responsiveness */
    @media (max-width: 1024px) {
        .shop-toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .toolbar-right {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }
        .search-box {
            width: 100%;
        }
    }

    @media (max-width: 991px) {
        .shop-container {
            grid-template-columns: 1fr;
        }
        .shop-sidebar {
            position: relative;
            top: 0;
            margin-bottom: 30px;
        }
        .category-menu {
            flex-direction: row;
            overflow-x: auto;
            padding-bottom: 15px;
            white-space: nowrap;
        }
    }

    @media (max-width: 600px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    let allProducts = [];
    let allCategories = [];
    let currentCategoryId = 'all';
    let currentSort = 'latest';
    let currentSearch = '';

    document.addEventListener('DOMContentLoaded', async () => {
        const categoriesContainer = document.getElementById('category-list');

        // Fetch Categories and Products
        allCategories = await apiFetch('/categories') || [];
        allProducts = await apiFetch('/products') || [];

        const categoriesHtml = [
            `<div class="category-item active" id="cat-item-all" onclick="handleAllClick(this)">
                <img src="https://cdn-icons-png.flaticon.com/512/992/992751.png" alt="icon">
                Tất cả sản phẩm
            </div>`,
            ...allCategories.map(cat => `
                <div class="category-item" id="cat-item-${cat.id}" onclick="handleCategoryClick('${cat.id}', this)">
                    <img src="https://cdn-icons-png.flaticon.com/512/992/992751.png" alt="icon">
                    ${cat.name}
                </div>
            `)
        ].join('');

        categoriesContainer.innerHTML = categoriesHtml;

        // Initial render
        renderProducts();

        // Check for hash in URL
        if (window.location.hash) {
            const hash = window.location.hash;
            const catId = hash.replace('#section-', '');
            const targetElement = document.getElementById(`cat-item-${catId}`);
            if (targetElement) {
                setTimeout(() => handleCategoryClick(catId, targetElement), 500);
            }
        }
    });

    function handleAllClick(element) {
        currentCategoryId = 'all';
        currentSort = 'latest';
        currentSearch = '';
        document.getElementById('sort-select').value = 'latest';
        document.getElementById('shop-search').value = '';
        
        updateActiveUI('all', element);
        renderProducts();
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function handleCategoryClick(catId, element) {
        // Reset search when clicking specific categories for better UX
        currentSearch = '';
        document.getElementById('shop-search').value = '';

        // Reset to default grouped view to show all sections
        if (currentCategoryId !== 'all' || currentSort !== 'latest') {
            currentCategoryId = 'all';
            currentSort = 'latest';
            document.getElementById('sort-select').value = 'latest';
            renderProducts();
        }

        updateActiveUI(catId, element);
        scrollToSection(catId);
    }

    function handleSearch(query) {
        currentSearch = query.trim().toLowerCase();
        renderProducts();
    }

    function updateActiveUI(catId, element) {
        document.querySelectorAll('.category-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');
        
        const catName = (catId === 'all') ? 'Tất cả sản phẩm' : element.innerText.trim();
        document.getElementById('current-category-name').innerText = catName;
    }

    function scrollToSection(catId) {
        const section = document.getElementById(`section-${catId}`);
        if (section) {
            const yOffset = -120;
            const y = section.getBoundingClientRect().top + window.pageYOffset + yOffset;
            window.scrollTo({ top: y, behavior: 'smooth' });
        }
    }

    function handleSortChange(sortVal) {
        currentSort = sortVal;
        renderProducts();
    }

    function getProcessedProducts() {
        // Filter by Category
        let filtered = (currentCategoryId === 'all') 
            ? [...allProducts] 
            : allProducts.filter(p => p.category_id.toString() === currentCategoryId.toString());

        // Filter by Search
        if (currentSearch) {
            filtered = filtered.filter(p => p.name.toLowerCase().includes(currentSearch));
        }

        // Sort
        if (currentSort === 'latest') {
            filtered.sort((a, b) => b.id - a.id);
        } else if (currentSort === 'price_asc') {
            filtered.sort((a, b) => a.price - b.price);
        } else if (currentSort === 'price_desc') {
            filtered.sort((a, b) => b.price - a.price);
        }

        return filtered;
    }

    function renderProducts() {
        const productsContainer = document.getElementById('products-list');
        const processed = getProcessedProducts();

        if (processed.length === 0) {
            productsContainer.innerHTML = `
                <div style="text-align: center; color: #666; margin: 100px 0;">
                    <i class="fas fa-search" style="font-size: 40px; color: #ddd; margin-bottom: 20px; display: block;"></i>
                    <p>Không tìm thấy sản phẩm nào phù hợp với từ khóa "${currentSearch}".</p>
                </div>`;
            return;
        }

        // Nếu là trạng thái mặc định (Tất cả + Mới nhất + Không search), hiển thị theo Section
        if (currentCategoryId === 'all' && currentSort === 'latest' && !currentSearch) {
            renderGroupedSections(processed, productsContainer);
        } else {
            // Ngược lại hiển thị Grid phẳng
            renderFlatGrid(processed, productsContainer);
        }
    }

    function renderGroupedSections(products, container) {
        const grouped = {};
        products.forEach(p => {
            const cid = p.category_id;
            if (!grouped[cid]) grouped[cid] = { name: p.category.name, products: [] };
            grouped[cid].products.push(p);
        });

        let keys = allCategories.map(c => c.id.toString()).filter(id => grouped[id]);

        let html = keys.map(cid => {
            const group = grouped[cid];
            return `
                <div class="category-section" id="section-${cid}" style="margin-bottom: 60px;">
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 22px; margin-bottom: 25px; color: var(--primary-dark); padding-bottom: 10px; border-bottom: 1px dashed #f0c07d;">
                        ${group.name}
                    </h3>
                    <div class="products-grid">
                        ${group.products.map(p => productCardHtml(p)).join('')}
                    </div>
                </div>
            `;
        }).join('');

        container.innerHTML = html;
    }

    function renderFlatGrid(products, container) {
        container.innerHTML = `
            <div class="products-grid">
                ${products.map(p => productCardHtml(p)).join('')}
            </div>
        `;
    }

    function productCardHtml(p) {
        return `
            <div class="product-card" onclick="location.href='product.php?slug=${p.slug || p.id}'">
                <div class="card-image-wrap">
                    <img src="${p.image}" alt="${p.name}">
                </div>
                <div class="card-body">
                    <h3>${p.name}</h3>
                    <p class="card-price">Giá: <span>${formatPrice(p.price)}</span></p>
                    <div style="display: flex; gap: 10px; align-items: center; margin-top: 15px;">
                        <button class="btn-add-cart" onclick="event.stopPropagation(); addCart(${p.id}, '${p.name}', ${p.price}, '${p.image}')" 
                                style="width: 45px; height: 45px; padding: 0; border-radius: 50%; flex-shrink: 0; background:#f0f4f8; color:#001f3f; border:1.5px solid #d1d5db; display:flex; align-items:center; justify-content:center;">
                            <i class="fas fa-shopping-basket" style="font-size: 18px;"></i>
                        </button>
                        <button onclick="event.stopPropagation(); buyNow(${p.id}, '${p.name}', ${p.price}, '${p.image}')" 
                                style="flex: 1; height: 45px; background: #e53e3e; color: #fff; border: none; border-radius: 25px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.3s ease;">
                            Mua ngay
                        </button>
                    </div>
                </div>
            </div>
        `;
    }
</script>

<?php include 'includes/footer.php'; ?>