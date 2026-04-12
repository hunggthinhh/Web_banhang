<?php
$pageTitle = "Chính sách";
include 'includes/header.php';
?>

<div class="container policy-page">
        <div class="policy-header-section">
                <h1>Chính sách bán hàng </h1>
                <p style="text-align: color: #000000ff;">Tại La Pâtisserie, chúng tôi cam kết bảo vệ quyền lợi
                        của khách hàng bằng những chính sách minh bạch và chuyên nghiệp nhất.</p>
        </div>

        <div class="policy-accordion">
                <!-- 01 Shipping Policy -->
                <div class="accordion-item" id="shipping-policy">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                <span class="number">01</span>
                                <h3>Chính sách giao hàng</h3>
                                <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content">
                                <div class="content-inner">
                                        <p>Chúng tôi cung cấp dịch vụ giao hàng tận nơi cho tất cả đơn hàng trong khu
                                                vực nội thành Khánh Hòa và hỗ trợ gửi chuyển phát nhanh toàn quốc.</p>
                                        <ul>
                                                <li><strong>Thời gian giao hàng:</strong> Đơn hàng trong ngày sẽ được
                                                        giao trong vòng 4 tiếng. Đơn tỉnh từ 2-3 ngày làm việc.</li>
                                                <li><strong>Phí giao hàng:</strong> Miễn phí cho đơn hàng từ 500.000đ
                                                        trở lên. Các đơn hàng khác sẽ tính theo phí của đơn vị vận
                                                        chuyển.</li>
                                                <li><strong>Kiểm hàng:</strong> Quý khách được phép kiểm tra sản phẩm
                                                        trước khi nhận.</li>
                                        </ul>
                                </div>
                        </div>
                </div>

                <!-- 02 Return Policy -->
                <div class="accordion-item" id="returns-policy">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                <span class="number">02</span>
                                <h3>Chính sách đổi trả</h3>
                                <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content">
                                <div class="content-inner">
                                        <p>Vì là sản phẩm thực phẩm, chúng tôi áp dụng chính sách đổi trả nghiêm ngặt để
                                                đảm bảo chất lượng:</p>
                                        <ul>
                                                <li><strong>Đổi mới:</strong> Nếu sản phẩm bị hỏng, móp méo do lỗi vận
                                                        chuyển hoặc không đúng loại khách đặt.</li>
                                                <li><strong>Thời gian:</strong> Vui lòng liên hệ phản hồi trong vòng 2
                                                        giờ sau khi nhận hàng đối với bánh tươi và 24h đối với bánh khô.
                                                </li>
                                                <li><strong>Yêu cầu:</strong> Sản phẩm phải còn nguyên bao bì và chưa
                                                        qua sử dụng.</li>
                                        </ul>
                                </div>
                        </div>
                </div>

                <!-- 03 Ordering & Payment -->
                <div class="accordion-item" id="payment-policy">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                <span class="number">03</span>
                                <h3>Đặt hàng & thanh toán</h3>
                                <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content">
                                <div class="content-inner">
                                        <p>Quý khách có thể lựa chọn 1 trong 3 hình thức thanh toán thuận tiện nhất:</p>
                                        <ul>
                                                <li><strong>Tiền mặt:</strong> Thanh toán trực tiếp khi nhận hàng (COD).
                                                </li>
                                                <li><strong>Chuyển khoản:</strong> Thanh toán qua tài khoản ngân hàng
                                                        trước khi giao hàng.</li>
                                                <li><strong>Ví điện tử:</strong> Thanh toán nhanh qua Momo hoặc ZaloPay.
                                                </li>
                                        </ul>
                                </div>
                        </div>
                </div>

                <!-- 04 General Regulations -->
                <div class="accordion-item" id="regulations-policy">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                <span class="number">04</span>
                                <h3>Quy định chung</h3>
                                <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content">
                                <div class="content-inner">
                                        <p>Bằng việc truy cập vào website [lapatisserie.com], quý khách đồng ý với các
                                                quy định sau:</p>
                                        <ul>
                                                <li>Không sử dụng hình ảnh của cửa hàng cho mục đích thương mại khi chưa
                                                        được cho phép.</li>
                                                <li>Thông tin giá cả có thể thay đổi tùy theo mùa vụ mà không cần báo
                                                        trước.</li>
                                                <li>Chúng tôi có quyền từ chối cung cấp dịch vụ nếu nhận thấy các hành
                                                        vi gian lận.</li>
                                        </ul>
                                </div>
                        </div>
                </div>

                <!-- 05 Privacy Policy -->
                <div class="accordion-item" id="privacy-policy">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                                <span class="number">05</span>
                                <h3>Chính sách bảo mật</h3>
                                <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content">
                                <div class="content-inner">
                                        <p>Chúng tôi tôn trọng và cam kết bảo vệ thông tin cá nhân của bạn:</p>
                                        <ul>
                                                <li><strong>Thông tin thu thập:</strong> Họ tên, số điện thoại, địa chỉ
                                                        giao hàng và email.</li>
                                                <li><strong>Mục đích sử dụng:</strong> Liên hệ giao hàng và thông báo
                                                        các chương trình khuyến mãi riêng biệt.</li>
                                                <li><strong>Cam kết:</strong> Tuyệt đối không chia sẻ thông tin của
                                                        khách hàng cho bất kỳ bên thứ 3 nào.</li>
                                        </ul>
                                </div>
                        </div>
                </div>
        </div>
</div>

<script>
        // Helper to close all accordion items
        function closeAllAccordions() {
                document.querySelectorAll('.accordion-item').forEach(el => {
                        el.classList.remove('active');
                        el.querySelector('.accordion-content').style.maxHeight = null;
                });
        }

        // Toggle functionality when clicked
        function toggleAccordion(header) {
                const item = header.parentElement;
                const isActive = item.classList.contains('active');
                const content = item.querySelector('.accordion-content');

                // If clicking an already active item, just close it
                if (isActive) {
                        item.classList.remove('active');
                        content.style.maxHeight = null;
                        return;
                }

                // If opening a new one, close everything first
                closeAllAccordions();

                // Open this item
                item.classList.add('active');
                content.style.maxHeight = content.scrollHeight + "px";
        }

        // Deep linking logic for hash anchors from Footer
        function handleHashLink() {
                const hash = window.location.hash;
                if (hash) {
                        const targetId = hash.substring(1);
                        const targetItem = document.getElementById(targetId);
                        if (targetItem) {
                                // Close all before auto-expanding the new one
                                closeAllAccordions();

                                setTimeout(() => {
                                        const header = targetItem.querySelector('.accordion-header');
                                        const content = targetItem.querySelector('.accordion-content');
                                        
                                        // Auto-expand
                                        targetItem.classList.add('active');
                                        content.style.maxHeight = content.scrollHeight + "px";

                                        // Precise Smooth Scroll
                                        const headerOffset = 150;
                                        const elementPosition = targetItem.getBoundingClientRect().top + window.pageYOffset;
                                        window.scrollTo({
                                                top: elementPosition - headerOffset,
                                                behavior: 'smooth'
                                        });
                                }, 300);
                        }
                }
        }

        // Event Listeners
        window.addEventListener('load', handleHashLink);
        window.addEventListener('hashchange', handleHashLink);
        if (window.location.hash) handleHashLink();
</script>

<?php include 'includes/footer.php'; ?>