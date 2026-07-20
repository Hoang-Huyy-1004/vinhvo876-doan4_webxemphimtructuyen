# Hướng Dẫn Deploy Web Xem Phim Laravel Lên Render (Miễn Phí)

Tài liệu này hướng dẫn bạn cách deploy ứng dụng Laravel của bạn lên **Render.com** hoàn toàn miễn phí. 

Vì dự án của bạn là một ứng dụng Laravel sử dụng cơ sở dữ liệu **MySQL**, chúng ta sẽ kết hợp **Render** (để chạy mã nguồn PHP) và **Aiven.io** (để tạo cơ sở dữ liệu MySQL miễn phí trực tuyến).

---

## Tổng quan các bước thực hiện
1. **Bước 1:** Đưa mã nguồn của bạn lên GitHub (Render sẽ lấy code từ GitHub để deploy).
2. **Bước 2:** Tạo một cơ sở dữ liệu MySQL miễn phí trên Aiven.io và import dữ liệu từ file `webxemphim5.sql`.
3. **Bước 3:** Tạo một Web Service trên Render.com, liên kết với repository GitHub của bạn.
4. **Bước 4:** Cấu hình các biến môi trường (`.env`) và thiết lập Document Root trên Render.

---

## Bước 1: Đưa mã nguồn lên GitHub
Nếu bạn chưa đưa code lên GitHub:
1. Đăng nhập vào [GitHub](https://github.com/) và tạo một repository mới (ví dụ: `webxemphim`).
2. Tại thư mục dự án của bạn ở máy local, chạy các lệnh sau để đẩy code lên GitHub:
   ```bash
   git init
   git add .
   git commit -m "feat: Chuẩn bị mã nguồn để deploy lên Render"
   git branch -M main
   git remote add origin https://github.com/username_cua_ban/webxemphim.git
   git push -u origin main
   ```

---

## Bước 2: Tạo Cơ sở dữ liệu MySQL miễn phí trên Aiven.io

Render không cung cấp gói MySQL miễn phí (chỉ có PostgreSQL). Vì vậy, chúng ta sẽ sử dụng dịch vụ **Aiven.io** để tạo MySQL miễn phí:

1. Truy cập [Aiven.io](https://aiven.io/) và đăng ký một tài khoản miễn phí.
2. Sau khi đăng nhập, nhấn **Create service**.
3. Chọn **MySQL** làm cơ sở dữ liệu của bạn.
4. Ở phần **Service plan**, chọn gói **Free** (Gói miễn phí này cung cấp 1 vCPU, 1 GB RAM và 5 GB bộ nhớ, hoàn toàn đủ cho nhu cầu chạy thử nghiệm).
5. Nhấn **Create service** ở cuối trang và đợi vài phút để cơ sở dữ liệu được khởi tạo.
6. Khi trạng thái chuyển sang **Running**, bạn sẽ thấy thông tin kết nối (Connection parameters):
   - **Host** (ví dụ: `mysql-xxxx.aivencloud.com`)
   - **Port** (ví dụ: `12345`)
   - **User** (ví dụ: `avnadmin`)
   - **Password** (nhấp vào biểu tượng mắt để xem mật khẩu)
   - **Database name** (mặc định là `defaultdb`)

### Import dữ liệu mẫu lên Aiven MySQL:
Bạn có thể dùng công cụ quản lý database tại local (như DBeaver, Navicat hoặc phpMyAdmin) kết nối tới Aiven MySQL bằng thông tin trên, sau đó chạy import file `webxemphim5.sql`.
Hoặc chạy lệnh sau trong Terminal tại máy tính của bạn:
```bash
mysql -h HOST_AIVEN -P PORT_AIVEN -u avnadmin -p defaultdb < webxemphim5.sql
```
*(Thay thế HOST_AIVEN và PORT_AIVEN bằng thông số thực tế của bạn)*.

---

## Bước 3: Tạo Web Service trên Render.com

1. Truy cập [Render.com](https://render.com/) và đăng nhập bằng tài khoản GitHub của bạn.
2. Tại trang Dashboard của Render, nhấn **New +** và chọn **Web Service**.
3. Chọn **Connect a repository** và chọn repository GitHub chứa dự án của bạn mà bạn đã đẩy lên ở Bước 1.
4. Cấu hình các thông số cơ bản cho Web Service:
   - **Name:** `web-xem-phim-laravel` (tùy chọn)
   - **Region:** Chọn khu vực gần Việt Nam nhất (ví dụ: `Singapore` hoặc `Oregon`).
   - **Branch:** `main`
   - **Runtime:** `PHP`
   - **Instance Type:** Chọn **Free** (Miễn phí).

---

## Bước 4: Thiết lập Cấu hình Build & Start và Biến môi trường

Trên giao diện Render, hãy cuộn xuống phần cấu hình lệnh:

### 1. Lệnh Build và Start
* **Build Command:**
  ```bash
  composer install --no-dev --optimize-autoloader && npm install && npm run build
  ```
* **Start Command:**
  Render sử dụng Apache hoặc Nginx làm web server cho runtime PHP. Để chạy Laravel, chúng ta cần sử dụng cấu hình mặc định của Render nhưng cần thay đổi thư mục root. Hãy nhập:
  ```bash
  # Để trống start command hoặc giữ nguyên mặc định của Render.
  ```

### 2. Cấu hình biến môi trường (Environment Variables)
Nhấp vào nút **Advanced** -> chọn **Add Environment Variable** để thêm các biến sau:

| Key | Value | Ghi chú |
| :--- | :--- | :--- |
| `APP_KEY` | `base64:xxxxxxxxxxxxxxxx` | Chạy lệnh `php artisan key:generate` ở local rồi copy giá trị từ file `.env` local của bạn sang. |
| `APP_ENV` | `production` | Thiết lập môi trường sản phẩm |
| `APP_DEBUG` | `false` | Tắt chế độ gỡ lỗi để bảo mật thông tin |
| `APP_URL` | `https://ten-app-cua-ban.onrender.com` | URL Render cấp cho bạn sau khi tạo Web Service |
| `DOCUMENT_ROOT` | `public` | **RẤT QUAN TRỌNG:** Render dùng biến này để trỏ thư mục gốc của trang web vào thư mục `public` của Laravel. |
| `DB_CONNECTION` | `mysql` | Loại cơ sở dữ liệu sử dụng |
| `DB_HOST` | *Host từ Aiven* | Địa chỉ host của Aiven MySQL |
| `DB_PORT` | *Port từ Aiven* | Cổng kết nối của Aiven |
| `DB_DATABASE` | `defaultdb` | Tên database của Aiven |
| `DB_USERNAME` | `avnadmin` | Username của Aiven |
| `DB_PASSWORD` | *Mật khẩu từ Aiven* | Mật khẩu cơ sở dữ liệu Aiven |

Sau khi điền đầy đủ các thông tin trên, nhấn **Create Web Service**.

---

## Bước 5: Kiểm tra quá trình deploy
1. Render sẽ bắt đầu clone code của bạn, tải các package PHP qua Composer, cài đặt Node.js và biên dịch file CSS/JS bằng Vite (`npm run build`).
2. Quá trình build có thể mất khoảng 3–5 phút. Khi màn hình Console hiện dòng chữ `Your service is live`, bạn có thể nhấp vào link URL dạng `https://xxx.onrender.com` hiển thị ở góc trên bên trái để truy cập trang web của mình.

---

## ⚠️ Một số hạn chế của gói Render Miễn Phí cần lưu ý:
1. **Chế độ ngủ (Cold Start):** Nếu không có ai truy cập web trong vòng 15 phút, Render sẽ tạm thời tắt máy chủ để tiết kiệm tài nguyên. Lần truy cập tiếp theo sẽ mất khoảng 30–50 giây để máy chủ khởi động lại.
2. **Không lưu trữ file vĩnh viễn (Ephemeral Disk):** Mọi tệp tin upload lên thư mục của server (như ảnh đại diện, banner tải lên từ trang admin) sẽ bị xóa sạch khi máy chủ restart hoặc deploy phiên bản mới. Nếu muốn lưu trữ ảnh vĩnh viễn, bạn cần kết nối Laravel với các dịch vụ lưu trữ đám mây như **Cloudinary** hoặc **AWS S3**.
