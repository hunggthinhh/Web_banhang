<?php
$pageTitle = "Chi tiết bánh";
include 'includes/header.php';
?>

<style>
    .product-detail-container {
        padding: 60px 0;
        max-width: 1400px;
        margin: 0 auto;
    }

    .gallery-layout {
        display: grid;
        grid-template-columns: 120px 1fr 1fr;
        gap: 40px;
    }

    .thumb-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .thumb-item {
        width: 90px;
        height: 90px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 1px solid transparent;
        transition: 0.3s;
    }

    .thumb-item.active {
        border-color: #000;
        border-width: 1px;
    }

    .thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .main-image-wrap {
        position: relative;
        background: #fff;
        border-radius: 25px;
        overflow: hidden;
        border: 2px solid #000;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
    }

    .main-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info {
        padding-left: 20px;
    }

    .info-badges {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
    }

    .badge-p {
        padding: 5px 15px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
    }

    .product-title {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        color: #001f3f;
        margin-bottom: 15px;
        font-weight: 900;
    }

    .product-price-v {
        font-size: 32px;
        color: #ff6b35;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .price-notice {
        font-size: 14px;
        color: #ff6b35;
        margin-bottom: 30px;
    }

    .product-desc {
        line-height: 1.8;
        color: #4a5568;
        margin-bottom: 35px;
        font-size: 16px;
    }

    .size-selection {
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .size-select {
        padding: 12px 25px;
        border: 1.5px solid #eee;
        border-radius: 10px;
        background: #f8fafc;
        width: 250px;
        font-weight: 600;
    }

    .qty-controls {
        display: flex;
        align-items: center;
        border: 1.5px solid #eee;
        border-radius: 10px;
        background: #fff;
        overflow: hidden;
    }

    .qty-btn {
        width: 45px;
        height: 50px;
        border: none;
        background: none;
        font-size: 18px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .qty-btn:hover {
        background: #f8fafc;
    }

    #qty-val {
        width: 60px;
        text-align: center;
        border: none;
        font-weight: 700;
        font-size: 18px;
    }

    .action-btns {
        display: grid;
        grid-template-columns: 140px 1fr;
        gap: 20px;
        margin-top: 40px;
    }

    .buy-btns {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .btn-cart {
        background: #001f3f;
        color: #fff;
        flex: 1;
        padding: 18px;
        border: none;
        border-radius: 12px;
    }

    .btn-buy-now {
        background: #ff0000ff;
        color: #fff;
        padding: 18px 40px;
        border-radius: 12px;
    }

    .content-rich-text h1,
    .content-rich-text h2,
    .content-rich-text h3 {
        color: #000000ff;
        margin-top: 25px;
        margin-bottom: 15px;
    }

    .content-rich-text p {
        margin-bottom: 20px;
    }

    .content-rich-text img {
        max-width: 100%;
        border-radius: 15px;
        margin: 20px 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 1);
    }
</style>

<div class="product-detail-container">
    <div id="product-hero"></div>
</div>

</div> <!-- Close the .container coming from header.php -->

<div style="background: #fff; width: 100%;">
    <div class="container">
        <div class="product-detail-container">
            <div id="product-detailed-info"></div>
        </div>
    </div>
</div>

<div class="container"> <!-- Re-open the .container for footer.php and next section -->
    <div class="product-detail-container" style="padding-top: 20px;">
        <div id="product-related-info"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const urlParams = new URLSearchParams(window.location.search);
            const slug = urlParams.get('slug');
            if (!slug) return;

            const data = await apiFetch(`/products/${slug}`);
            if (!data || !data.product) return;
            const product = data.product;

            // Update Breadcrumbs
            const breadcrumbs = document.querySelector('.breadcrumbs');
            if (breadcrumbs) {
                breadcrumbs.innerHTML = `
                <a href="index.php">Trang chủ</a> <span>/</span> 
                <a href="shop.php">Sản phẩm</a> <span>/</span> 
                <span>${product.name}</span>
            `;
            }

            const subImages = product.sub_images || [];
            const allImgs = [product.image, ...subImages].slice(0, 4);

            // Inject Hero Section (Top part)
            document.getElementById('product-hero').innerHTML = `
            <div class="gallery-layout">
                <div class="thumb-list">
                    ${allImgs.map((img, i) => `
                        <div class="thumb-item ${i === 0 ? 'active' : ''}" onmouseover="changeMainImg(this, '${img}')">
                            <img src="${img}">
                        </div>
                    `).join('')}
                    ${allImgs.length < 4 ? Array(4 - allImgs.length).fill().map(() => `
                        <div class="thumb-item"><img src="${product.image}"></div>
                    `).join('') : ''}
                </div>
                
                <div class="main-image-wrap">
                    <img src="${product.image}" id="main-view-img">
                </div>

                <div class="product-info">
                    <h1 class="product-title">${product.name}</h1>
                    <div class="product-price-v">${formatPrice(product.price)}</div>
                    <p class="price-notice">(Giá chưa bao gồm thuế VAT)</p>

                    <p class="product-desc">
                        ${product.description || 'Nơi mang đến những hương vị bánh ngọt ngào và tinh tế nhất...'}
                    </p>

                    <div style="background: #fff9f0; padding: 30px; border-radius: 20px;">
                        <div class="buy-btns">
                            <div class="qty-controls">
                                <button class="qty-btn" onclick="changeQty(-1)">-</button>
                                <input type="number" id="qty-val" value="1" min="1" oninput="if(this.value < 1) this.value = 1;">
                                <button class="qty-btn" onclick="changeQty(1)">+</button>
                            </div>
                            <button class="btn-cart" onclick="addCart(${product.id}, '${product.name}', ${product.price}, '${product.image}')">
                                Thêm vào giỏ hàng <i class="fas fa-shopping-bag" style="margin-left: 10px;"></i>
                            </button>
                        </div>
                        <div style="display: flex; gap: 15px; margin-top: 15px;">
                            <button class="btn-buy-now" onclick="buyNow(${product.id}, '${product.name}', ${product.price}, '${product.image}')" style="flex: 1; border: none; font-weight: 700;">Mua ngay</button>
                            <button style="flex: 1; background: #ffe5b4; border: 1.5px solid #f0c07d; border-radius: 12px; font-weight: 700; color: #7a5a3a; display: flex; align-items: center; justify-content: center; gap: 10px;">
                                Liên hệ tư vấn <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Zalo_logo_2019.svg" style="width: 24px;">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Inject Detailed Info Section (Full width part)
        document.getElementById('product-detailed-info').innerHTML = `
            <h2 style="font-family: 'Playfair Display', serif; font-size: 36px; color: #000; margin-bottom: 40px; text-align: left; letter-spacing: -0.5px;">Thông tin sản phẩm</h2>
            <div class="content-rich-text" style="font-family: 'Roboto', sans-serif; line-height: 2; color: #000; font-size: 18px; text-align: left;">
                ${product.content || '<p>Sản phẩm này hiện chưa có bài giới thiệu chi tiết. Vui lòng quay lại sau.</p>'}
            </div>
        `;

            const related = data.related || [];
            if (related.length > 0) {
                document.getElementById('product-related-info').innerHTML = `
                <div class="related-products" style="margin-top: 80px;">
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; color: #001f3f; margin-bottom: 35px; text-align: left; letter-spacing: -0.5px;">Sản phẩm liên quan</h2>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
                        ${related.map(r => `
                            <div style="border: 1px solid #eee; border-radius: 12px; overflow: hidden; background: #fff; cursor: pointer;" onclick="window.location.href='product.php?slug=${r.slug}'">
                                <img src="${r.image}" style="width: 100%; height: 200px; object-fit: cover;">
                                <div style="padding: 15px;">
                                    <h3 style="font-size: 16px; margin: 0 0 10px 0; color: #333;">${r.name}</h3>
                                    <div style="color: #ff0000ff; font-weight: bold;">${formatPrice(r.price)}</div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
            }
        });

        function changeMainImg(el, src) {
            document.getElementById('main-view-img').src = src;
            document.querySelectorAll('.thumb-item').forEach(item => item.classList.remove('active'));
            el.classList.add('active');
        }

        function changeQty(amt) {
            const input = document.getElementById('qty-val');
            let val = parseInt(input.value) + amt;
            if (val < 1) val = 1;
            input.value = val;
        }

        function addCart(id, name, price, image, silent = false) {
            const qtyVal = document.getElementById('qty-val');
            const qty = qtyVal ? parseInt(qtyVal.value) : 1;
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const idx = cart.findIndex(item => item.id === id);
            if (idx > -1) {
                cart[idx].quantity += qty;
            } else {
                cart.push({ id, name, price, image, quantity: qty });
            }
            localStorage.setItem('cart', JSON.stringify(cart));

            if (typeof updateCartBadge === 'function') updateCartBadge();

            if (!silent) {
                alert('Đã thêm sản phẩm vào giỏ hàng!');
            }
        }

        function buyNow(id, name, price, image) {
            addCart(id, name, price, image, true);
            window.location.href = 'cart.php';
        }
    </script>

    <?php include 'includes/footer.php'; ?>