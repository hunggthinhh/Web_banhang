# CHƯƠNG 2: CƠ SỞ LÝ THUYẾT

---

## 2.1. Tổng quan về Thương mại điện tử (E-Commerce)

### 2.1.1. Khái niệm

**Thương mại điện tử (E-Commerce – Electronic Commerce)** là hình thức kinh doanh, mua bán hàng hóa và dịch vụ thông qua các phương tiện điện tử, chủ yếu là mạng Internet. Các giao dịch thương mại điện tử bao gồm trao đổi dữ liệu, thanh toán trực tuyến và quản lý chuỗi cung ứng.

Theo Tổ chức Thương mại Thế giới (WTO), thương mại điện tử là "việc sản xuất, quảng cáo, bán hàng và phân phối sản phẩm, dịch vụ được thực hiện thông qua mạng viễn thông."

### 2.1.2. Các mô hình thương mại điện tử

| Mô hình | Tên đầy đủ | Mô tả |
|:---|:---|:---|
| **B2C** | Business to Consumer | Doanh nghiệp bán hàng trực tiếp đến người tiêu dùng cuối cùng |
| **B2B** | Business to Business | Giao dịch giữa các doanh nghiệp với nhau |
| **C2C** | Consumer to Consumer | Người tiêu dùng trao đổi hàng hóa với nhau (sàn giao dịch) |
| **C2B** | Consumer to Business | Người dùng cung cấp giá trị cho doanh nghiệp |

> **Mô hình áp dụng trong dự án:** Hệ thống Web Bán Hàng Bánh áp dụng mô hình **B2C** – cửa hàng bánh là doanh nghiệp, cung cấp sản phẩm trực tiếp đến khách hàng cá nhân thông qua nền tảng web.

### 2.1.3. Lợi ích của thương mại điện tử

- **Mở rộng thị trường:** Tiếp cận khách hàng mọi lúc, mọi nơi, không giới hạn địa lý.
- **Tiết kiệm chi phí:** Giảm thiểu chi phí mặt bằng, nhân sự bán hàng trực tiếp.
- **Tăng trải nghiệm người dùng:** Khách hàng có thể duyệt sản phẩm, đặt hàng và theo dõi đơn hàng 24/7.
- **Quản lý hiệu quả:** Admin có thể theo dõi báo cáo doanh thu, quản lý hàng hóa và đơn hàng theo thời gian thực.

---

## 2.2. Kiến trúc phần mềm

### 2.2.1. Kiến trúc Client – Server

**Kiến trúc Client – Server** là mô hình phân tán trong đó các tác vụ và khối lượng công việc được phân chia giữa hai thực thể chính:

- **Client (Máy khách):** Là phía người dùng cuối, gửi yêu cầu (request) đến server và hiển thị kết quả trả về. Trong dự án, đây là các trang web PHP/HTML chạy trên trình duyệt người dùng.
- **Server (Máy chủ):** Tiếp nhận yêu cầu, xử lý nghiệp vụ, truy vấn cơ sở dữ liệu và trả về phản hồi (response). Trong dự án, đây là Laravel Backend API chạy trên XAMPP Apache.

```
┌─────────────────────┐         HTTP Request          ┌──────────────────────┐
│     CLIENT          │  ─────────────────────────>   │      SERVER          │
│  (Trình duyệt)      │                               │   (Laravel API)      │
│  store-web (PHP)    │  <─────────────────────────   │   + MySQL Database   │
│  admin-web (PHP)    │         JSON Response          └──────────────────────┘
└─────────────────────┘
```

### 2.2.2. Kiến trúc MVC (Model – View – Controller)

**MVC (Model – View – Controller)** là một mẫu thiết kế kiến trúc phần mềm phổ biến, phân tách ứng dụng thành ba thành phần có trách nhiệm riêng biệt:

| Thành phần | Vai trò | Ví dụ trong dự án |
|:---|:---|:---|
| **Model** | Định nghĩa cấu trúc dữ liệu, tương tác với CSDL | `Product.php`, `Order.php`, `User.php` |
| **View** | Hiển thị dữ liệu đến người dùng | Các trang `.php` trong `store-web`, `admin-web` |
| **Controller** | Xử lý logic nghiệp vụ, trung gian giữa Model và View | `ProductController.php`, `OrderController.php` |

