<?php
$pageTitle = "Chi tiết bánh";
include 'includes/header.php';
?>

<style>
    .site-footer {
        margin-top: 0 !important;
    }

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
        border: 2.5px solid #001f3f;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.08);
        height: 400px;
        /* Adjusted for 4 thumbnails: 4*90 + 3*10 = 390px */
    }

    .main-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s ease;
    }

    .product-info {
        padding: 30px;
        background: #fff4e6;
        border-radius: 30px;
        border: 1px solid #fce8d5;
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.03);
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
        color: var(--name-color);
        margin-bottom: 15px;
        font-weight: 900;
    }

    .product-price-v {
        font-size: 32px;
        color: var(--price-color);
        font-weight: 700;
        margin-bottom: 10px;
    }

    .price-notice {
        font-size: 14px;
        color: var(--price-color);
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

    .star-rating-display i {
        color: #ffd700;
        font-size: 16px;
    }

    .review-filter-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 25px;
        padding: 15px;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
    }

    .review-filter-btn {
        padding: 8px 16px;
        border: 1px solid #ddd;
        background: #fff;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        color: #555;
        transition: 0.3s;
    }

    .review-filter-btn.active {
        background: #001f3f;
        color: #fff;
        border-color: #001f3f;
    }

    .review-filter-btn:hover:not(.active) {
        background: #f9f9f9;
    }

    .review-item {
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }

    .review-item:last-child {
        border-bottom: none;
    }

    .review-media img,
    .review-media video {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 10px;
        cursor: pointer;
        border: 1px solid #ddd;
        transition: 0.2s;
    }

    .review-media img:hover {
        filter: brightness(0.9);
    }

    /* Image Lightbox Modal */
    #imageModal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(5px);
    }

    #imageModal img {
        max-width: 90%;
        max-height: 90vh;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    #imageModal .close-img {
        position: absolute;
        top: 20px;
        right: 30px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    #imageModal .close-img:hover {
        color: #ccc;
    }
</style>

<div class="product-detail-container">
    <div id="product-hero"></div>
</div>

</div> <!-- Close the .container coming from header.php -->

<div style="background: linear-gradient(to bottom, #fff 0%, #fafafa 100%); width: 100%;">
    <div class="container">
        <div class="product-detail-container">
            <div id="product-detailed-info"></div>
            <div id="product-reviews" style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 40px;"></div>
        </div>
    </div>
</div>

<div style="background: #fff4e6; width: 100%; padding: 80px 0 0 0;">
    <div class="container" style="padding-bottom: 80px;">
        <div id="product-related-info"></div>
    </div>
