const API_URL = window.location.origin + '/Web_banhang/backend/public/api';

const adminFetch = async (endpoint, options = {}) => {
    const token = localStorage.getItem('auth_token');
    const role  = localStorage.getItem('user_role');

    if (!token || role !== 'admin') {
        alert('Bạn không có quyền truy cập!');
        window.location.href = '../store-web/login.php';
        return null;
    }

    const headers = {
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`,
        ...options.headers,
    };

    let { method = 'GET', body } = options;

    // Method Spoofing: Laravel requires _method in body sent as POST
    if (method === 'PUT' || method === 'DELETE') {
        const originalMethod = method;
        method = 'POST';

        if (body instanceof FormData) {
            body.append('_method', originalMethod);
        } else {
            // JSON body
            let parsed = {};
            try { parsed = body ? JSON.parse(body) : {}; } catch(e) {}
            body = JSON.stringify({ ...parsed, _method: originalMethod });
            headers['Content-Type'] = 'application/json';
        }
    } else if (!(body instanceof FormData)) {
        headers['Content-Type'] = 'application/json';
    }

    let response;
    try {
        response = await fetch(`${API_URL}${endpoint}`, {
            ...options,
            method,
            body,
            headers,
        });
    } catch (networkErr) {
        alert('Lỗi mạng: Không thể kết nối đến máy chủ!');
        return null;
    }

    if (response.status === 401) {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_role');
        window.location.href = '../store-web/login.php';
        return null;
    }

    const text = await response.text();
    
    // If status 204 or empty response, no need to parse JSON
    if (response.status === 204 || !text.trim()) {
        return {};
    }

    let data;
    try {
        data = JSON.parse(text);
    } catch (e) {
        console.error('Server trả về không phải JSON:', text);
        alert('Lỗi máy chủ: Server phản hồi không đúng định dạng. Vui lòng kiểm tra Laravel Logs.');
        return null;
    }

    if (!response.ok) {
        const errorMsg = data.message
            || (data.errors ? Object.values(data.errors).flat().join('\n') : 'Đã có lỗi xảy ra!');
        alert('Lỗi: ' + errorMsg);
        return null;
    }

    return data;
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price || 0);
};
