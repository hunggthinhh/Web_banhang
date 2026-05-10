<?php 
$pageTitle = "Quản Lý Đánh Giá"; 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Danh Sách Đánh Giá Sản Phẩm</h1>
    </div>
    
    <div style="overflow-x: auto; background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <table id="reviews-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sản Phẩm</th>
                    <th>Khách Hàng</th>
                    <th>Số Sao</th>
                    <th>Nội Dung</th>
                    <th>Media (Ảnh/Video)</th>
                    <th>Ngày Đăng</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody><!-- Loaded via JS --></tbody>
        </table>
    </div>

    <!-- Media Modal -->
    <div id="mediaModal" class="modal" onclick="closeMediaModal()" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9); justify-content: center; align-items: center;">
        <span class="close" style="position: absolute; top: 20px; right: 30px; font-size: 40px; color: white; cursor: pointer;">&times;</span>
        <img id="lightbox-img" src="" style="max-width: 90%; max-height: 90vh; border-radius: 12px; margin: auto; display: none; margin-top: 5vh;" onclick="event.stopPropagation()">
        <video id="lightbox-video" src="" controls autoplay style="max-width: 90%; max-height: 90vh; border-radius: 12px; margin: auto; display: none; margin-top: 5vh;" onclick="event.stopPropagation()"></video>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', loadReviews);

        async function loadReviews() {
            const tbody = document.querySelector('#reviews-table tbody');
            try {
                const reviews = await adminFetch('/admin/reviews');
                
                if (!reviews || reviews.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 40px; color: #888;">Chưa có đánh giá nào từ khách hàng.</td></tr>';
                    return;
                }

                tbody.innerHTML = reviews.map(r => {
                    const stars = Array(5).fill(0).map((_, i) => i < r.rating ? '⭐' : '☆').join('');
                    const productName = r.product ? r.product.name : 'Sản phẩm đã bị xóa';
                    const userName = r.user ? r.user.name : (r.guest_name || 'Khách vãng lai');
                    
                    const fixUrl = (url) => url.replace(/http:\/\/(localhost|127\.0\.0\.1)(:\d+)?/, window.location.origin);
                    
                    let mediaHtml = '';
                    if (r.images && r.images.length > 0) {
                        mediaHtml += `<span style="color: #1976d2; font-weight: bold;">${r.images.length} Ảnh</span><br>`;
                        r.images.forEach(img => {
                            mediaHtml += `<img src="${fixUrl(img)}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; margin: 2px; cursor: pointer; border: 1px solid #ddd;" onclick="openMediaModal('${fixUrl(img)}', 'image')">`;
                        });
                    }
                    if (r.videos && r.videos.length > 0) {
                        mediaHtml += `<br><span style="color: #d32f2f; font-weight: bold;">${r.videos.length} Video</span><br>`;
                        r.videos.forEach(vid => {
                            mediaHtml += `
                            <div style="position: relative; display: inline-block; cursor: pointer; margin: 2px;" onclick="openMediaModal('${fixUrl(vid)}', 'video')">
                                <video src="${fixUrl(vid)}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; display: block;" 
                                       onloadedmetadata="this.nextElementSibling.querySelector('span').innerText = Math.floor(this.duration / 60) + ':' + (Math.floor(this.duration % 60) < 10 ? '0' : '') + Math.floor(this.duration % 60)"></video>
                                <div style="position: absolute; bottom: 2px; right: 2px; background: rgba(0,0,0,0.65); color: white; font-size: 8px; padding: 1px 3px; border-radius: 2px; pointer-events: none; display: flex; align-items: center; gap: 2px;">
                                    <i class="fas fa-play" style="font-size: 6px;"></i> <span>0:00</span>
                                </div>
                            </div>`;
                        });
                    }

                    return `
                        <tr>
                            <td><strong>#${r.id}</strong></td>
                            <td style="max-width: 200px; white-space: normal;">${productName}</td>
                            <td><strong>${userName}</strong></td>
                            <td style="color: #ffd700; font-size: 16px; white-space: nowrap;">${stars}</td>
                            <td style="max-width: 300px; white-space: normal; line-height: 1.5; color: #444;">${r.comment || '<em style="color: #999;">Không có bình luận</em>'}</td>
                            <td style="white-space: normal; min-width: 150px;">${mediaHtml || '<span style="color: #999;">Không có</span>'}</td>
                            <td style="font-size: 13px; color: #888;">${new Date(r.created_at).toLocaleString('vi-VN')}</td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteReview(${r.id})" title="Xóa đánh giá này">Xóa</button>
                            </td>
                        </tr>
                    `;
                }).join('');
            } catch (err) {
                console.error(err);
                tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 40px; color: red;">Lỗi tải dữ liệu đánh giá.</td></tr>';
            }
        }

        async function deleteReview(id) {
            if (confirm('Bạn có chắc chắn muốn xóa vĩnh viễn đánh giá này không? Thao tác này không thể hoàn tác.')) {
                try {
                    const res = await adminFetch(`/admin/reviews/${id}`, { method: 'DELETE' });
                    if (res) {
                        alert('Xóa đánh giá thành công!');
                        loadReviews();
                    }
                } catch (err) {
                    alert('Lỗi xóa đánh giá: ' + err.message);
                }
            }
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
    <style>
        #reviews-table th { white-space: nowrap; }
    </style>
<?php include 'includes/footer.php'; ?>
