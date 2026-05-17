<?php
/**
 * img-proxy.php
 * Proxy để phục vụ ảnh từ backend, tránh bị chặn bởi ngrok browser warning.
 * Cách dùng: img-proxy.php?path=uploads/image.jpg
 */

// Đường dẫn tuyệt đối tới thư mục public của backend
$backendPublic = '/Applications/XAMPP/xamppfiles/htdocs/Web_banhang/backend/public';

$path = $_GET['path'] ?? '';
$path = ltrim(rawurldecode($path), '/');

// Bảo mật: không cho phép path traversal
if (strpos($path, '..') !== false || strpos($path, "\0") !== false) {
    http_response_code(400);
    exit('Invalid path');
}

$fullPath = $backendPublic . DIRECTORY_SEPARATOR . $path;
$realPath = realpath($fullPath);

// Kiểm tra file tồn tại và nằm trong thư mục được phép
if (!$realPath || strpos($realPath, $backendPublic) !== 0 || !is_file($realPath)) {
    http_response_code(404);
    header('Content-Type: text/plain');
    exit('File not found: ' . $path);
}

// Xác định MIME type
$ext = strtolower(pathinfo($realPath, PATHINFO_EXTENSION));
$mimeTypes = [
    'jpg'  => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png'  => 'image/png',
    'gif'  => 'image/gif',
    'webp' => 'image/webp',
    'svg'  => 'image/svg+xml',
];
$mime = $mimeTypes[$ext] ?? 'image/jpeg';

// Output headers
header('Content-Type: ' . $mime);
header('Cache-Control: public, max-age=86400');
header('Access-Control-Allow-Origin: *');
header('Content-Length: ' . filesize($realPath));

readfile($realPath);
