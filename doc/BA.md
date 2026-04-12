# Project: Web Bán Hàng (Bakery Store) - Business Analysis (BA)

Tài liệu này mô tả 8 quy trình nghiệp vụ "To-be" chính của hệ thống Web Bán Hàng.

---

## 1. Tổng quan hệ thống
Hệ thống là một nền tảng thương mại điện tử chuyên cung cấp các loại bánh. Hệ thống hỗ trợ đầy đủ luồng từ quản lý hàng hóa đến giao dịch khách hàng.

---

## 2. Các Quy trình To-be Chi tiết

### Quy trình 2.1: Đăng ký (Registration)
*Mục tiêu: Cho phép người dùng mới tạo tài khoản để mua hàng.*
1.  Người dùng truy cập trang Đăng ký.
2.  Nhập thông tin: Họ tên, Email, Số điện thoại và Mật khẩu.
3.  Hệ thống kiểm tra tính hợp lệ của dữ liệu (Email không được trùng, Mật khẩu đủ độ dài).
4.  Hệ thống lưu thông tin và thông báo đăng ký thành công.

### Quy trình 2.2: Đăng nhập (Login)
*Mục tiêu: Xác thực người dùng để truy cập các tính năng cá nhân.*
1.  Người dùng nhập Email và Mật khẩu.
2.  Hệ thống xác thực thông tin qua Sanctum (Token-based).
3.  Nếu đúng: Người dùng được chuyển hướng về trang chủ hoặc trang cá nhân.
4.  Nếu sai: Hiển thị thông báo lỗi.

### Quy trình 2.3: Quản lý sản phẩm (Product Management - Admin)
*Mục tiêu: Admin duy trì thông tin hàng hóa trong hệ thống.*
1.  **Thêm mới**: Nhập tên, mô tả, giá, chọn danh mục và tải lên hình ảnh.
2.  **Cập nhật**: Sửa đổi thông tin sản phẩm hiện có (giá mới, cập nhật mô tả).
3.  **Xóa**: Gỡ bỏ các sản phẩm không còn kinh doanh khỏi hệ thống.

### Quy trình 2.4: Quản lý danh mục (Category Management - Admin)
*Mục tiêu: Phân loại sản phẩm khoa học.*
1.  Admin tạo các danh mục lớn (Bánh kem, Bánh mì, Bánh quy...).
2.  Sửa đổi hoặc xóa danh mục khi có sự thay đổi về định hướng sản phẩm.

### Quy trình 2.5: Tìm kiếm sản phẩm (Product Search)
*Mục tiêu: Giúp khách hàng tìm thấy sản phẩm nhanh nhất.*
1.  Khách hàng nhập từ khóa vào ô tìm kiếm.
2.  Hệ thống truy vấn dữ liệu dựa trên tên sản phẩm và mô tả.
3.  Hiển thị danh sách kết quả phù hợp với các thông tin tóm tắt và giá.

### Quy trình 2.6: Mua hàng (Purchase Process)
*Mục tiêu: Quy trình chọn lựa và tích lũy hàng hóa.*
1.  Khách hàng duyệt danh mục hoặc kết quả tìm kiếm.
2.  Click xem chi tiết sản phẩm.
3.  Chọn "Thêm vào giỏ hàng".
4.  Hệ thống lưu trữ giỏ hàng (trong LocalStorage hoặc Session).
5.  Khách hàng xem lại giỏ hàng, cập nhật số lượng hoặc xóa bớt sản phẩm.

### Quy trình 2.7: Thanh toán (Payment & Checkout)
*Mục tiêu: Hoàn tất giao dịch và tạo đơn hàng chính thức.*
1.  Từ giỏ hàng, khách hàng chọn "Thanh toán".
2.  Xác nhận/Nhập thông tin giao hàng (Địa chỉ, Số điện thoại).
3.  Hệ thống tính tổng tiền (Số lượng x Đơn giá).
4.  Người dùng xác nhận đặt hàng.
5.  Hệ thống tạo đơn hàng mới với mã vận đơn riêng và thông báo thành công.

### Quy trình 2.8: Quản lý đơn hàng (Order Management - Admin)
*Mục tiêu: Đảm bảo tiến độ thực hiện đơn hàng cho khách.*
1.  Admin xem danh sách toàn bộ đơn hàng trong hệ thống.
2.  **Cập nhật trạng thái**: Chuyển đổi trạng thái đơn hàng (Đang xử lý -> Đã giao -> Hoàn tất).
3.  **Hủy đơn**: Thực hiện hủy đơn hàng trong trường hợp khách yêu cầu hoặc hết hàng.

---

## 3. Bảng phân quyền (Actor Matrix)

| Quy trình | Khách vãng lai | Khách hàng | Quản trị viên (Admin) |
| :--- | :---: | :---: | :---: |
| Đăng ký | X | | |
| Đăng nhập | X | X | |
| Tìm kiếm sản phẩm | X | X | X |
| Mua hàng | | X | |
| Thanh toán | | X | |
| Quản lý sản phẩm | | | X |
| Quản lý danh mục | | | X |
| Quản lý đơn hàng | | | X |
