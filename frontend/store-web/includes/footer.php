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
                    <a href="https://www.facebook.com/phugthinh27"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/_hhungthinh/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@thinh.p23"><i class="fab fa-tiktok"></i></a>
                    <a href="https://zalo.me/0965050142"><i class="fab fa-zalo">Z</i></a>
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
                    <span>0965050142</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>phattuan460@gmail.com</span>
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

        <div class="footer-bottom"
            style="text-align: center !important; display: block !important; width: 100% !important; padding-top: 30px;">
            <p style="margin: 0 auto !important; display: inline-block !important;">&copy; 2026 La Pâtisserie. All
                rights reserved.</p>
        </div>
    </div>
</footer>

<!-- AI Chatbot -->
<div id="ai-chatbot-container"
    style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; font-family: 'Inter', sans-serif;">
    <!-- Chat Window -->
    <div id="chatbot-window"
        style="display: none; position: absolute; bottom: 80px; right: 0; width: 350px; background: white; border-radius: 16px; box-shadow: 0 5px 25px rgba(0,0,0,0.15); overflow: hidden; flex-direction: column;">
        <!-- Header -->
        <div
            style="background: #001f3f; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div
                    style="width: 35px; height: 35px; border-radius: 50%; background: #ffd699; display: flex; align-items: center; justify-content: center; color: #001f3f; font-size: 18px;">
                    <i class="fas fa-robot"></i>
                </div>
                <div>
                    <h4 style="margin: 0; font-size: 16px;">Trợ lý ảo La Pâtisserie</h4>
                    <span style="font-size: 12px; color: #4CAF50;"><i class="fas fa-circle" style="font-size: 8px;"></i>
                        Đang trực tuyến</span>
                </div>
            </div>
            <i class="fas fa-times" onclick="toggleChatbot()" style="cursor: pointer; font-size: 18px;"></i>
        </div>

        <!-- Messages -->
        <div id="chatbot-messages"
            style="height: 380px; padding: 15px; overflow-y: auto; background: #f9f9f9; display: flex; flex-direction: column; gap: 12px;">
            <div
                style="background: white; padding: 12px 15px; border-radius: 0 15px 15px 15px; max-width: 85%; align-self: flex-start; box-shadow: 0 1px 3px rgba(0,0,0,0.05); font-size: 14px; color: #333; line-height: 1.5;">
                Xin chào! 👋<br>Tôi là trợ lý ảo của <strong>La Pâtisserie</strong>.<br>Tôi có thể giúp gì cho bạn hôm
                nay?
            </div>
        </div>

        <!-- Input -->
        <div style="padding: 15px; background: white; border-top: 1px solid #eee; display: flex; gap: 10px;">
            <input type="text" id="chatbot-input" placeholder="Nhập tin nhắn của bạn..."
                style="flex: 1; padding: 12px 15px; border: 1px solid #ddd; border-radius: 25px; outline: none; font-size: 14px;"
                onkeypress="if(event.key === 'Enter') sendChatMessage()">
            <button onclick="sendChatMessage()"
                style="background: #ffd699; color: #001f3f; border: none; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 16px; transition: 0.2s;">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <!-- Chat Icon -->
    <div id="chatbot-icon" onclick="toggleChatbot()"
        style="background: #001f3f; color: #ffd699; width: 65px; height: 65px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 28px; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.3); transition: transform 0.3s;">
        <i class="fas fa-comment-dots"></i>
    </div>
</div>

<button id="backToTop" title="Lên đầu trang" style="bottom: 110px !important; right: 27px !important; z-index: 999;">
    <i class="fas fa-chevron-up"></i>
</button>

<script>
    function toggleChatbot() {
        const win = document.getElementById('chatbot-window');
        const icon = document.querySelector('#chatbot-icon i');
        const iconContainer = document.getElementById('chatbot-icon');

        if (win.style.display === 'none' || win.style.display === '') {
            win.style.display = 'flex';
            icon.className = 'fas fa-times';
            iconContainer.style.transform = 'rotate(90deg)';
        } else {
            win.style.display = 'none';
            icon.className = 'fas fa-comment-dots';
            iconContainer.style.transform = 'rotate(0deg)';
        }
    }

    async function sendChatMessage() {
        const input = document.getElementById('chatbot-input');
        const message = input.value.trim();
        if (!message) return;

        const messagesContainer = document.getElementById('chatbot-messages');

        // Add user message
        messagesContainer.innerHTML += `
            <div style="background: #001f3f; color: white; padding: 12px 15px; border-radius: 15px 15px 0 15px; max-width: 85%; align-self: flex-end; font-size: 14px; line-height: 1.5; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                ${message}
            </div>
        `;
        input.value = '';
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Add loading
        const loadingId = 'loading-' + Date.now();
        messagesContainer.innerHTML += `
            <div id="${loadingId}" style="background: white; padding: 12px 15px; border-radius: 0 15px 15px 15px; max-width: 85%; align-self: flex-start; box-shadow: 0 1px 3px rgba(0,0,0,0.05); font-size: 14px; color: #888; font-style: italic;">
                <i class="fas fa-circle-notch fa-spin"></i> Trợ lý đang suy nghĩ...
            </div>
        `;
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        try {
            // Check if API_URL exists, fallback to localhost if needed
            const baseUrl = typeof API_URL !== 'undefined' ? API_URL : window.location.origin + '/Web_banhang/backend/public/api';

            const response = await fetch(`${baseUrl}/chatbot`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            const el = document.getElementById(loadingId);
            if (el) el.remove();

            // Format markdown bold
            let replyText = data.reply || 'Xin lỗi, tôi đang gặp sự cố.';
            replyText = replyText.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

            // Fix localhost URL if running on ngrok
            replyText = replyText.replace(/http:\/\/(localhost|127\.0\.0\.1)(:\d+)?/g, window.location.origin);

            messagesContainer.innerHTML += `
                <div style="background: white; padding: 12px 15px; border-radius: 0 15px 15px 15px; max-width: 85%; align-self: flex-start; box-shadow: 0 1px 3px rgba(0,0,0,0.05); font-size: 14px; color: #333; line-height: 1.6; white-space: pre-wrap;">${replyText}</div>
            `;
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        } catch (error) {
            const el = document.getElementById(loadingId);
            if (el) el.remove();
            messagesContainer.innerHTML += `
                <div style="background: #ffebee; color: #c62828; padding: 12px 15px; border-radius: 0 15px 15px 15px; max-width: 85%; align-self: flex-start; font-size: 14px;">
                    Lỗi kết nối. Vui lòng thử lại sau.
                </div>
            `;
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    }
</script>

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