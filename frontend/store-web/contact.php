<?php
$pageTitle = "Liên hệ - La Pâtisserie";
include 'includes/header.php';
?>

<div class="container contact-page-wrapper">
    <div class="page-card contact-card">
        <div class="contact-row">
            <!-- Left Column: Info & Map -->
            <div class="contact-left">
                <h1 class="contact-main-title">LA PÂTISSERIE XIN CHÀO</h1>

                <div class="contact-details">
                    <h2 class="address-title">Địa chỉ Khánh Hòa</h2>
                    <div class="detail-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>116/3 Hùng Vương, Xã Diên Khánh, Tỉnh Khánh Hòa</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>090 123 4567</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-envelope"></i>
                        <span>contact@lapatisserie.com</span>
                    </div>
                </div>

                <div class="map-container">
                    <iframe 
                        src="https://maps.google.com/maps?q=116/3%20Hùng%20Vương,%20Diên%20Khánh,%20Khánh%20Hòa&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Right Column: Contact Form -->
            <div class="contact-right">
                <p class="form-instruction">
                    Quý khách vui lòng điền thông tin theo mẫu bên dưới. Mọi thắc mắc liên quan đến sản phẩm, dịch vụ, chúng mình <span class="highlight-text">sẽ cố gắng phản hồi trong thời gian sớm nhất.</span>
                </p>

                <form class="contact-form" action="#" method="POST" id="contactForm">
                    <div class="form-group-contact">
                        <input type="text" placeholder="Họ và tên" name="fullname" required>
                    </div>
                    <div class="form-group-contact">
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group-contact">
                        <input type="tel" placeholder="Số điện thoại" name="phone">
                    </div>
                    <div class="form-group-contact">
                        <input type="text" placeholder="Tiêu đề" name="subject">
                    </div>
                    <div class="form-group-contact">
                        <textarea placeholder="Nội dung" name="message" rows="6" required></textarea>
                    </div>

                    <div class="captcha-placeholder">
                        <div class="captcha-box">
                            <input type="checkbox" id="captcha-check">
                            <label for="captcha-check">Tôi không phải là người máy</label>
                            <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA" class="captcha-logo">
                        </div>
                    </div>

                    <div class="form-submit-row">
                        <button type="submit" class="contact-submit-btn">
                            Gửi <i class="fas fa-long-arrow-alt-right"></i>
                        </button>
                    </div>
                    
                    <div id="contact-message" style="margin-top: 15px; display: none; padding: 15px; border-radius: 12px; font-family: 'Outfit', sans-serif;"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validation
    const email = this.querySelector('[name="email"]').value;
    const phone = this.querySelector('[name="phone"]').value;

    if (!email.endsWith('@gmail.com')) {
        showMessage('Email phải có định dạng @gmail.com', 'error');
        return;
    }

    if (phone && !/^0\d{9}$/.test(phone)) {
        showMessage('Số điện thoại phải bao gồm đúng 10 chữ số và bắt đầu bằng số 0', 'error');
        return;
    }

    // Captcha validation
    if (!document.getElementById('captcha-check').checked) {
        showMessage('Vui lòng xác nhận bạn không phải là người máy.', 'error');
        return;
    }

    const formData = new FormData(this);
    const data = {};
    formData.forEach((value, key) => data[key] = value);
    
    // Add user_id if logged in
    const userId = localStorage.getItem('user_id');
    if (userId) data['user_id'] = userId;
    
    const submitBtn = this.querySelector('.contact-submit-btn');
    const originalBtnContent = submitBtn.innerHTML;

    submitBtn.disabled = true;
    submitBtn.innerHTML = 'Đang gửi...';

    // Trying alternative relative path for XAMPP configuration
    // Often XAMPP subfolders need the exact path from origin
    const apiUrl = window.location.origin + '/Web_banhang/backend/public/api/contacts';

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(async response => {
        const result = await response.json();
        if (response.ok) {
            return result;
        } else {
            throw result;
        }
    })
    .then(res => {
        showMessage(res.message || 'Gửi tin nhắn thành công!', 'success');
        this.reset();
    })
    .catch(error => {
        console.error('Submission Error:', error);
        let errorMsg = 'Có lỗi xảy ra. Hãy chắc chắn máy chủ Backend đang chạy.';
        
        if (error.errors) {
            errorMsg = Object.values(error.errors).flat().join('<br>');
        } else if (error.message) {
            errorMsg = error.message;
        }
        
        showMessage(errorMsg, 'error');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnContent;
    });
});

function showMessage(msg, type) {
    const msgDiv = document.getElementById('contact-message');
    msgDiv.style.display = 'block';
    msgDiv.innerHTML = msg;
    
    if (type === 'success') {
        msgDiv.style.backgroundColor = '#d4edda';
        msgDiv.style.color = '#155724';
        msgDiv.style.border = '1px solid #c3e6cb';
    } else {
        msgDiv.style.backgroundColor = '#f8d7da';
        msgDiv.style.color = '#721c24';
        msgDiv.style.border = '1px solid #f5c6cb';
    }

    // Scroll to message
    msgDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
}
</script>