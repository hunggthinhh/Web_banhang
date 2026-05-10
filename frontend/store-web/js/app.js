const API_URL = window.location.origin + '/Web_banhang/backend/public/api';
const fixImg = (path) => {
    if (!path) return 'img/logo.png';
    if (path.startsWith('http') || path.startsWith('data:')) return path;
    const base = window.location.origin + '/Web_banhang/backend/public/';
    return base + path.replace(/^\//, '');
};

const apiFetch = async (endpoint, options = {}) => {
    const token = localStorage.getItem('auth_token');
    const headers = {
        'Accept': 'application/json',
        'ngrok-skip-browser-warning': 'true',
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
        // Removed alert to prevent annoying popups during background polling
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

window.pushCartToBackend = async () => {
    const token = localStorage.getItem('auth_token');
    if (!token) return;
    const cart = localStorage.getItem('cart') || '[]';
    await apiFetch('/cart', {
        method: 'POST',
        body: JSON.stringify({ cart })
    });
};

window.pullOrdersFromBackend = async () => {
    const token = localStorage.getItem('auth_token');
    if (!token) return;

    try {
        const data = await apiFetch('/orders');
        if (data && Array.isArray(data)) {
            // Chuẩn hóa và Sắp xếp để so sánh chính xác
            const serverOrders = data.map(o => ({
                id: Number(o.id),
                status: o.status,
                total_amount: Number(o.total_amount),
                created_at: o.created_at
            })).sort((a, b) => b.id - a.id);
            
            const localOrders = (window.allUserOrders || []).map(o => ({
                id: Number(o.id),
                status: o.status,
                total_amount: Number(o.total_amount),
                created_at: o.created_at
            })).sort((a, b) => b.id - a.id);

            const newStr = JSON.stringify(serverOrders);
            const oldStr = JSON.stringify(localOrders);

            if (newStr !== oldStr) {
                console.log('🔄 Web Realtime: Cập nhật trạng thái đơn hàng.');
                window.allUserOrders = data;
                
                // Update UI if we are on profile.php and in orders section
                const ordersList = document.getElementById('orders-list');
                if (ordersList) {
                    const activeTabBtn = document.querySelector('.order-tab-btn.active');
                    let status = 'all';
                    if (activeTabBtn) {
                        const txt = activeTabBtn.innerText;
                        if (txt.includes('Chờ')) status = 'pending';
                        else if (txt.includes('Đang làm')) status = 'processing';
                        else if (txt.includes('Đang giao')) status = 'shipped';
                        else if (txt.includes('Hoàn tất')) status = 'delivered';
                        else if (txt.includes('Đã hủy')) status = 'cancelled';
                        else if (txt.includes('Trả hàng')) status = 'returned';
                    }
                    if (typeof window.renderOrders === 'function') {
                        window.renderOrders(status);
                    }
                }

                // Update detail modal if open
                const modal = document.getElementById('orderDetailModal');
                if (modal && modal.style.display === 'flex') {
                    const titleEl = document.querySelector('#orderDetailModal h2');
                    if (titleEl && typeof window.viewOrderDetail === 'function') {
                        const orderId = parseInt(titleEl.innerText.replace(/[^0-9]/g, ''));
                        if (orderId) window.viewOrderDetail(orderId, true); // true = silent update
                    }
                }
            }
        }
    } catch (err) {
        console.error('Lỗi sync đơn hàng:', err);
    }
};

window.pullCartFromBackend = async () => {
    const token = localStorage.getItem('auth_token');
    if (!token) return;
    
    try {
        const data = await apiFetch('/cart');
        if (data && data.cart && Array.isArray(data.cart)) {
            // Chuẩn hóa và Sắp xếp để so sánh chính xác (tránh lỗi thứ tự item khác nhau)
            const serverCart = data.cart.map(item => ({
                id: Number(item.id),
                name: item.name,
                price: Number(item.price),
                image: item.image,
                quantity: Number(item.quantity || 1),
                selected: item.selected !== false, // default true
                greeting: item.greeting || ''
            })).sort((a, b) => a.id - b.id);
            
            const localCartRaw = JSON.parse(localStorage.getItem('cart') || '[]');
            const localCart = localCartRaw.map(item => ({
                id: Number(item.id),
                name: item.name,
                price: Number(item.price),
                image: item.image,
                quantity: Number(item.quantity || 1),
                selected: item.selected !== false,
                greeting: item.greeting || ''
            })).sort((a, b) => a.id - b.id);

            const newCartStr = JSON.stringify(serverCart);
            const oldCartStr = JSON.stringify(localCart);
            
            if (newCartStr !== oldCartStr) {
                console.log('🔄 Web Realtime: Đồng bộ giỏ hàng thành công.');
                localStorage.setItem('cart', JSON.stringify(serverCart));
                updateCartBadge();
                if (typeof window.renderCart === 'function') {
                    window.renderCart();
                }
            }
        }
    } catch (err) {
        console.error('Lỗi sync ngầm:', err);
    }
};

window.addCart = async (id, name, price, image, silent = false) => {
    const qtyVal = document.getElementById('qty-val');
    const qty = qtyVal ? parseInt(qtyVal.value) : 1;
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const idx = cart.findIndex(item => item.id === id);
    if (idx > -1) {
        cart[idx].quantity += qty;
    } else {
        cart.push({ id, name, price, image, quantity: qty, selected: true });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartBadge();
    
    // Sync to cloud
    await pushCartToBackend();

    if (!silent) {
        alert('Đã thêm sản phẩm vào giỏ hàng!');
    }
};

window.buyNow = async (id, name, price, image) => {
    // Để "Mua ngay" chỉ hiện 1 món này, ta bỏ chọn tất cả các món đang có trong giỏ
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    cart.forEach(item => item.selected = false);
    
    const idx = cart.findIndex(item => item.id === id);
    if (idx > -1) {
        cart[idx].quantity += 1; // Thêm số lượng nếu đã có
        cart[idx].selected = true;
    } else {
        cart.push({ id, name, price, image, quantity: 1, selected: true });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartBadge();
    await pushCartToBackend();
    
    window.location.href = 'checkout.php';
};

// app.js được load cuối <body> → DOM đã sẵn sàng, không cần DOMContentLoaded
// Khởi động ngay lập tức
updateAuthUI();
updateCartBadge();

// Pull cart & orders ngay khi trang load
if (localStorage.getItem('auth_token')) {
    pullCartFromBackend();
    pullOrdersFromBackend();
}

// Polling 2 giây/lần – realtime sync
let _cartPollTimer = setInterval(() => {
    if (localStorage.getItem('auth_token')) {
        pullCartFromBackend();
        pullOrdersFromBackend();
    }
}, 2000);

// Khi user quay lại tab → kéo data ngay (không đợi 2s)
document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'visible' && localStorage.getItem('auth_token')) {
        pullCartFromBackend();
        pullOrdersFromBackend();
    }
});
