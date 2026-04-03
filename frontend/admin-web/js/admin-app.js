const API_URL = 'http://127.0.0.1:8000/api';

const adminFetch = async (endpoint, options = {}) => {
    const token = localStorage.getItem('auth_token');
    const role = localStorage.getItem('user_role');
    
    if (!token || role !== 'admin') {
        alert('Bạn không có quyền truy cập!');
        window.location.href = '../store-web/login.html';
        return;
    }

    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`,
        ...options.headers,
    };
    
    const response = await fetch(`${API_URL}${endpoint}`, { ...options, headers });
    if (response.status === 401) {
        localStorage.removeItem('auth_token');
        window.location.href = '../store-web/login.html';
    }
    return response.json();
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
};
