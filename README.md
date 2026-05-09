# Hệ thống Bán hàng Đa nền tảng (Web & Mobile)

## Giới thiệu

Dự án **Web_banhang** là một hệ thống thương mại điện tử đa nền tảng với đầy đủ các tính năng dành cho khách hàng và quản trị viên. Hệ thống được xây dựng dựa trên kiến trúc phân tách giữa Backend (RESTful API) và Frontend (Web/Mobile App) giúp dễ dàng mở rộng và bảo trì.

Hệ thống bao gồm 3 thành phần chính:
- **Backend API**: Được xây dựng bằng framework Laravel (PHP), đóng vai trò cung cấp dữ liệu qua các RESTful API.
- **Frontend Web**:
  - `store-web`: Giao diện cửa hàng dành cho khách mua sắm (Sử dụng HTML/CSS/JS/PHP).
  - `admin-web`: Bảng điều khiển (Dashboard) dành cho quản trị viên quản lý kho, sản phẩm, đơn hàng, v.v.
- **Mobile App**: Ứng dụng di động mua sắm xây dựng trên nền tảng Capacitor (sử dụng web component và đóng gói native) chạy mượt mà trên cả Android và iOS.

## Yêu cầu môi trường

Để chạy dự án, máy tính của bạn cần cài đặt sẵn:
- **XAMPP / MAMP / WAMP** hoặc môi trường tương đương (PHP >= 8.1, MySQL).
- **Composer** (Công cụ quản lý thư viện cho PHP/Laravel).
- **Node.js & npm** (Cần thiết cho việc quản lý và build ứng dụng Capacitor).
- Trình duyệt web hiện đại để sử dụng frontend và API testing tools (như Postman) nếu cần.

## Cấu trúc thư mục

- `/backend`: Mã nguồn chính của Laravel API.
- `/frontend/store-web`: Mã nguồn giao diện khách hàng.
- `/frontend/admin-web`: Mã nguồn giao diện quản trị viên.
- `/mobile-app`: Mã nguồn ứng dụng di động Capacitor.
- `/doc`: Nơi lưu trữ các tài liệu thiết kế hệ thống, file phân tích chức năng (BA.md).
- `bakery_ecommerce.sql`: File backup cơ sở dữ liệu để khởi tạo.

## Hướng dẫn cài đặt và chạy dự án

### Bước 1: Cài đặt Cơ sở dữ liệu (Database)
1. Mở **XAMPP** và khởi động **Apache** cùng với **MySQL**.
2. Truy cập vào phpMyAdmin thông qua URL: `http://localhost/phpmyadmin`
3. Tạo một database mới (ví dụ: `bakery_ecommerce`).
4. Chọn database vừa tạo, chuyển sang tab **Import** (Nhập).
5. Chọn file `bakery_ecommerce.sql` tại thư mục gốc của dự án và bấm thực thi để tạo cấu trúc và dữ liệu mẫu.

### Bước 2: Cài đặt Backend (Laravel API)
1. Mở Terminal (Command Prompt / PowerShell) và di chuyển vào thư mục `backend`:
   ```bash
   cd backend
   ```
2. Cài đặt các thư viện cần thiết:
   ```bash
   composer install
   ```
3. Copy file `.env.example` và đổi tên thành `.env` (nếu chưa có sẵn):
   ```bash
   cp .env.example .env
   ```
4. Mở file `.env` và cấu hình thông tin Database (phù hợp với database bạn đã tạo ở Bước 1):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bakery_ecommerce
   DB_USERNAME=root
   DB_PASSWORD=
   ```
5. Cấp phát khóa ứng dụng mới (Application Key):
   ```bash
   php artisan key:generate
   ```
6. Khởi chạy server Backend (API mặc định sẽ chạy ở cổng 8000):
   ```bash
   php artisan serve
   ```
   *Lúc này, Backend API có thể truy cập tại: `http://localhost:8000`*

### Bước 3: Cài đặt và sử dụng Frontend Web
Do giao diện Web sử dụng PHP và tài nguyên tĩnh, bạn không cần phải build như các framework JS khác.
Đảm bảo bạn đã đặt thư mục dự án bên trong thư mục `htdocs` của XAMPP (hoặc tương đương).

- **Trang Cửa hàng (Store):** Truy cập `http://localhost/Web_banhang/frontend/store-web`
- **Trang Quản trị (Admin):** Truy cập `http://localhost/Web_banhang/frontend/admin-web`

*Lưu ý: Frontend web gọi dữ liệu thông qua REST API của Backend. Hãy đảm bảo Base URL API trong các file JS (vd: `app.js`, `admin-app.js`) đang được trỏ đúng về URL của server backend (ví dụ: `http://localhost:8000/api`).*

### Bước 4: Cài đặt Mobile App (Capacitor)
Ứng dụng di động đóng gói web source thông qua Capacitor.
1. Từ Terminal, di chuyển vào thư mục `mobile-app`:
   ```bash
   cd mobile-app
   ```
2. Cài đặt các package từ npm:
   ```bash
   npm install
   ```
3. Đồng bộ hóa với nền tảng native (nếu có cập nhật source HTML/JS trong thư mục `www`):
   ```bash
   npx cap sync
   ```
4. Để test trên trình duyệt, bạn có thể chạy ứng dụng qua server cục bộ. Để build app trực tiếp lên máy ảo / thiết bị thật:
   ```bash
   npx cap run android
   # hoặc
   npx cap run ios
   ```

## Tài liệu tham khảo
Bạn có thể xem thêm phần mô tả nghiệp vụ của hệ thống (Use Case, Activity Diagrams) trong thư mục:
`doc/BA.md`
