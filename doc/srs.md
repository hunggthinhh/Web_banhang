# Tài Liệu Đặc Tả Yêu Cầu Phần Mềm (SRS)

**Tên dự án:** La Pâtisserie – Hệ thống Thương mại Điện tử Bánh
**Phiên bản:** 1.0
**Ngày lập:** 21/04/2026
**Trạng thái:** Hoàn chỉnh

---

## Mục lục

1. [Giới thiệu](#1-giới-thiệu)
2. [Mô tả tổng quan hệ thống](#2-mô-tả-tổng-quan-hệ-thống)
3. [Kiến trúc hệ thống](#3-kiến-trúc-hệ-thống)
4. [Các tác nhân (Actors)](#4-các-tác-nhân-actors)
5. [Yêu cầu chức năng (Functional Requirements)](#5-yêu-cầu-chức-năng-functional-requirements)
6. [Đặc tả Use Case chi tiết](#6-đặc-tả-use-case-chi-tiết)
7. [Yêu cầu phi chức năng (Non-Functional Requirements)](#7-yêu-cầu-phi-chức-năng-non-functional-requirements)
8. [Mô hình cơ sở dữ liệu](#8-mô-hình-cơ-sở-dữ-liệu)
9. [Đặc tả API](#9-đặc-tả-api)
10. [Ràng buộc và giả định](#10-ràng-buộc-và-giả-định)

---

## 1. Giới thiệu

### 1.1. Mục đích tài liệu
Tài liệu này mô tả đầy đủ và chi tiết các yêu cầu chức năng và phi chức năng của hệ thống **La Pâtisserie** – nền tảng thương mại điện tử chuyên bán bánh trực tuyến. Tài liệu phục vụ cho việc phát triển, kiểm thử và bàn giao sản phẩm, làm cơ sở thống nhất giữa nhóm phát triển và các bên liên quan.

### 1.2. Phạm vi hệ thống
Hệ thống **La Pâtisserie** bao gồm 3 nền tảng độc lập, hoạt động thống nhất qua một REST API dùng chung:

| Nền tảng | Mô tả |
|---|---|
| **Web Cửa hàng (Store Web)** | Giao diện mua sắm dành cho khách hàng |
| **Web Quản trị (Admin Web)** | Giao diện quản lý vận hành dành cho Quản trị viên |
| **Ứng dụng Di động (Mobile App)** | Ứng dụng lai (Hybrid) cho Android, dùng Capacitor |

### 1.3. Định nghĩa và từ viết tắt

| Ký hiệu | Diễn giải |
|---|---|
| **UC** | Use Case – Kịch bản sử dụng |
| **API** | Application Programming Interface – Giao diện lập trình ứng dụng |
| **REST** | Representational State Transfer |
| **SRS** | Software Requirements Specification – Đặc tả yêu cầu phần mềm |
| **COD** | Cash on Delivery – Thanh toán khi nhận hàng |
| **QR** | Quick Response Code – Mã thanh toán nhanh |
| **Guest** | Khách vãng lai – người dùng chưa đăng nhập |
| **Member** | Thành viên – người dùng đã đăng ký tài khoản |
| **Admin** | Quản trị viên hệ thống |

### 1.4. Tài liệu tham khảo
- Tài liệu Phân tích nghiệp vụ (BA.md)
- Mã nguồn dự án tại `/Applications/XAMPP/xamppfiles/htdocs/Web_banhang/`
- SePay Webhook Documentation: https://docs.sepay.vn/tich-hop-webhook.html
- Laravel Sanctum Documentation

---

## 2. Mô tả tổng quan hệ thống

### 2.1. Bối cảnh nghiệp vụ
**La Pâtisserie** (tiếng Pháp: Tiệm bánh vàng) là một tiệm bánh muốn mở rộng kênh bán hàng từ cửa hàng truyền thống sang thương mại điện tử. Hệ thống cho phép khách hàng dễ dàng đặt bánh trực tuyến, theo dõi đơn hàng, và thanh toán linh hoạt, trong khi đội ngũ quản lý có thể vận hành toàn bộ nghiệp vụ từ một giao diện trực quan.

### 2.2. Mục tiêu hệ thống
- **Tăng kênh bán hàng:** Mở rộng tiếp cận khách hàng thông qua web và ứng dụng di động.
- **Tối ưu trải nghiệm mua sắm:** Cho phép đặt hàng nhanh không cần đăng ký tài khoản (Guest Checkout).
- **Số hóa quản lý:** Quản trị viên kiểm soát toàn bộ sản phẩm, danh mục, đơn hàng và doanh thu từ dashboard.
- **Tích hợp thanh toán tự động:** Xác nhận đơn hàng tự động qua webhook ngân hàng (SePay/VietQR).

### 2.3. Giả định và phụ thuộc
- Hệ thống yêu cầu kết nối Internet để gọi API backend.
- Tính năng thanh toán QR sử dụng dịch vụ trung gian SePay và cần Ngrok tunnel (hoặc domain thực) để nhận webhook.
- Email hệ thống (xác nhận đơn hàng, quên mật khẩu) sử dụng cấu hình SMTP trong file `.env`.

---

## 3. Kiến trúc hệ thống

### 3.1. Sơ đồ kiến trúc tổng quan

```
┌──────────────────────────────────────────────────────────────────┐
│                        CLIENT LAYER                              │
│  ┌─────────────────┐ ┌─────────────────┐ ┌──────────────────┐   │
│  │  Web Cửa hàng   │ │  Web Quản trị   │ │  Mobile App      │   │
│  │  (PHP + JS)     │ │  (PHP + JS)     │ │  (Capacitor +    │   │
│  │  store-web/     │ │  admin-web/     │ │   HTML/CSS/JS)   │   │
│  └────────┬────────┘ └────────┬────────┘ └────────┬─────────┘   │
└───────────┼──────────────────┼──────────────────╌─┼─────────────┘
            │                  │                    │
            └──────────────────┼────────────────────┘
                               │  HTTPS REST API (JSON)
                               ▼
┌──────────────────────────────────────────────────────────────────┐
│                      BACKEND LAYER (Laravel)                     │
│  ┌──────────────────────────────────────────────────────────┐    │
│  │              Laravel REST API (Sanctum Auth)             │    │
│  │   AuthController │ ProductController │ OrderController   │    │
│  │   CategoryController │ DashboardController │ ...         │    │
│  └───────────────────────────┬──────────────────────────────┘    │
└──────────────────────────────┼───────────────────────────────────┘
                               │
               ┌───────────────┼───────────────┐
               ▼               ▼               ▼
┌──────────────────┐  ┌──────────────┐  ┌────────────────┐
│  MySQL Database  │  │  File Storage│  │  Email (SMTP)  │
│  (XAMPP/MySQL)   │  │  /uploads/   │  │  + SePay Hook  │
└──────────────────┘  └──────────────┘  └────────────────┘
```

### 3.2. Công nghệ sử dụng

| Thành phần | Công nghệ |
|---|---|
| **Backend Framework** | Laravel 11 (PHP 8.x) |
| **Xác thực API** | Laravel Sanctum (Token-based) |
| **Cơ sở dữ liệu** | MySQL 8.x (XAMPP) |
| **Web Frontend** | PHP, HTML5, CSS3, JavaScript (Vanilla) |
| **Mobile App** | Capacitor 6 (Hybrid) – Android |
| **Payment Gateway** | SePay Webhook + VietQR Dynamic QR |
| **Email** | Laravel Mailable + SMTP |
| **Web Server (Dev)** | Apache (XAMPP) |
| **Tunnel (Dev)** | Ngrok |

---

## 4. Các tác nhân (Actors)

### 4.1. Bảng mô tả Actor

| Actor | Tên | Mô tả | Quyền hạn |
|---|---|---|---|
| **A1** | Khách vãng lai (Guest) | Người dùng chưa đăng nhập, truy cập lần đầu | Duyệt, tìm kiếm, mua hàng, liên hệ |
| **A2** | Thành viên (Member) | Người dùng đã đăng ký và đăng nhập thành công | Kế thừa Guest + quản lý tài khoản, lịch sử đơn hàng |
| **A3** | Quản trị viên (Admin) | Nhân viên quản lý hệ thống, có `role = 'admin'` | Quản lý toàn bộ sản phẩm, đơn hàng, người dùng, thống kê |
| **A4** | Hệ thống thanh toán (SePay) | Dịch vụ bên thứ ba, tự động gọi webhook | Cập nhật trạng thái thanh toán đơn hàng |

### 4.2. Phân quyền theo Actor

| Chức năng | Guest | Member | Admin |
|---|:---:|:---:|:---:|
| Duyệt danh sách sản phẩm | ✓ | ✓ | ✓ |
| Xem chi tiết sản phẩm | ✓ | ✓ | ✓ |
| Tìm kiếm sản phẩm | ✓ | ✓ | ✓ |
| Lọc theo danh mục | ✓ | ✓ | ✓ |
| Quản lý giỏ hàng | ✓ | ✓ | - |
| Đặt hàng (Guest Checkout) | ✓ | ✓ | - |
| Thanh toán QR / COD | ✓ | ✓ | - |
| Liên hệ / Gửi phản hồi | ✓ | ✓ | - |
| Đăng ký tài khoản | ✓ | - | - |
| Đăng nhập / Đăng xuất | ✓ | ✓ | ✓ |
| Quên mật khẩu / Đặt lại | ✓ | ✓ | - |
| Quản lý thông tin cá nhân | - | ✓ | - |
| Quản lý sổ địa chỉ | - | ✓ | - |
| Xem lịch sử đơn hàng | - | ✓ | - |
| Quản lý giỏ hàng đã đăng nhập | - | ✓ | - |
| Quản lý sản phẩm (CRUD) | - | - | ✓ |
| Quản lý danh mục (CRUD) | - | - | ✓ |
| Quản lý đơn hàng | - | - | ✓ |
| Quản lý người dùng | - | - | ✓ |
| Quản lý liên hệ | - | - | ✓ |
| Xem thống kê & doanh thu | - | - | ✓ |
| Xuất báo cáo doanh thu | - | - | ✓ |

---

## 5. Yêu cầu chức năng (Functional Requirements)

### 5.1. Nhóm chức năng dành cho Khách hàng (Guest & Member)

#### UC-01: Xem danh sách sản phẩm
- **Mã UC:** UC-01
- **Actor:** Guest, Member
- **Mô tả:** Hệ thống hiển thị toàn bộ danh sách sản phẩm đang kinh doanh, có hình ảnh, tên và giá bán.
- **Yêu cầu:** Hỗ trợ lọc theo danh mục, hiển thị sản phẩm nổi bật (`is_featured = true`) trên trang chủ, sắp xếp theo mới nhất.

#### UC-02: Xem chi tiết sản phẩm
- **Mã UC:** UC-02
- **Actor:** Guest, Member
- **Mô tả:** Người dùng xem thông tin chi tiết sản phẩm bao gồm nhiều ảnh phụ (`sub_images`), mô tả ngắn, nội dung chi tiết (content), giá và danh mục.
- **Yêu cầu:** Hiển thị tối đa 4 ảnh phụ. Hiển thị tối đa 4 sản phẩm liên quan cùng danh mục.

#### UC-03: Tìm kiếm sản phẩm
- **Mã UC:** UC-03
- **Actor:** Guest, Member, Admin
- **Mô tả:** Người dùng nhập từ khóa, hệ thống tìm kiếm theo tên và mô tả của sản phẩm, trả về danh sách kết quả phù hợp.

#### UC-04: Quản lý giỏ hàng
- **Mã UC:** UC-04
- **Actor:** Guest (LocalStorage), Member (LocalStorage + API đồng bộ)
- **Mô tả:** Người dùng thêm sản phẩm vào giỏ, thay đổi số lượng, xóa sản phẩm khỏi giỏ.
- **Yêu cầu:** Guest dùng LocalStorage. Member đăng nhập được đồng bộ giỏ hàng lên server qua API `/api/cart`.

#### UC-05: Đặt hàng (Checkout – Guest & Member)
- **Mã UC:** UC-05
- **Actor:** Guest, Member
- **Mô tả:** Người dùng không cần đăng nhập vẫn có thể hoàn tất đơn hàng bằng cách nhập thông tin giao hàng và chọn phương thức thanh toán.
- **Yêu cầu:**
  - Thông tin bắt buộc: Họ tên, Số điện thoại (10 số, bắt đầu bằng 0), Email (@gmail.com), Địa chỉ giao hàng.
  - Phương thức thanh toán: COD hoặc Chuyển khoản QR (SePay).
  - Sau khi đặt hàng thành công, hệ thống gửi email xác nhận đến khách hàng.
  - Đơn hàng Guest có `user_id = null` nhưng liên kết qua `customer_phone`.

#### UC-06: Thanh toán QR (VietQR / SePay)
- **Mã UC:** UC-06
- **Actor:** Guest, Member
- **Mô tả:** Sau khi đặt hàng bằng phương thức "Chuyển khoản", hệ thống hiển thị QR Code (VietQR động) với mã đơn hàng nhúng trong nội dung chuyển khoản (định dạng `LPS{id}`). Hệ thống liên tục polling trạng thái đơn hàng cho đến khi xác nhận thanh toán.
- **Yêu cầu:** Webhook từ SePay tự động cập nhật `payment_status = 'paid'` và `status = 'confirmed'` khi ngân hàng xác nhận giao dịch.

#### UC-07: Đăng ký tài khoản
- **Mã UC:** UC-07
- **Actor:** Guest
- **Mô tả:** Người dùng mới tạo tài khoản để hưởng đặc quyền thành viên.
- **Yêu cầu:**
  - Trường bắt buộc: Tên đăng nhập (username, không trùng), Họ tên, Email (@gmail.com, không trùng), Mật khẩu (≥ 6 ký tự, xác nhận).
  - Trường tùy chọn: Số điện thoại (10 số, bắt đầu bằng 0).
  - Hệ thống trả về Bearer Token để đăng nhập tự động sau khi đăng ký.

#### UC-08: Đăng nhập
- **Mã UC:** UC-08
- **Actor:** Guest, Member, Admin
- **Mô tả:** Người dùng xác thực danh tính để truy cập tài khoản cá nhân hoặc dashboard admin.
- **Yêu cầu:**
  - Hỗ trợ đăng nhập bằng **Email hoặc Tên đăng nhập**.
  - Sử dụng Laravel Sanctum, trả về Bearer Token.
  - Thông báo lỗi rõ ràng nếu sai thông tin đăng nhập.

#### UC-09: Đăng xuất
- **Mã UC:** UC-09
- **Actor:** Member, Admin
- **Mô tả:** Người dùng kết thúc phiên làm việc. Hệ thống xóa Access Token hiện tại khỏi cơ sở dữ liệu.

#### UC-10: Quên mật khẩu
- **Mã UC:** UC-10
- **Actor:** Guest, Member
- **Mô tả:** Người dùng quên mật khẩu, yêu cầu gửi link đặt lại qua email.
- **Yêu cầu:**
  - Người dùng nhập email đăng ký.
  - Hệ thống tạo token ngẫu nhiên 64 ký tự, lưu vào `password_reset_tokens`.
  - Gửi email chứa link đặt lại mật khẩu, có hiệu lực trong **60 phút**.

#### UC-11: Đặt lại mật khẩu
- **Mã UC:** UC-11
- **Actor:** Guest, Member
- **Mô tả:** Người dùng truy cập link đặt lại trong email, nhập mật khẩu mới.
- **Yêu cầu:** Xác thực token hợp lệ và chưa hết hạn. Sau khi đặt lại, xóa token khỏi hệ thống.

#### UC-12: Quản lý thông tin cá nhân
- **Mã UC:** UC-12
- **Actor:** Member
- **Mô tả:** Thành viên cập nhật Họ tên, Email, Số điện thoại, Mật khẩu mới và ảnh đại diện (avatar).
- **Yêu cầu:** File ảnh được lưu tại `public/uploads/avatars/`.

#### UC-13: Quản lý sổ địa chỉ
- **Mã UC:** UC-13
- **Actor:** Member
- **Mô tả:** Thành viên thêm, chỉnh sửa, xóa và đặt địa chỉ mặc định cho các đơn hàng tương lai.
- **Yêu cầu:**
  - Mỗi địa chỉ gồm: Nhãn (alias), Họ tên người nhận, SĐT, Email, Tỉnh/Thành, Quận/Huyện, Phường/Xã, Địa chỉ chi tiết.
  - Địa chỉ đầu tiên được tự động đặt làm mặc định.
  - Chỉ một địa chỉ được đặt làm mặc định tại một thời điểm.

#### UC-14: Xem lịch sử đơn hàng
- **Mã UC:** UC-14
- **Actor:** Member
- **Mô tả:** Thành viên xem danh sách toàn bộ đơn hàng đã đặt, bao gồm cả đơn hàng Guest (liên kết qua số điện thoại) và đơn hàng đã đăng nhập.
- **Yêu cầu:** Hiển thị trạng thái đơn hàng, danh sách sản phẩm và tổng tiền.

#### UC-15: Gửi liên hệ / Phản hồi
- **Mã UC:** UC-15
- **Actor:** Guest, Member
- **Mô tả:** Người dùng gửi tin nhắn liên hệ đến tiệm bánh qua biểu mẫu trên trang web.
- **Yêu cầu:** Thông tin bắt buộc: Họ tên, Email (@gmail.com), Nội dung. Tùy chọn: Số điện thoại, Tiêu đề.

---

### 5.2. Nhóm chức năng dành cho Quản trị viên (Admin)

#### UC-16: Đăng nhập Admin
- **Mã UC:** UC-16
- **Actor:** Admin
- **Mô tả:** Quản trị viên đăng nhập vào hệ thống bằng tài khoản có `role = 'admin'`. Sau khi đăng nhập, được chuyển hướng đến Dashboard quản trị.

#### UC-17: Xem Dashboard & Thống kê
- **Mã UC:** UC-17
- **Actor:** Admin
- **Mô tả:** Admin xem tổng quan vận hành hệ thống trên một màn hình duy nhất.
- **Yêu cầu hệ thống phải hiển thị:**
  - Tổng số sản phẩm, đơn hàng, người dùng, liên hệ.
  - Doanh thu: theo tuần, theo tháng, theo năm, tổng cộng.
  - Biểu đồ doanh thu 6 tháng gần nhất.
  - Top 5 sản phẩm bán chạy nhất (theo số lượng).
  - 8 đơn hàng gần nhất.
  - Thống kê đơn hàng theo trạng thái.

#### UC-18: Xuất báo cáo doanh thu
- **Mã UC:** UC-18
- **Actor:** Admin
- **Mô tả:** Admin xuất báo cáo doanh thu ra file Excel theo khoảng thời gian (ngày, tuần, tháng).
- **Yêu cầu:** File Excel chứa: STT, Mã đơn hàng, Tên khách hàng, SĐT, Địa chỉ, Tổng tiền, Danh sách sản phẩm, Ngày đặt hàng.

#### UC-19: Quản lý sản phẩm
- **Mã UC:** UC-19
- **Actor:** Admin
- **Mô tả:** Admin thực hiện đầy đủ thao tác CRUD đối với sản phẩm.
- **Yêu cầu:**
  - **Thêm mới:** Tên, Danh mục, Giá, Mô tả ngắn, Nội dung chi tiết, Ảnh chính (upload file), 4 ảnh phụ (upload file), Trạng thái hiển thị (`is_active`), Đánh dấu nổi bật (`is_featured`).
  - **Chỉnh sửa:** Cập nhật bất kỳ trường thông tin nào.
  - **Xóa:** Gỡ bỏ sản phẩm khỏi hệ thống.
  - Ảnh được lưu tại `public/uploads/`.

#### UC-20: Quản lý danh mục
- **Mã UC:** UC-20
- **Actor:** Admin
- **Mô tả:** Admin tạo, chỉnh sửa và xóa các danh mục sản phẩm (Bánh kem, Bánh mì, Bánh quy...).
- **Yêu cầu:** Tên danh mục là bắt buộc và phải duy nhất trong hệ thống.

#### UC-21: Quản lý đơn hàng
- **Mã UC:** UC-21
- **Actor:** Admin
- **Mô tả:** Admin xem danh sách, lọc và cập nhật trạng thái đơn hàng xuyên suốt vòng đời đơn.
- **Yêu cầu:**
  - Lọc đơn hàng theo trạng thái: `pending | confirmed | processing | shipped | completed | delivered | cancelled`.
  - Cập nhật `status` và `payment_status` độc lập.
  - Hủy và xóa đơn hàng (xóa cả `order_items`).

#### UC-22: Quản lý người dùng
- **Mã UC:** UC-22
- **Actor:** Admin
- **Mô tả:** Admin xem danh sách khách hàng đã đăng ký, cập nhật vai trò (user/admin) và xóa tài khoản.

#### UC-23: Quản lý liên hệ
- **Mã UC:** UC-23
- **Actor:** Admin
- **Mô tả:** Admin xem các tin nhắn liên hệ, đánh dấu là đã đọc (`is_read = true`) và xóa tin nhắn không cần thiết.

---

## 6. Đặc tả Use Case chi tiết

### UC-05: Đặt hàng (Checkout)

| Mục | Nội dung |
|---|---|
| **Mã UC** | UC-05 |
| **Tên** | Đặt hàng (Checkout – Guest & Member) |
| **Actor chính** | Khách vãng lai (Guest), Thành viên (Member) |
| **Tiền điều kiện** | Giỏ hàng có ít nhất 1 sản phẩm |
| **Hậu điều kiện** | Đơn hàng được tạo trong CSDL, email xác nhận được gửi đến khách |

**Luồng sự kiện chính:**
1. Người dùng xem lại giỏ hàng tại trang `cart.php`.
2. Nhấn nút **"Thanh toán"**, chuyển sang `checkout.php`.
3. Nhập thông tin giao hàng: Họ tên, Số điện thoại, Email, Địa chỉ.
   - *(Member đã đăng nhập: thông tin tự động điền từ địa chỉ mặc định).*
4. Chọn phương thức thanh toán: **COD** hoặc **Chuyển khoản QR**.
5. Nhấn **"Đặt hàng"**.
6. Hệ thống gọi `POST /api/orders` với danh sách sản phẩm và thông tin giao hàng.
7. Backend tạo bản ghi `orders` và các `order_items` tương ứng trong một transaction.
8. Hệ thống gửi email xác nhận đơn hàng (nếu gửi lỗi thì chỉ log, không làm hỏng đơn).
9. Hiển thị trang thành công:
   - COD: Thông báo đặt hàng thành công, chờ giao hàng.
   - QR: Hiển thị mã QR thanh toán, bắt đầu vòng lặp polling trạng thái.

**Luồng ngoại lệ:**
- **E1 – Thông tin không hợp lệ:** Hệ thống trả về lỗi validation cụ thể (SĐT sai định dạng, Email không phải @gmail.com...).
- **E2 – Lỗi server:** Hệ thống rollback transaction, trả thông báo lỗi cho người dùng.

---

### UC-06: Thanh toán QR (VietQR / SePay)

| Mục | Nội dung |
|---|---|
| **Mã UC** | UC-06 |
| **Tên** | Thanh toán chuyển khoản tự động (SePay Webhook) |
| **Actor chính** | Guest / Member |
| **Actor phụ** | Hệ thống SePay (webhook caller) |
| **Tiền điều kiện** | Đơn hàng đã được tạo thành công với `payment_method = 'bank'` |
| **Hậu điều kiện** | Đơn hàng được cập nhật `payment_status = 'paid'`, `status = 'confirmed'` |

**Luồng sự kiện chính:**
1. Sau khi đặt hàng, hệ thống hiển thị QR Code VietQR động với nội dung chuyển khoản `LPS{order_id}`.
2. Khách hàng dùng ứng dụng ngân hàng quét QR và chuyển khoản.
3. Ngân hàng xác nhận giao dịch → SePay nhận thông tin → SePay gọi `POST /api/sepay/webhook`.
4. Hệ thống phân tích nội dung chuyển khoản, tìm `orderId` từ pattern `LPS(\d+)`.
5. Tìm đơn hàng trong CSDL, kiểm tra chưa được thanh toán.
6. Cập nhật `payment_status = 'paid'` và `status = 'confirmed'`.
7. **Phía khách hàng:** Trang web đang polling `GET /api/orders/{id}` mỗi vài giây. Khi phát hiện `payment_status = 'paid'`, hiển thị thông báo **"Thanh toán thành công!"**.

---

### UC-10: Quên mật khẩu

| Mục | Nội dung |
|---|---|
| **Mã UC** | UC-10 |
| **Tên** | Quên mật khẩu – Gửi email khôi phục |
| **Actor chính** | Guest, Member |
| **Tiền điều kiện** | Email đã được đăng ký trong hệ thống |
| **Hậu điều kiện** | Email khôi phục được gửi, token lưu vào `password_reset_tokens` |

**Luồng sự kiện chính:**
1. Người dùng truy cập `forgot-password.php`, nhập địa chỉ email.
2. Hệ thống gọi `POST /api/forgot-password`.
3. Backend xác nhận email tồn tại trong hệ thống.
4. Xóa token cũ (nếu có), tạo token ngẫu nhiên 64 ký tự mới.
5. Gửi email chứa link dạng: `reset-password.php?token=...&email=...`.
6. Link có hiệu lực **60 phút**, sau đó tự hết hạn.
7. Thông báo: *"Hướng dẫn khôi phục mật khẩu đã được gửi đến email của bạn."*

**Luồng ngoại lệ:**
- **E1 – Email không tồn tại:** Trả lỗi 404 *"Email không có trong hệ thống."*
- **E2 – Không gửi được email:** Trả lỗi 500, thông báo thử lại sau.

---

### UC-19: Quản lý sản phẩm (Admin)

| Mục | Nội dung |
|---|---|
| **Mã UC** | UC-19 |
| **Tên** | Quản lý sản phẩm – Thêm / Sửa / Xóa |
| **Actor chính** | Quản trị viên (Admin) |
| **Tiền điều kiện** | Admin đã đăng nhập thành công |
| **Hậu điều kiện** | Thông tin sản phẩm được cập nhật trong CSDL và phản ánh ngay trên cửa hàng |

**Luồng thêm sản phẩm mới:**
1. Admin truy cập trang `products.php` trong admin-web.
2. Nhấn **"Thêm sản phẩm mới"**, nhập thông tin.
3. Upload ảnh chính và tối đa 4 ảnh phụ.
4. Gọi `POST /api/admin/products` với `multipart/form-data`.
5. Backend lưu file ảnh vào `public/uploads/`, tạo bản ghi trong CSDL với `slug` tự động.
6. Thông báo *"Thêm thành công"*.

---

## 7. Yêu cầu phi chức năng (Non-Functional Requirements)

### 7.1. Hiệu năng (Performance)
- API phải phản hồi trong vòng **≤ 2 giây** với điều kiện mạng ổn định.
- Trang web cửa hàng phải tải xong trong **≤ 3 giây** trên kết nối 4G.
- Webhook SePay phải được xử lý trong **≤ 5 giây** để đảm bảo trải nghiệm thanh toán mượt mà.

### 7.2. Bảo mật (Security)
- Toàn bộ API yêu cầu xác thực phải được bảo vệ bởi Laravel Sanctum Bearer Token.
- Mật khẩu người dùng được hash bằng `bcrypt` (Laravel Hash facade), không lưu dạng plaintext.
- Token đặt lại mật khẩu có thời hạn 60 phút và bị vô hiệu hóa sau khi sử dụng.
- Validate chặt chẽ đầu vào: định dạng email, số điện thoại, độ dài trường dữ liệu.
- Admin routes được phân tách rõ ràng qua prefix `/api/admin` và middleware `auth:sanctum`.

### 7.3. Tính khả dụng (Availability)
- Hệ thống vận hành 24/7 (trong môi trường production với hosting thực).
- Webhook SePay cần server với IP công khai hoặc Ngrok tunnel trong môi trường phát triển.

### 7.4. Tính bảo trì (Maintainability)
- Backend tuân thủ kiến trúc MVC của Laravel, mỗi Controller xử lý một nhóm chức năng riêng biệt.
- CSDL được quản lý qua Laravel Migrations, dễ dàng rollback và cập nhật schema.
- Lỗi hệ thống được ghi log tại `storage/logs/laravel.log`.

### 7.5. Tính tương thích (Compatibility)
- **Web:** Tương thích với trình duyệt Chrome, Firefox, Edge phiên bản mới nhất.
- **Mobile App:** Tương thích với Android 7.0 (Nougat) trở lên.
- **Responsive:** Giao diện web thích ứng với kích thước màn hình Desktop, Tablet và Mobile.

### 7.6. Usability (Tính dễ dùng)
- Guest Checkout: Người dùng hoàn tất đặt hàng với **không quá 3 bước** mà không cần đăng ký.
- Thông báo lỗi validation phải rõ ràng, bằng tiếng Việt.
- Email xác nhận đơn hàng phải được gửi trong vòng **30 giây** sau khi đặt hàng thành công.

---

## 8. Mô hình cơ sở dữ liệu

### 8.1. Sơ đồ quan hệ thực thể (ERD)

```
users (1) ─────────── (N) orders
users (1) ─────────── (N) user_addresses
orders (1) ──────────── (N) order_items
order_items (N) ──────── (1) products
products (N) ────────── (1) categories
users (1) ─────────── (N) contacts (nullable)
users (1) ─────────── (N) personal_access_tokens
```

### 8.2. Mô tả chi tiết các bảng

#### Bảng `users`
| Cột | Kiểu | Ràng buộc | Mô tả |
|---|---|---|---|
| `id` | bigint | PK, Auto | Khóa chính |
| `username` | varchar(255) | UNIQUE, NOT NULL | Tên đăng nhập |
| `name` | varchar(255) | NOT NULL | Họ và tên |
| `email` | varchar(255) | UNIQUE, NOT NULL | Email @gmail.com |
| `password` | varchar(255) | NOT NULL | Mật khẩu (bcrypt) |
| `phone` | varchar(20) | nullable | Số điện thoại |
| `image` | varchar(255) | nullable | Đường dẫn ảnh đại diện |
| `role` | enum('user','admin') | DEFAULT 'user' | Vai trò |
| `cart` | json | nullable | Giỏ hàng đồng bộ (JSON) |
| `created_at` | timestamp | | Ngày tạo |
| `updated_at` | timestamp | | Ngày cập nhật |

#### Bảng `categories`
| Cột | Kiểu | Ràng buộc | Mô tả |
|---|---|---|---|
| `id` | bigint | PK | Khóa chính |
| `name` | varchar(255) | NOT NULL | Tên danh mục |
| `created_at` | timestamp | | Ngày tạo |

#### Bảng `products`
| Cột | Kiểu | Ràng buộc | Mô tả |
|---|---|---|---|
| `id` | bigint | PK | Khóa chính |
| `name` | varchar(255) | NOT NULL | Tên sản phẩm |
| `slug` | varchar(255) | UNIQUE | Đường dẫn thân thiện SEO |
| `category_id` | bigint | FK → categories | Danh mục |
| `price` | decimal(10,2) | NOT NULL | Giá bán (VNĐ) |
| `description` | text | nullable | Mô tả ngắn |
| `content` | longtext | nullable | Nội dung chi tiết |
| `image` | varchar(255) | nullable | Ảnh chính |
| `sub_images` | json | nullable | Mảng 4 ảnh phụ |
| `is_active` | boolean | DEFAULT true | Đang kinh doanh |
| `is_featured` | boolean | DEFAULT false | Sản phẩm nổi bật |
| `created_at` | timestamp | | Ngày tạo |

#### Bảng `orders`
| Cột | Kiểu | Ràng buộc | Mô tả |
|---|---|---|---|
| `id` | bigint | PK | Khóa chính |
| `user_id` | bigint | nullable, FK → users | Null nếu là Guest |
| `customer_name` | varchar(255) | NOT NULL | Tên khách |
| `customer_phone` | varchar(20) | NOT NULL | SĐT khách |
| `customer_address` | varchar(500) | NOT NULL | Địa chỉ giao hàng |
| `total_amount` | decimal(12,2) | NOT NULL | Tổng tiền |
| `payment_method` | enum('cod','bank') | DEFAULT 'cod' | Phương thức thanh toán |
| `payment_status` | enum('unpaid','paid') | DEFAULT 'unpaid' | Trạng thái thanh toán |
| `status` | enum('pending','confirmed','processing','shipped','completed','delivered','cancelled') | DEFAULT 'pending' | Trạng thái đơn hàng |
| `created_at` | timestamp | | Ngày đặt hàng |

#### Bảng `order_items`
| Cột | Kiểu | Ràng buộc | Mô tả |
|---|---|---|---|
| `id` | bigint | PK | Khóa chính |
| `order_id` | bigint | FK → orders | Đơn hàng |
| `product_id` | bigint | FK → products | Sản phẩm |
| `product_name` | varchar(255) | NOT NULL | Tên sản phẩm (lưu tại thời điểm mua) |
| `price` | decimal(10,2) | NOT NULL | Giá tại thời điểm mua |
| `quantity` | int | NOT NULL | Số lượng |

#### Bảng `user_addresses`
| Cột | Kiểu | Ràng buộc | Mô tả |
|---|---|---|---|
| `id` | bigint | PK | Khóa chính |
| `user_id` | bigint | FK → users | Chủ sở hữu địa chỉ |
| `alias` | varchar(255) | NOT NULL | Nhãn địa chỉ (Nhà riêng, Văn phòng...) |
| `receiver_name` | varchar(255) | NOT NULL | Tên người nhận |
| `receiver_phone` | varchar(20) | NOT NULL | SĐT người nhận |
| `receiver_email` | varchar(255) | NOT NULL | Email người nhận |
| `province` | varchar(100) | NOT NULL | Tỉnh/Thành phố |
| `district` | varchar(100) | NOT NULL | Quận/Huyện |
| `ward` | varchar(100) | NOT NULL | Phường/Xã |
| `detail_address` | varchar(500) | NOT NULL | Số nhà, đường... |
| `is_default` | boolean | DEFAULT false | Địa chỉ mặc định |

#### Bảng `contacts`
| Cột | Kiểu | Mô tả |
|---|---|---|
| `id` | bigint | Khóa chính |
| `user_id` | bigint (nullable) | Người gửi (nếu đăng nhập) |
| `fullname` | varchar(255) | Họ tên |
| `email` | varchar(255) | Email |
| `phone` | varchar(20) | Số điện thoại |
| `subject` | varchar(255) | Tiêu đề |
| `message` | text | Nội dung |
| `is_read` | boolean | Đã đọc |

---

## 9. Đặc tả API

### 9.1. Quy ước chung
- **Base URL (Dev):** `http://localhost/Web_banhang/backend/public/api`
- **Content-Type:** `application/json` (trừ upload file dùng `multipart/form-data`)
- **Authentication:** `Authorization: Bearer {token}` (cho các route bảo mật)
- **Định dạng lỗi:**
```json
{
  "message": "Thông báo lỗi",
  "errors": { "field": ["Chi tiết lỗi"] }
}
```

### 9.2. Danh sách API Endpoints

#### Nhóm Xác thực (Public)

| Method | Endpoint | Mô tả | Auth |
|---|---|---|---|
| POST | `/api/login` | Đăng nhập, nhận Bearer Token | ✗ |
| POST | `/api/register` | Đăng ký tài khoản mới | ✗ |
| POST | `/api/forgot-password` | Gửi email quên mật khẩu | ✗ |
| POST | `/api/reset-password` | Đặt lại mật khẩu với token | ✗ |

#### Nhóm Cửa hàng (Public)

| Method | Endpoint | Mô tả | Auth |
|---|---|---|---|
| GET | `/api/categories` | Lấy danh sách danh mục | ✗ |
| GET | `/api/products` | Lấy danh sách sản phẩm (lọc: `category_id`, `featured`) | ✗ |
| GET | `/api/products/{slug}` | Lấy chi tiết sản phẩm và sản phẩm liên quan | ✗ |
| POST | `/api/orders` | Đặt hàng (Guest hoặc Member) | ✗ |
| GET | `/api/orders/{id}` | Polling trạng thái thanh toán | ✗ |
| POST | `/api/contacts` | Gửi liên hệ | ✗ |
| POST | `/api/sepay/webhook` | Nhận callback từ SePay | ✗ |

#### Nhóm Người dùng đã đăng nhập

| Method | Endpoint | Mô tả | Auth |
|---|---|---|---|
| POST | `/api/logout` | Đăng xuất (xóa token) | ✓ |
| GET | `/api/me` | Lấy thông tin người dùng hiện tại | ✓ |
| POST | `/api/profile` | Cập nhật thông tin cá nhân + avatar | ✓ |
| GET | `/api/cart` | Lấy giỏ hàng đã lưu trên server | ✓ |
| POST | `/api/cart` | Đồng bộ / cập nhật giỏ hàng | ✓ |
| GET | `/api/orders` | Xem lịch sử đơn hàng | ✓ |
| GET | `/api/addresses` | Lấy danh sách địa chỉ | ✓ |
| POST | `/api/addresses` | Thêm địa chỉ mới | ✓ |
| PUT | `/api/addresses/{id}` | Cập nhật địa chỉ | ✓ |
| DELETE | `/api/addresses/{id}` | Xóa địa chỉ | ✓ |
| POST | `/api/addresses/{id}/default` | Đặt địa chỉ mặc định | ✓ |

#### Nhóm Quản trị viên (Admin)

| Method | Endpoint | Mô tả | Auth |
|---|---|---|---|
| GET | `/api/admin/dashboard` | Số liệu tổng quan Dashboard | ✓ (Admin) |
| GET | `/api/admin/dashboard/revenue-report` | Báo cáo doanh thu (day/week/month) | ✓ (Admin) |
| GET | `/api/admin/products` | Danh sách sản phẩm (admin view) | ✓ (Admin) |
| POST | `/api/admin/products` | Thêm sản phẩm mới | ✓ (Admin) |
| PUT | `/api/admin/products/{id}` | Cập nhật sản phẩm | ✓ (Admin) |
| DELETE | `/api/admin/products/{id}` | Xóa sản phẩm | ✓ (Admin) |
| GET | `/api/admin/categories` | Danh sách danh mục | ✓ (Admin) |
| POST | `/api/admin/categories` | Thêm danh mục | ✓ (Admin) |
| PUT | `/api/admin/categories/{id}` | Sửa danh mục | ✓ (Admin) |
| DELETE | `/api/admin/categories/{id}` | Xóa danh mục | ✓ (Admin) |
| GET | `/api/admin/orders` | Danh sách đơn hàng | ✓ (Admin) |
| PUT | `/api/admin/orders/{id}` | Cập nhật trạng thái đơn hàng | ✓ (Admin) |
| DELETE | `/api/admin/orders/{id}` | Xóa đơn hàng | ✓ (Admin) |
| GET | `/api/admin/users` | Danh sách người dùng | ✓ (Admin) |
| PUT | `/api/admin/users/{id}/role` | Cập nhật vai trò | ✓ (Admin) |
| DELETE | `/api/admin/users/{id}` | Xóa tài khoản | ✓ (Admin) |
| GET | `/api/admin/contacts` | Danh sách liên hệ | ✓ (Admin) |
| PUT | `/api/admin/contacts/{id}` | Đánh dấu đã đọc | ✓ (Admin) |
| DELETE | `/api/admin/contacts/{id}` | Xóa liên hệ | ✓ (Admin) |

---

## 10. Ràng buộc và giả định

### 10.1. Ràng buộc nghiệp vụ
1. **Email:** Chỉ chấp nhận định dạng `@gmail.com` trong toàn bộ hệ thống (đăng ký, đặt hàng, liên hệ...).
2. **Số điện thoại:** Phải đúng 10 chữ số và bắt đầu bằng số `0`.
3. **Mật khẩu:** Tối thiểu 6 ký tự, yêu cầu xác nhận mật khẩu.
4. **Mã đơn hàng trong nội dung QR:** Định dạng `LPS{id}` (ví dụ: `LPS37`), dùng để SePay webhook xác định đơn hàng cần cập nhật.
5. **Giỏ hàng Guest:** Lưu trên LocalStorage của trình duyệt, không đồng bộ server.
6. **Lịch sử đơn hàng Guest:** Member có thể xem đơn hàng Guest nếu số điện thoại trùng khớp với SĐT đăng ký tài khoản.
7. **Sản phẩm bị xóa:** Tên sản phẩm được lưu tại thời điểm đặt hàng trong `order_items.product_name` để đảm bảo tính toàn vẹn lịch sử.

### 10.2. Giả định
1. Hệ thống được triển khai trên máy chủ chạy Apache/XAMPP với PHP 8.x và MySQL 8.x.
2. Dịch vụ email SMTP đã được cấu hình trong file `.env` (biến `MAIL_*`).
3. Trong môi trường phát triển, Ngrok được dùng để expose localhost cho webhook SePay.
4. Tài khoản Admin được tạo thủ công (seeded) trong CSDL với `role = 'admin'`.
5. Ứng dụng di động (`com.lapatisserie.bakery`) được build và cài trực tiếp trên thiết bị Android.

---

*Tài liệu SRS này được tự động tổng hợp từ mã nguồn dự án La Pâtisserie. Mọi thay đổi trong quá trình phát triển cần được cập nhật đồng bộ vào tài liệu này.*
