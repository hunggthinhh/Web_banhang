const API_URL = window.location.origin + '/Web_banhang/backend/public/api';

const apiFetch = async (endpoint, options = {}) => {
    const token = localStorage.getItem('auth_token');
    const headers = {
        'Accept': 'application/json',
        ...options.headers,
    };
    if (!(options.body instanceof FormData)) {
        headers['Content-Type'] = 'application/json';
    }
    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }
    try {
        const response = await fetch(`${API_URL}${endpoint}`, { ...options, headers });
        
        if (response.status === 401) {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user_name');
            localStorage.removeItem('user_role');
            return null;
        }

        if (response.status === 204) return {};

        const data = await response.json();
        if (!response.ok) {
            throw new Error(data.message || 'Lỗi server');
        }
        return data;
    } catch (error) {
        console.error('Fetch error:', error);
        alert('Lỗi kết nối: ' + error.message);
        return null;
    }
};

const updateAuthUI = () => {
    const authContainer = document.getElementById('auth-links');
    if (!authContainer) return;

    const token = localStorage.getItem('auth_token');
    const userName = localStorage.getItem('user_name');

    if (token && userName) {
        const role = localStorage.getItem('user_role');
        const adminLink = (role === 'admin') ? 
            `<a href="../admin-web/dashboard.php" class="nav-btn admin-btn-header" style="border: 1.5px solid var(--primary); color: var(--primary); padding: 5px 15px; border-radius: 8px; font-size: 13px; font-weight: 600; margin-right: 15px;">
                Trang Admin
            </a>` : '';
            
        authContainer.innerHTML = `
            <div style="display: flex; align-items: center; gap: 15px;">
                ${adminLink}
                <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-user-circle" style="color: #666; font-size: 18px;"></i>
                    <a href="profile.php" class="nav-btn-user" style="font-weight: 600; color: #333;">${userName}</a>
                </div>
                <a href="#" id="store-logout-btn" class="nav-btn" style="color: #ff4d4d; font-size: 14px;"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        `;
        
        document.getElementById('store-logout-btn')?.addEventListener('click', (e) => {
            e.preventDefault();
            localStorage.clear();
            window.location.reload();
        });
    }
};

const updateCartBadge = () => {
    const countElement = document.getElementById('cart-count');
    if (!countElement) return;

    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const totalQty = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
    countElement.innerText = totalQty;

    // Add bump animation
    countElement.classList.remove('bump');
    void countElement.offsetWidth; // trigger reflow
    countElement.classList.add('bump');
};

const formatPrice = p => Math.round(Number(p) || 0).toLocaleString('vi-VN') + ' VND';

window.addCart = (id, name, price, image, silent = false) => {
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
};

window.buyNow = (id, name, price, image) => {
    window.addCart(id, name, price, image, true);
    window.location.href = 'cart.php';
};

document.addEventListener('DOMContentLoaded', () => {
    updateAuthUI();
    updateCartBadge();
});
