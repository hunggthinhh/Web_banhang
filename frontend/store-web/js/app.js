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
            <span style="color: var(--primary); margin-right: 15px;">Xin chào, ${userName}!</span>
            <a href="#" id="logout-link">Đăng xuất</a>
        `;
        
        document.getElementById('logout-link').onclick = (e) => {
            e.preventDefault();
            localStorage.clear();
            window.location.reload();
        };
    }
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
};

document.addEventListener('DOMContentLoaded', updateAuthUI);