**Luồng hoạt động MVC:**
```
Người dùng → (Request) → Controller → Model (CSDL) → Controller → View → (Response) → Người dùng
```

Kiến trúc MVC giúp code **dễ bảo trì**, **dễ mở rộng** và **tách biệt rõ ràng** các mối quan tâm (Separation of Concerns).

### 2.2.3. Kiến trúc RESTful API

**REST (Representational State Transfer)** là một kiểu kiến trúc phần mềm cho hệ thống phân tán hypermedia. **RESTful API** là API tuân theo các nguyên tắc REST.

**6 nguyên tắc cốt lõi của REST:**
1. **Client – Server:** Tách biệt client và server.
2. **Stateless (Phi trạng thái):** Mỗi request chứa đủ thông tin để server xử lý, không lưu session phía server.
3. **Cacheable:** Phản hồi có thể được cache để tăng hiệu năng.
4. **Uniform Interface:** Giao diện nhất quán qua các endpoint chuẩn.
5. **Layered System:** Kiến trúc phân lớp.
6. **Code on Demand (tùy chọn):** Server có thể gửi code thực thi về client.

**Các phương thức HTTP trong RESTful:**

| HTTP Method | Chức năng | Ví dụ trong dự án |
|:---|:---|:---|
| `GET` | Lấy dữ liệu | `GET /api/products` – lấy danh sách sản phẩm |
| `POST` | Tạo mới | `POST /api/orders` – tạo đơn hàng mới |
| `PUT/PATCH` | Cập nhật | `PUT /api/products/{id}` – sửa thông tin sản phẩm |
| `DELETE` | Xóa | `DELETE /api/products/{id}` – xóa sản phẩm |

---

## 2.3. Ngôn ngữ lập trình và Công nghệ sử dụng

### 2.3.1. PHP (Hypertext Preprocessor)

**PHP** là ngôn ngữ lập trình kịch bản phía server (server-side scripting language) mã nguồn mở, được thiết kế đặc biệt cho phát triển web. PHP được nhúng trực tiếp vào HTML và xử lý trên server trước khi gửi kết quả về client.

**Đặc điểm của PHP:**
- Ngôn ngữ kịch bản dễ học, cú pháp gần với C/Java.
- Hỗ trợ đa dạng cơ sở dữ liệu (MySQL, PostgreSQL, SQLite...).
- Chạy được trên mọi hệ điều hành (Windows, Linux, macOS).
- Cộng đồng lớn, tài liệu phong phú.
- Hỗ trợ lập trình hướng đối tượng (OOP) từ phiên bản 5 trở lên.

**Phiên bản sử dụng trong dự án:** PHP ^8.3 – phiên bản hiện đại nhất, hỗ trợ các tính năng như Named Arguments, Fibers, Enums và cải thiện hiệu suất đáng kể.

**Vai trò của PHP trong dự án:**
- **Backend:** Xây dựng toàn bộ logic nghiệp vụ thông qua Laravel Framework.
- **Frontend:** Sử dụng PHP thuần để render giao diện người dùng (`store-web`) và trang quản trị (`admin-web`), đồng thời gọi API Laravel thông qua `fetch()`/AJAX.

### 2.3.2. JavaScript

**JavaScript (JS)** là ngôn ngữ lập trình kịch bản phía client (client-side), chạy trực tiếp trên trình duyệt. JavaScript là ngôn ngữ lập trình duy nhất được tất cả các trình duyệt web hiện đại hỗ trợ nguyên sinh.

**Đặc điểm:**
- **Bất đồng bộ (Asynchronous):** Hỗ trợ `async/await`, `Promise` để xử lý các tác vụ không đồng bộ như gọi API.
- **DOM Manipulation:** Tương tác và cập nhật giao diện người dùng theo thời gian thực mà không cần tải lại trang.
- **Event-Driven:** Xử lý các sự kiện người dùng (click, input, submit...).

