# Hướng Dẫn Cài Đặt và Chạy Dự Án Web Xem Phim Trực Tuyến

Chào mừng bạn đến với dự án **Web Xem Phim Trực Tuyến**! Dưới đây là hướng dẫn chi tiết từng bước để thiết lập và chạy dự án này trên môi trường local (máy tính cá nhân) của bạn.

---

## 1. Tổng Quan Kiến Trúc
Dự án được phát triển dựa trên các công nghệ:
- **Backend/Framework:** Laravel 10 (PHP ^8.1)
- **Frontend Assets:** Blade Templates, CSS Vanilla, JavaScript, được build thông qua **Vite**
- **Cơ sơ dữ liệu:** MySQL (sử dụng file dump SQL có sẵn để phục hồi dữ liệu mẫu như phim Doraemon, Conan...)

---

## 2. Yêu Cầu Hệ Thống (Prerequisites)
Trước khi cài đặt, hãy đảm bảo máy tính của bạn đã được cài đặt đầy đủ các công cụ sau:
- **PHP:** Phiên bản `>= 8.1` (Khuyên dùng PHP 8.2)
- **Composer:** Công cụ quản lý thư viện PHP.
- **Node.js & NPM:** Phiên bản Node `>= 18.0` (Khuyên dùng bản LTS mới nhất).
- **Cơ sở dữ liệu:** MySQL Server (thông qua XAMPP, Laragon, Docker hoặc cài trực tiếp).
- **Git** (để quản lý mã nguồn, nếu cần).

---

## 3. Hướng Dẫn Chạy Từng Bước (Step-by-Step)

### Bước 1: Chuẩn bị mã nguồn và file cấu hình môi trường
1. Sao chép file `.env.example` thành `.env` ở thư mục gốc của dự án:
   ```bash
   cp .env.example .env
   ```
2. Mở file `.env` vừa tạo và cấu hình các thông số kết nối cơ sở dữ liệu phù hợp với máy của bạn (Xem chi tiết ở mục **4. Cấu hình** bên dưới).

---

### Bước 2: Cài đặt các thư viện PHP
Chạy lệnh sau tại thư mục gốc để tải và cài đặt các package của Laravel:
```bash
composer install
```
*Kết quả mong đợi:* Thư mục `vendor/` được tạo ra chứa toàn bộ thư viện cần thiết và không gặp lỗi cú pháp.

---

### Bước 3: Tạo Khóa Ứng Dụng (App Key)
Laravel yêu cầu một khóa mã hóa để bảo mật session và dữ liệu:
```bash
php artisan key:generate
```
*Kết quả mong đợi:* Khóa ứng dụng dạng `base64:...` được tự động ghi vào dòng `APP_KEY` trong file `.env`.

---

### Bước 4: Cấu hình và Import Cơ sở dữ liệu (Database)
1. **Tạo Database:** Mở công cụ quản lý cơ sở dữ liệu của bạn (ví dụ: phpMyAdmin, DBeaver, Laragon...) và tạo mới một Database trống có tên là: **`webxemphim`** (hoặc tên tùy chọn của bạn).
2. **Import dữ liệu mẫu:** Do dự án có sẵn các file dữ liệu SQL mẫu chứa phim và thể loại, bạn hãy sử dụng file **`webxemphim5.sql`** (bản hoàn thiện nhất) để import vào database vừa tạo.
   - **Cách 1: Sử dụng dòng lệnh (Terminal/Command Prompt):**
     ```bash
     mysql -u root -p webxemphim < webxemphim5.sql
     ```
     *(Nhập mật khẩu MySQL của bạn nếu được yêu cầu)*
   - **Cách 2: Sử dụng phpMyAdmin:**
     - Truy cập `http://localhost/phpmyadmin/`.
     - Nhấp chọn database `webxemphim` ở cột bên trái.
     - Chọn tab **Import** ở thanh menu phía trên.
     - Nhấp **Choose File** và chọn file `webxemphim5.sql` trong thư mục gốc dự án.
     - Nhấp nút **Import** (hoặc **Go**) ở cuối trang để hoàn tất.

---

### Bước 5: Cài đặt Frontend Assets và Build
Dự án sử dụng Vite để biên dịch tài nguyên frontend (CSS, JS).
1. Cài đặt các package Node.js:
   ```bash
   npm install
   ```
2. Build các tài nguyên tĩnh phục vụ cho môi trường local:
   - **Dành cho môi trường phát triển (chạy song song live-reload):**
     ```bash
     npm run dev
     ```
   - **Hoặc build phiên bản production hoàn thiện (Khuyên dùng nếu chỉ muốn chạy test trực quan):**
     ```bash
     npm run build
     ```

---

### Bước 6: Khởi chạy Server Laravel local
Chạy lệnh sau tại Terminal để khởi động server phát triển tích hợp sẵn của PHP:
```bash
php artisan serve
```
*Kết quả mong đợi:* Terminal sẽ hiển thị dòng thông báo:
`Server running on [http://127.0.0.1:8000]`

Bây giờ bạn có thể mở trình duyệt và truy cập: **[http://127.0.0.1:8000](http://127.0.0.1:8000)** để trải nghiệm website.

---

## 4. Cấu Hình Cơ Bản (.env)
Dưới đây là các biến cấu hình cần lưu ý trong file `.env`:

```env
# Cấu hình môi trường và URL ứng dụng
APP_NAME="Web Xem Phim"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Kết nối cơ sở dữ liệu MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306          # Thay đổi thành 3307 nếu bạn sử dụng port MySQL khác (ví dụ: như Laragon mặc định hoặc cấu hình riêng)
DB_DATABASE=webxemphim
DB_USERNAME=root      # Username đăng nhập MySQL của bạn
DB_PASSWORD=          # Mật khẩu đăng nhập MySQL của bạn (để trống nếu không có mật khẩu)
```

---

## 5. Kịch Bản Kiểm Thử (Test Cases)
Để xác nhận hệ thống chạy ổn định, hãy kiểm tra qua các trường hợp sau:

1. **Kiểm tra Trang chủ:**
   - Truy cập `http://127.0.0.1:8000`.
   - **Kết quả mong đợi:** Trang chủ hiển thị giao diện danh sách phim trực quan, các banner và nhãn phim nổi bật (như Doraemon, Conan...).
2. **Kiểm tra Tìm kiếm & Lọc phim:**
   - Nhấp vào các danh mục phim "Phim Lẻ", "Phim Bộ", hoặc lọc theo "Thể loại" (Hành động, Hoạt hình, Tình cảm...).
   - **Kết quả mong đợi:** Danh sách phim được lọc chính xác theo tiêu chí đã chọn.
3. **Kiểm tra Xem Phim & Chi tiết Phim:**
   - Chọn phim "Doraemon: Nobita và bản giao hương Địa Cầu".
   - **Kết quả mong đợi:** Hiển thị trang chi tiết phim gồm mô tả, năm phát hành, trailer phát mượt mà, và danh sách các tập phim (đối với phim bộ).
4. **Kiểm tra Bình luận (Yêu cầu Đăng nhập):**
   - Đăng ký một tài khoản mới hoặc đăng nhập với tài khoản có sẵn trong database (Ví dụ: `ss@gmail.com`).
   - Vào mục xem phim và viết bình luận dưới phim.
   - **Kết quả mong đợi:** Bình luận hiển thị ngay dưới khu vực thảo luận của bộ phim.
