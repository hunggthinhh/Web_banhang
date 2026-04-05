<?php if (basename($_SERVER['PHP_SELF']) != 'index.php' && basename($_SERVER['PHP_SELF']) != 'login.php' && basename($_SERVER['PHP_SELF']) != 'register.php'): ?>
    </div>
<?php endif; ?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-col about">
                <a href="index.php" class="footer-logo">
                    <span>La Pâtisserie</span>
                </a>
                <p>Nơi mang đến những hương vị bánh ngọt ngào và tinh tế nhất, được làm từ sự tận tâm và nguyên liệu
                    thượng hạng.</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-zalo">Z</i></a>
                </div>
            </div>

            <div class="footer-col links">
                <h4>Liên kết nhanh</h4>
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="about.php">Giới thiệu</a></li>
                    <li><a href="shop.php">Sản phẩm</a></li>
                    <li><a href="contact.php">Liên hệ</a></li>
                </ul>
            </div>

            <div class="footer-col support">
                <h4>Hỗ trợ khách hàng</h4>
                <ul>
                    <li><a href="policy.php#shipping-policy">Chính sách giao hàng</a></li>
                    <li><a href="policy.php#returns-policy">Chính sách đổi trả</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-middle">
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>116/3 Hùng Vương, Xã Diên Khánh, Tỉnh Khánh Hòa</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>090 123 4567</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>contact@lapatisserie.com</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <span>08:00 - 21:00 (Mỗi ngày)</span>
                </div>
            </div>
            <div class="footer-map">
                <a href="https://www.google.com/maps/search/?api=1&query=116/3+Hùng+Vương+Diên+Khánh+Khánh+Hòa"
                    target="_blank" class="map-link">
                    <i class="fas fa-location-arrow"></i> Xem bản đồ
                </a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 La Pâtisserie. All rights reserved.</p>
            <div class="payment-methods">
                <span title="Tiền mặt"><i class="fas fa-money-bill-wave"></i></span>
                <span title="Chuyển khoản"><i class="fas fa-university"></i></span>
                <span title="Momo" class="payment-badge">Momo</span>
            </div>
        </div>
    </div>
</footer>

<button id="backToTop" title="Lên đầu trang">
    <i class="fas fa-chevron-up"></i>
</button>

<script>
    // Back to Top script
    const backToTopBtn = document.getElementById('backToTop');
    window.onscroll = function () {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            backToTopBtn.style.display = "flex";
        } else {
            backToTopBtn.style.display = "none";
        }
    };
    backToTopBtn.onclick = function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
</script>

<script src="js/app.js"></script>
</body>

</html>