**Vai trò trong dự án:**
- Gọi RESTful API từ Laravel backend bằng `fetch()`.
- Quản lý giỏ hàng trong `localStorage`.
- Xử lý xác thực dữ liệu phía client (client-side validation).
- Hiển thị thông báo, cập nhật UI động (loading states, error messages).

### 2.3.3. HTML5 & CSS3

**HTML5 (HyperText Markup Language)** là ngôn ngữ đánh dấu chuẩn để xây dựng cấu trúc trang web. HTML5 bổ sung nhiều thẻ ngữ nghĩa mới (`<header>`, `<nav>`, `<section>`, `<footer>`) giúp cấu trúc trang rõ ràng hơn.

**CSS3 (Cascading Style Sheets)** là ngôn ngữ định kiểu, quy định giao diện hiển thị của các phần tử HTML. CSS3 hỗ trợ:
- Flexbox và CSS Grid cho bố cục responsive.
- Animations và Transitions cho hiệu ứng mượt mà.
- Custom Properties (biến CSS) để dễ quản lý style.
- Media Queries để thiết kế giao diện thích ứng (responsive design).

---

## 2.4. Framework Laravel

### 2.4.1. Giới thiệu Laravel

**Laravel** là một PHP framework mã nguồn mở được Taylor Otwell tạo ra năm 2011. Laravel được xây dựng theo mô hình MVC và cung cấp một hệ sinh thái phong phú giúp đẩy nhanh quá trình phát triển ứng dụng web.

**Phiên bản sử dụng:** Laravel **13.x** – phiên bản LTS (Long-Term Support) mới nhất, yêu cầu PHP 8.3+.

**Triết lý thiết kế của Laravel:**
> *"Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling."* – Taylor Otwell

### 2.4.2. Các thành phần cốt lõi của Laravel

#### a) Eloquent ORM (Object-Relational Mapping)

**Eloquent ORM** là hệ thống ánh xạ đối tượng – quan hệ của Laravel. Eloquent cho phép tương tác với cơ sở dữ liệu thông qua các **Model** thuần túy dưới dạng đối tượng PHP thay vì viết câu truy vấn SQL thô.

**Ví dụ Eloquent trong dự án (Product Model):**
```php
// Lấy tất cả sản phẩm theo danh mục
$products = Product::where('category_id', $id)
                   ->orderBy('created_at', 'desc')
                   ->get();

// Tạo sản phẩm mới
Product::create([
    'name'        => 'Bánh kem sinh nhật',
    'price'       => 250000,
    'category_id' => 1,
]);
```

**Quan hệ Eloquent được sử dụng trong dự án:**

| Loại quan hệ | Ý nghĩa | Ví dụ trong dự án |
|:---|:---|:---|
| `hasMany` | Một – Nhiều | `Product hasMany OrderItem` |
| `belongsTo` | Nhiều – Một | `OrderItem belongsTo Product` |
| `hasMany` | Một – Nhiều | `Order hasMany OrderItem` |
| `belongsTo` | Nhiều – Một | `Order belongsTo User` |

#### b) Routing (Định tuyến)

**Laravel Router** định nghĩa các điểm cuối (endpoints) mà ứng dụng có thể phản hồi. Dự án sử dụng **API Routes** trong `routes/api.php` để xây dựng RESTful API.

```php
// Ví dụ từ routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
```

#### c) Middleware

**Middleware** hoạt động như một bộ lọc HTTP, được thực thi trước hoặc sau khi request đến controller. Laravel cung cấp nhiều middleware tích hợp sẵn và cho phép tạo middleware tùy chỉnh.

**Middleware sử dụng trong dự án:**
- `auth:sanctum` – Xác thực token, bảo vệ các endpoint yêu cầu đăng nhập.
- `cors` – Xử lý Cross-Origin Resource Sharing, cho phép frontend gọi API từ domain khác.

#### d) Validation (Xác thực dữ liệu)

Laravel cung cấp hệ thống validation mạnh mẽ để kiểm tra dữ liệu đầu vào trước khi xử lý nghiệp vụ.

```php
// Ví dụ validation đăng ký tài khoản
$request->validate([
    'name'     => 'required|string|max:255',
    'email'    => 'required|email|ends_with:@gmail.com|unique:users',
    'phone'    => 'required|regex:/^0[0-9]{9}$/',
    'password' => 'required|min:8|confirmed',
]);
```

