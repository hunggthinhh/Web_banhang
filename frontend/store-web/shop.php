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

    /* Content Area Styles */


    .content-header {
        margin-bottom: 35px;
        border-bottom: 1.5px solid #f0c07d;
        padding-bottom: 20px;
    }

    .current-cat-title {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        color: var(--primary-dark);
        font-weight: 700;
    }

    /* Products Grid Responsiveness */
    @media (max-width: 991px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .shop-content {
            flex-direction: column;
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

    document.addEventListener('DOMContentLoaded', async () => {
        const categoriesContainer = document.getElementById('category-list');

        // Fetch Categories and Products
        allCategories = await apiFetch('/categories') || [];
        allProducts = await apiFetch('/products') || [];

        categoriesContainer.innerHTML = allCategories.map(cat => `
            <div class="category-item" onclick="scrollToSection('${cat.id}', this)">
                <img src="https://cdn-icons-png.flaticon.com/512/992/992751.png" alt="icon">
                ${cat.name}
            </div>
        `).join('');

        // Initial render (default order)
        renderSections();

        // Check for hash in URL and scroll
        if (window.location.hash) {
            const hash = window.location.hash;
            const catId = hash.replace('#section-', '');
            const targetElement = document.querySelector(`.category-item[onclick*='${catId}']`);
            if (targetElement) {
                setTimeout(() => {
                    scrollToSection(catId, targetElement);
                }, 500); // Give it a moment to render
            }
        }
    });

    function renderSections() {
        const productsGrid = document.getElementById('products-list');

        // Group products by category ID
        const grouped = {};
        allProducts.forEach(p => {
            const cid = p.category_id;
            if (!grouped[cid]) grouped[cid] = { name: p.category.name, products: [] };
            grouped[cid].products.push(p);
        });

        // Use natural order of categories
        let keys = allCategories.map(c => c.id.toString()).filter(id => grouped[id]);

        let html = '';
        if (keys.length === 0) {
            html = '<p style="text-align: center; color: #666; margin: 100px 0;">Hiện chưa có sản phẩm nào trong cửa hàng.</p>';
        } else {
            keys.forEach(cid => {
                const group = grouped[cid];
                html += `
                    <div class="category-section" id="section-${cid}" style="margin-bottom: 60px;">
                        <h2 class="section-title" style="font-family: 'Playfair Display', serif; font-size: 26px; margin-bottom: 30px; color: var(--primary-dark); border-bottom: 1.5px solid #f0c07d; padding-bottom: 15px;">
                            ${group.name}
                        </h2>
                        <div class="products-grid">
                            ${group.products.map(p => `
                                <div class="product-card" onclick="location.href='product.php?slug=${p.slug || p.id}'">
                                    <div class="card-image-wrap">
                                        <img src="${p.image}" alt="${p.name}">
                                    </div>
                                    <div class="card-body">
                                        <h3>${p.name}</h3>
                                        <p class="card-price">Giá từ: <span>${formatPrice(p.price)}</span></p>
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
                            `).join('')}
                        </div>
                    </div>
                `;
            });
        }

        productsGrid.innerHTML = html;
    }

    function scrollToSection(catId, element) {
        // Cập nhật trạng thái active cho sidebar
        document.querySelectorAll('.category-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');

        // Cuộn đến section mong muốn mà KHÔNG sắp xếp lại thứ tự
        const section = document.getElementById(`section-${catId}`);
        if (section) {
            const yOffset = -100; // Khoảng cách trừ hao cho header
            const y = section.getBoundingClientRect().top + window.pageYOffset + yOffset;
            window.scrollTo({ top: y, behavior: 'smooth' });
        }
    }
</script>

<?php include 'includes/footer.php'; ?>