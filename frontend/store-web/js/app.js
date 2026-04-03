const API_URL = 'http://127.0.0.1:8000/api';

const apiFetch = async (endpoint, options = {}) => {
    const token = localStorage.getItem('auth_token');
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        ...options.headers,
    };
    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }
    const response = await fetch(`${API_URL}${endpoint}`, { ...options, headers });
    if (response.status === 401) {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_name');
    }
    return response.json();
};

const updateAuthUI = () => {
    const authContainer = document.getElementById('auth-links');
    if (!authContainer) return;

    const token = localStorage.getItem('auth_token');
    const userName = localStorage.getItem('user_name');

    if (token && userName) {
        authContainer.innerHTML = `
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-user" style="color: #001f3f; font-size: 20px;"></i>
                <a href="profile.php" class="nav-btn-user">Xin chào, ${userName}</a>
            </div>
        `;
    }
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
};

document.addEventListener('DOMContentLoaded', updateAuthUI);