#### e) Migration (Di trú cơ sở dữ liệu)

**Migration** là cơ chế quản lý phiên bản schema cơ sở dữ liệu, tương tự như Git cho CSDL. Migration cho phép định nghĩa và chia sẻ cấu trúc bảng dữ liệu trong code PHP.

**Các migration chính trong dự án:**

| Migration | Bảng được tạo | Mô tả |
|:---|:---|:---|
| `create_users_table` | `users` | Thông tin tài khoản người dùng |
| `create_products_table` | `products` | Danh mục sản phẩm bánh |
| `create_categories_table` | `categories` | Phân loại sản phẩm |
| `create_orders_table` | `orders` | Đơn hàng của khách hàng |
| `create_order_items_table` | `order_items` | Chi tiết từng sản phẩm trong đơn |
| `create_user_addresses_table` | `user_addresses` | Địa chỉ giao hàng của người dùng |
| `create_contacts_table` | `contacts` | Lưu tin nhắn liên hệ từ khách |

#### f) Artisan CLI

**Artisan** là giao diện dòng lệnh tích hợp sẵn trong Laravel, cung cấp các lệnh hữu ích trong quá trình phát triển:

```bash
php artisan make:model Product -m       # Tạo Model và Migration
php artisan make:controller Api/ProductController --api  # Tạo API Controller
php artisan migrate                     # Chạy migration
php artisan serve                       # Khởi động dev server
php artisan route:list                  # Liệt kê tất cả routes
```

---

## 2.5. Laravel Sanctum – Xác thực API

### 2.5.1. Giới thiệu Laravel Sanctum

**Laravel Sanctum** là gói xác thực nhẹ (lightweight authentication package) tích hợp sẵn trong hệ sinh thái Laravel, cung cấp giải pháp xác thực đơn giản dành riêng cho:
- **SPA (Single Page Applications)**
- **Mobile applications**
- **API-based applications** (như dự án này)

**Phiên bản sử dụng:** Laravel Sanctum ^4.0

### 2.5.2. Cơ chế Token-based Authentication

Sanctum sử dụng cơ chế **Personal Access Token** – mã thông báo truy cập cá nhân – để xác thực người dùng:

```
┌─────────────┐    POST /api/login     ┌─────────────────┐
│   Client    │  ──────────────────>   │  Laravel API    │
│  (Browser)  │    {email, password}   │  with Sanctum   │
│             │  <──────────────────   │                 │
│             │    {token: "abc..."}   └─────────────────┘
│             │                                │
│             │  GET /api/profile              │
│             │  Authorization: Bearer abc...  │
│             │  ──────────────────────────>   │ Xác thực token
│             │  <──────────────────────────   │ từ DB
│             │    {user data}                 │
└─────────────┘                        ────────┘
```

**Luồng xác thực trong dự án:**
1. Người dùng gửi `email` và `password` đến `POST /api/login`.
2. Laravel xác thực thông tin, tạo **Personal Access Token** và trả về client.
3. Client lưu token vào `localStorage`.
4. Với mỗi request tiếp theo, client gửi token trong header `Authorization: Bearer {token}`.
5. Middleware `auth:sanctum` kiểm tra token trong database, xác thực người dùng.

### 2.5.3. Bảo mật với Sanctum

- Token được lưu trong bảng `personal_access_tokens` với thông tin hash.
- Hỗ trợ **token expiry** (hết hạn token).
- Hỗ trợ **token revocation** (thu hồi token) khi người dùng đăng xuất.
- Mỗi token có thể được gán các **abilities** (khả năng) khác nhau để phân quyền.

---

## 2.6. Hệ quản trị Cơ sở dữ liệu MySQL

### 2.6.1. Giới thiệu MySQL

**MySQL** là hệ quản trị cơ sở dữ liệu quan hệ (RDBMS – Relational Database Management System) mã nguồn mở phổ biến nhất thế giới, phát triển bởi Oracle Corporation. MySQL sử dụng ngôn ngữ truy vấn có cấu trúc **SQL (Structured Query Language)**.