</div>
<div class="container" style="background: #fff4e6; max-width: none; padding: 0;">
    <!-- Re-open container with cream bg to bridge the gap to footer -->

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
                        <div class="thumb-item ${i === 0 ? 'active' : ''}" onclick="changeMainImg(this, '${img}')">
                            <img src="${img}">
                        </div>
                    `).join('')}
                    ${allImgs.length < 4 ? Array(4 - allImgs.length).fill().map(() => `
                        <div class="thumb-item" onclick="changeMainImg(this, '${product.image}')"><img src="${product.image}"></div>
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

                    <div class="buy-section-wrapper" style="margin-top: 30px; padding-top: 10px;">
                        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: nowrap; height: 54px;">
                            <!-- Quantity Controls -->
                            <div class="qty-controls" style="flex: 0 0 auto; height: 54px !important; min-height: 54px !important; max-height: 54px !important; margin: 0 !important; padding: 0 !important; box-sizing: border-box !important; border: 1px solid #e2e8f0; border-radius: 12px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.03); display: flex; align-items: center; overflow: hidden;">
                                <button class="qty-btn" onclick="changeQty(-1)" style="width: 48px; height: 100%; border: none; background: transparent; font-size: 20px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; margin: 0; padding: 0;">-</button>
                                <input type="number" id="qty-val" value="1" min="1" readonly style="width: 50px; border: none; text-align: center; font-size: 18px; font-weight: 700; background: transparent; height: 100%; display: flex; align-items: center; justify-content: center; padding: 0; margin: 0;">
                                <button class="qty-btn" onclick="changeQty(1)" style="width: 48px; height: 100%; border: none; background: transparent; font-size: 20px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; margin: 0; padding: 0;">+</button>
                            </div>
                            
                            <!-- Add to Cart Icon Button -->
                            <button class="btn-add-cart" onclick="addCart(${product.id}, '${product.name}', ${product.price}, '${product.image}')" 
                                    style="width: 54px; height: 54px !important; min-height: 54px !important; max-height: 54px !important; margin: 0 !important; padding: 0 !important; flex-shrink: 0; box-sizing: border-box !important; border: 1px solid #e2e8f0; border-radius: 12px; background: #fff; color: #001f3f; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.03);">
                                <i class="fas fa-shopping-basket" style="font-size: 20px; margin: 0; padding: 0;"></i>
                            </button>
                            
                            <!-- Buy Now Button -->
                            <button class="btn-buy-now" onclick="buyNow(${product.id}, '${product.name}', ${product.price}, '${product.image}')" 
                                    style="flex: 1; height: 54px !important; min-height: 54px !important; max-height: 54px !important; margin: 0 !important; padding: 0 !important; box-sizing: border-box !important; background: linear-gradient(135deg, #f03e3e 0%, #d62828 100%); color: #fff; border: none; border-radius: 12px; font-weight: 800; font-size: 16px; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 15px rgba(240, 62, 62, 0.25); text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; justify-content: center;">
                                Mua ngay
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

            renderReviews(product);

            const related = data.related || [];
            if (related.length > 0) {
                document.getElementById('product-related-info').innerHTML = `
                <div class="related-products" style="margin-top: 20px;">
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

        // --- Reviews Logic ---
        let allProductReviews = [];

        function renderReviews(product) {
            allProductReviews = product.reviews || [];

            let filterHtml = `
                <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; color: #000; margin-bottom: 20px; text-align: left; letter-spacing: -0.5px;">Đánh giá sản phẩm</h2>
            `;

            if (allProductReviews.length > 0) {
                const allCount = allProductReviews.length;
                const mediaCount = allProductReviews.filter(r => (r.images && r.images.length > 0) || (r.videos && r.videos.length > 0)).length;
                const star5Count = allProductReviews.filter(r => r.rating === 5).length;
                const star4Count = allProductReviews.filter(r => r.rating === 4).length;
                const star3Count = allProductReviews.filter(r => r.rating === 3).length;
                const star2Count = allProductReviews.filter(r => r.rating === 2).length;
                const star1Count = allProductReviews.filter(r => r.rating === 1).length;

                filterHtml += `
                <div class="review-filter-container">
                    <button class="review-filter-btn active" id="btn-filter-all" onclick="applyReviewFilter('all', this)">Tất cả ${allCount}</button>
                    <button class="review-filter-btn" id="btn-filter-media" onclick="applyReviewFilter('media', this)">Có Hình ảnh / Video ${mediaCount}</button>
                    
                    <select id="star-filter-select" class="review-filter-btn" style="outline: none; cursor: pointer; padding-right: 15px;" onchange="applyReviewFilter(parseInt(this.value), this)">
                        <option value="" disabled selected hidden>Lọc theo sao ⭐</option>
                        <option value="5">⭐⭐⭐⭐⭐ ${star5Count}</option>
                        <option value="4">⭐⭐⭐⭐ ${star4Count}</option>
                        <option value="3">⭐⭐⭐ ${star3Count}</option>
                        <option value="2">⭐⭐ ${star2Count}</option>
                        <option value="1">⭐ ${star1Count}</option>
                    </select>
                </div>
                `;
            }

            filterHtml += `<div id="reviews-list-content"></div>`;
            document.getElementById('product-reviews').innerHTML = filterHtml;

            renderFilteredReviews(allProductReviews);
        }

        function applyReviewFilter(filterType, btnElement) {
            // Update active button styling
            document.querySelectorAll('.review-filter-btn').forEach(btn => btn.classList.remove('active'));
            if (btnElement) {
                btnElement.classList.add('active');
            }

            // Reset select if clicking other buttons
            if (typeof filterType !== 'number') {
                const select = document.getElementById('star-filter-select');
                if (select) select.value = "";
            }

            let filtered = [];
            if (filterType === 'all') {
                filtered = allProductReviews;
            } else if (filterType === 'media') {
                filtered = allProductReviews.filter(r => (r.images && r.images.length > 0) || (r.videos && r.videos.length > 0));
            } else {
                // Number (star rating)
                filtered = allProductReviews.filter(r => r.rating === filterType);
            }

            renderFilteredReviews(filtered);
        }

        function renderFilteredReviews(reviewsList) {
            const container = document.getElementById('reviews-list-content');
            if (!container) return;

            let html = '<div class="reviews-list">';

            if (reviewsList.length === 0) {
                html += `<p style="color: #666; font-style: italic;">Không có đánh giá nào phù hợp với bộ lọc này.</p>`;
            } else {
                reviewsList.forEach(r => {
                    const stars = Array(5).fill(0).map((_, i) => i < r.rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>').join('');
                    const name = r.user ? r.user.name : (r.guest_name || 'Khách hàng');
                    const date = new Date(r.created_at).toLocaleDateString('vi-VN');

                    const fixUrl = (url) => url.replace(/http:\/\/(localhost|127\.0\.0\.1)(:\d+)?/, window.location.origin);

                    let mediaHtml = '';
                    if (r.images && r.images.length > 0) {
                        r.images.forEach(img => { 
                            mediaHtml += `<img src="${fixUrl(img)}" onclick="openMediaModal('${fixUrl(img)}', 'image')">`; 
                        });
                    }
                    if (r.videos && r.videos.length > 0) {
                        r.videos.forEach(vid => { 
                            mediaHtml += `
                            <div style="position: relative; display: inline-block; cursor: pointer; margin-right: 10px;" onclick="openMediaModal('${fixUrl(vid)}', 'video')">
                                <video src="${fixUrl(vid)}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; display: block;" 
                                       onloadedmetadata="this.nextElementSibling.querySelector('span').innerText = Math.floor(this.duration / 60) + ':' + (Math.floor(this.duration % 60) < 10 ? '0' : '') + Math.floor(this.duration % 60)"></video>
                                <div style="position: absolute; bottom: 5px; right: 5px; background: rgba(0,0,0,0.65); color: white; font-size: 11px; padding: 2px 5px; border-radius: 4px; pointer-events: none; display: flex; align-items: center; gap: 4px; font-weight: bold;">
                                    <i class="fas fa-play" style="font-size: 9px;"></i> <span>0:00</span>
                                </div>
                            </div>`; 
                        });
                    }

                    html += `
                        <div class="review-item">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <strong style="font-size: 16px; color: #001f3f;">${name}</strong>
                                <span style="color: #999; font-size: 13px;">${date}</span>
                            </div>
                            <div class="star-rating-display" style="margin-bottom: 10px;">${stars}</div>
                            <p style="margin: 0 0 10px 0; color: #444; line-height: 1.6; font-size: 15px;">${r.comment || ''}</p>
                            ${mediaHtml ? `<div class="review-media">${mediaHtml}</div>` : ''}
                        </div>
                    `;
                });
            }

            html += `</div>`;
            container.innerHTML = html;
        }
        function openMediaModal(src, type) {
            const img = document.getElementById('lightbox-img');
            const vid = document.getElementById('lightbox-video');
            
            if (type === 'image') {
                img.src = src;
                img.style.display = 'block';
                vid.style.display = 'none';
                vid.pause();
            } else {
                vid.src = src;
                vid.style.display = 'block';
                img.style.display = 'none';
            }
            document.getElementById('mediaModal').style.display = 'flex';
        }

        function closeMediaModal() {
            document.getElementById('mediaModal').style.display = 'none';
            document.getElementById('lightbox-img').src = '';
            document.getElementById('lightbox-video').src = '';
            document.getElementById('lightbox-video').pause();
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && document.getElementById('mediaModal').style.display === 'flex') {
                closeMediaModal();
            }
        });
    </script>

    <!-- Media Modal -->
    <div id="mediaModal" onclick="closeMediaModal()" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9); justify-content: center; align-items: center;">
        <span class="close-img" style="position: absolute; top: 15px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; cursor: pointer;">&times;</span>
        <img id="lightbox-img" src="" onclick="event.stopPropagation()" style="max-width: 90%; max-height: 90vh; border-radius: 8px; display: none;">
        <video id="lightbox-video" src="" controls autoplay onclick="event.stopPropagation()" style="max-width: 90%; max-height: 90vh; border-radius: 8px; display: none;"></video>
    </div>

    <?php include 'includes/footer.php'; ?>