**Đặc điểm:**
- Hiệu suất cao, có thể xử lý hàng triệu bản ghi.
- Hỗ trợ ACID (Atomicity, Consistency, Isolation, Durability) đảm bảo tính toàn vẹn dữ liệu.
- Hỗ trợ các ràng buộc: `PRIMARY KEY`, `FOREIGN KEY`, `UNIQUE`, `NOT NULL`.
- Tích hợp tốt với PHP và Laravel.

### 2.6.2. Mô hình quan hệ CSDL trong dự án

```
users ──────────────< orders >──────────< order_items >────────── products
  │                                                                    │
  └──< user_addresses                              categories >────────┘
  
contacts (bảng độc lập – lưu liên hệ khách)
```

**Mô tả các bảng chính:**

| Bảng | Khóa chính | Mô tả |
|:---|:---|:---|
| `users` | `id` | Tài khoản người dùng (name, email, phone, password, role) |
| `categories` | `id` | Danh mục sản phẩm (name, description) |
| `products` | `id` | Sản phẩm bánh (name, price, image, category_id, description) |
| `orders` | `id` | Đơn hàng (user_id, total, status, address, phone) |
| `order_items` | `id` | Chi tiết đơn hàng (order_id, product_id, qty, price) |
| `user_addresses` | `id` | Địa chỉ giao hàng (user_id, address, city, is_default) |
| `contacts` | `id` | Liên hệ khách hàng (name, email, message) |

---

## 2.7. Môi trường phát triển XAMPP

### 2.7.1. Giới thiệu XAMPP

**XAMPP** là một gói phần mềm server web đa nền tảng (cross-platform) miễn phí, được phát triển bởi Apache Friends. XAMPP cung cấp môi trường phát triển web cục bộ hoàn chỉnh với:

| Thành phần | Từ viết tắt trong XAMPP | Chức năng |
|:---|:---|:---|
| Apache | **A** | Web server – phục vụ các trang web |
| MariaDB/MySQL | **M** | Hệ quản trị cơ sở dữ liệu |
| PHP | **P** | Ngôn ngữ lập trình server-side |
| Perl | **P** | Ngôn ngữ kịch bản bổ sung |

### 2.7.2. Vai trò trong dự án

Trong dự án này, XAMPP đóng vai trò:
- **Apache:** Phục vụ các trang PHP của `store-web` và `admin-web` tại `http://localhost/Web_banhang/frontend/`.
- **MySQL:** Lưu trữ toàn bộ dữ liệu hệ thống (sản phẩm, đơn hàng, người dùng...).
- Laravel Backend được chạy song song qua `php artisan serve` tại `http://localhost:8000`.

---

## 2.8. Giao thức HTTP và JSON

### 2.8.1. Giao thức HTTP/HTTPS

**HTTP (HyperText Transfer Protocol)** là giao thức truyền tải nền tảng của World Wide Web, định nghĩa cách thức client và server trao đổi dữ liệu.

**Cấu trúc một HTTP Request:**
```
POST /api/orders HTTP/1.1
Host: localhost:8000
Authorization: Bearer eyJ0eXAiOiJKV1Q...
Content-Type: application/json

{
  "items": [...],
  "address": "123 Đường ABC",
  "phone": "0901234567"
}
```

**HTTP Status Codes sử dụng trong dự án:**

| Mã | Ý nghĩa | Tình huống |
|:---|:---|:---|
| `200 OK` | Thành công | Lấy danh sách sản phẩm |
| `201 Created` | Tạo mới thành công | Đặt hàng thành công |
| `401 Unauthorized` | Chưa xác thực | Token không hợp lệ/hết hạn |
| `403 Forbidden` | Không có quyền | Người dùng truy cập tính năng Admin |
| `404 Not Found` | Không tìm thấy | Sản phẩm không tồn tại |
| `422 Unprocessable Entity` | Dữ liệu không hợp lệ | Validation thất bại |
| `500 Internal Server Error` | Lỗi server | Lỗi không mong đợi |

### 2.8.2. JSON (JavaScript Object Notation)

**JSON** là định dạng trao đổi dữ liệu nhẹ, dễ đọc cho cả người và máy tính. JSON là định dạng chuẩn được sử dụng cho tất cả giao tiếp giữa frontend và Laravel API trong dự án.

```json
{
  "status": "success",
  "data": {
    "id": 1,
    "name": "Bánh kem sinh nhật",
    "price": 250000,
    "category": {
      "id": 1,
      "name": "Bánh kem"
    }
  }
}
```

---

## 2.9. Bảo mật ứng dụng web

### 2.9.1. Mã hóa mật khẩu (Password Hashing)

Dự án sử dụng thuật toán **Bcrypt** thông qua hàm `Hash::make()` của Laravel để mã hóa mật khẩu một chiều trước khi lưu vào cơ sở dữ liệu. Bcrypt tự động thêm **salt** ngẫu nhiên vào mỗi lần mã hóa, đảm bảo cùng một mật khẩu sẽ cho ra các hash khác nhau.

```php
// Mã hóa mật khẩu khi đăng ký
'password' => Hash::make($request->password),

// Kiểm tra mật khẩu khi đăng nhập
Hash::check($request->password, $user->password)
```

### 2.9.2. CORS (Cross-Origin Resource Sharing)

**CORS** là cơ chế bảo mật trình duyệt kiểm soát các request HTTP cross-origin (từ domain/port khác). Vì frontend (`localhost/...`) và backend API (`localhost:8000`) chạy ở các origin khác nhau, Laravel được cấu hình CORS để cho phép frontend giao tiếp với API.

### 2.9.3. Phân quyền (Authorization)

Hệ thống phân hai cấp quyền dựa trên trường `role` trong bảng `users`:

| Role | Giá trị | Quyền hạn |
|:---|:---|:---|
| **Khách hàng** | `user` | Xem sản phẩm, đặt hàng, quản lý thông tin cá nhân |
| **Quản trị viên** | `admin` | Toàn quyền quản lý sản phẩm, danh mục, đơn hàng, người dùng |

---

## 2.10. LocalStorage và Quản lý trạng thái phía Client

### 2.10.1. LocalStorage

**localStorage** là API của trình duyệt cho phép lưu trữ dữ liệu dạng key-value cục bộ trên máy người dùng, không có thời gian hết hạn (trừ khi xóa thủ công).

**Sử dụng trong dự án:**

| Key | Dữ liệu lưu trữ | Mục đích |
|:---|:---|:---|
| `token` | Personal Access Token của Sanctum | Xác thực người dùng cho mỗi request API |
| `cart` | Mảng JSON các sản phẩm trong giỏ | Duy trì giỏ hàng khi tải lại trang |
| `user` | Thông tin người dùng đã đăng nhập | Hiển thị tên, avatar trên navbar |

```javascript
// Lưu token sau khi đăng nhập thành công
localStorage.setItem('token', data.token);

// Lấy token để gọi API có bảo vệ
const token = localStorage.getItem('token');
fetch('/api/orders', {
    headers: { 'Authorization': `Bearer ${token}` }
});
```

---

## 2.11. Tóm tắt công nghệ sử dụng trong dự án

| Hạng mục | Công nghệ / Framework | Phiên bản |
|:---|:---|:---|
| **Backend Language** | PHP | ^8.3 |
| **Backend Framework** | Laravel | ^13.x |
| **Authentication** | Laravel Sanctum | ^4.0 |
| **Database** | MySQL (qua XAMPP) | 8.0+ |
| **ORM** | Eloquent ORM | (kèm Laravel) |
| **Frontend Language** | PHP, HTML5, CSS3 | – |
| **Frontend Scripting** | Vanilla JavaScript | ES2021+ |
| **Development Server** | XAMPP (Apache) | 8.x |
| **API Format** | RESTful JSON API | – |
| **Architecture** | MVC + Client-Server | – |
| **Storage (Client)** | localStorage API | – |

---

*Chương này đã trình bày các nền tảng lý thuyết cốt lõi làm cơ sở cho việc thiết kế và xây dựng hệ thống Web Bán Hàng Bánh. Các khái niệm về thương mại điện tử, kiến trúc MVC, RESTful API, Laravel Framework và Laravel Sanctum sẽ được áp dụng xuyên suốt trong các chương tiếp theo.*
