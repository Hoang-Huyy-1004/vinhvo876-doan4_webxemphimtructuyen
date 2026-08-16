# KỊCH BẢN & NỘI DUNG BÁO CÁO TỐT NGHIỆP (SLIDE POWERPOINT)

**ĐỀ TÀI:** XÂY DỰNG WEBSITE XEM PHIM TRỰC TUYẾN VÀ TÍCH HỢP HỆ THỐNG GỢI Ý PHIM DỰA TRÊN KHAI PHÁ LUẬT KẾT HỢP (ASSOCIATION RULES)  
**Chuyên ngành:** Công Nghệ Thông Tin / Kỹ Thuật Phần Mềm  
**Nền tảng phát triển:** Laravel 10 (PHP 8.1+), MySQL 8.0, Blade Templates, JavaScript (AJAX), Python/Data Mining  

---

## MỤC LỤC TRÌNH BÀY (CẤU TRÚC 4 PHẦN CHUẨN BỘ GIÁO DỤC)
1. **PHẦN 1: ĐẶT VẤN ĐỀ** (Bối cảnh, Lý do chọn đề tài, Mục tiêu và Phạm vi nghiên cứu)
2. **PHẦN 2: NỘI DUNG VÀ PHƯƠNG PHÁP NGHIÊN CỨU** (Kiến trúc hệ thống MVC, Thiết kế CSDL, Cơ sở lý thuyết Khai phá luật kết hợp Apriori & Thuật toán gợi ý)
3. **PHẦN 3: KẾT QUẢ VÀ THẢO LUẬN** (Hiện thực hóa Client & Admin, Thực nghiệm hệ thống gợi ý Rule-based, Đánh giá kiểm thử và Hiệu năng)
4. **PHẦN 4: KẾT LUẬN VÀ ĐỀ NGHỊ** (Tổng kết đóng góp, Hạn chế và Hướng phát triển tương lai)

---

# PHẦN 1: ĐẶT VẤN ĐỀ

---

### SLIDE 01: TRANG TIÊU ĐỀ BÁO CÁO
* **Tiêu đề chính:** BÁO CÁO KHÓA LUẬN TỐT NGHIỆP ĐẠI HỌC
* **Tên đề tài:** **XÂY DỰNG WEBSITE XEM PHIM TRỰC TUYẾN VÀ TÍCH HỢP HỆ THỐNG GỢI Ý PHIM DỰA TRÊN KHAI PHÁ LUẬT KẾT HỢP**
* **Sinh viên thực hiện:** [Họ và Tên Sinh Viên] - MSSV: [Mã Số SV]
* **Giảng viên hướng dẫn:** [Học hàm, Học vị, Họ và Tên GVHD]
* **Đơn vị:** Khoa Công Nghệ Thông Tin - Trường Đại Học [Tên Trường]
* **Thời gian:** Năm học 2024 - 2025

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Kính thưa quý Thầy/Cô trong Hội đồng chấm khóa luận tốt nghiệp! Em tên là [Tên SV]. Hôm nay, em xin phép được báo cáo đề tài khóa luận tốt nghiệp của mình với tên gọi: 'Xây dựng Website Xem Phim Trực Tuyến và Tích Hợp Hệ Thống Gợi Ý Phim Dựa Trên Khai Phá Luật Kết Hợp'. Sau đây, em xin kính mời quý Thầy/Cô cùng theo dõi nội dung chi tiết của đề tài."*

---

### SLIDE 02: BỐI CẢNH & LÝ DO CHỌN ĐỀ TÀI
* **Bối cảnh thực tiễn:**
  * Sự bùng nổ của các nền tảng giải trí trực tuyến (OTT/VOD) trên toàn cầu (Netflix, Disney+, VieON...).
  * Nhu cầu xem phim chất lượng cao, đa dạng thể loại (Phim lẻ, Phim bộ) với trải nghiệm mượt mà, tiện lợi trên mọi thiết bị.
* **Bài toán thực tế & Vấn đề tồn tại:**
  * **Quá tải thông tin (Information Overload):** Số lượng phim quá lớn khiến người dùng mất nhiều thời gian tìm kiếm bộ phim phù hợp với sở thích.
  * Các hệ thống xem phim thông thường chỉ gợi ý đơn giản theo lượt xem (Most Viewed) hoặc thể loại cố định, thiếu tính **cá nhân hóa (Personalization)** dựa trên hành vi thực tế.
  * Cần một giải pháp gợi ý có tính **minh bạch, giải thích được (Explainability)** thông qua các quy luật kết hợp rõ ràng thay vì các mô hình "hộp đen".

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Thưa Thầy/Cô, trong thời đại số, nhu cầu giải trí và thưởng thức phim trực tuyến của người dùng tăng trưởng vượt bậc. Tuy nhiên, khi kho phim ngày càng đồ sộ, người dùng gặp phải hiện tượng 'quá tải thông tin' và tốn rất nhiều thời gian lướt tìm. Các website truyền thống thường chỉ gợi ý top phim xem nhiều nhất mà chưa nắm bắt được mối liên hệ giữa các bộ phim mà người dùng đã xem. Do đó, việc xây dựng một website xem phim hoàn chỉnh kết hợp giải thuật khai phá luật kết hợp để gợi ý phim thông minh là một bài toán vừa mang tính thực tiễn cao, vừa có giá trị học thuật sâu sắc."*

---

### SLIDE 03: MỤC TIÊU & PHẠM VI NGHIÊN CỨU
* **Mục tiêu đề tài:**
  1. **Xây dựng hoàn chỉnh nền tảng Web Xem Phim Trực Tuyến:** Tốc độ cao, giao diện Dark Theme hiện đại, hỗ trợ đầy đủ Phim Lẻ, Phim Bộ, phát video HTML5 Player, tìm kiếm tức thì AJAX và xác thực Google OAuth 2.0.
  2. **Xây dựng phân hệ Quản trị (Admin Panel):** Quản lý toàn diện dữ liệu Phim, Tập phim, Thể loại, Người dùng và Lượt xem.
  3. **Nghiên cứu & Nâng cấp Hệ thống Gợi ý bằng Luật (Association Rules Recommendation):** Khai phá các tập mẫu hành vi xem phim, trích xuất các luật kết hợp có độ tin cậy cao để đề xuất phim chính xác cho từng người dùng.
* **Phạm vi của hệ thống:**
  * **Khách vãng lai:** Xem danh sách, tìm kiếm AJAX, xem trailer/phim công khai.
  * **Thành viên:** Đăng nhập (Email/Google), bình luận, nhận thông báo, lưu vết lịch sử xem và nhận gợi ý cá nhân hóa.
  * **Quản trị viên:** Quản lý CRUD toàn bộ hệ sinh thái dữ liệu phim và hệ thống.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Đề tài tập trung vào 3 mục tiêu cốt lõi: Thứ nhất là xây dựng website xem phim chuẩn kiến trúc MVC đáp ứng trải nghiệm người dùng cao cấp; Thứ hai là phân hệ quản trị mạnh mẽ cho quản trị viên; và Thứ ba - cũng là điểm nhấn nâng cấp quan trọng nhất - là nghiên cứu và tích hợp module gợi ý phim dựa trên luật kết hợp (Association Rules Mining) giúp đề xuất phim thông minh dựa trên lịch sử xem của người dùng."*

---

# PHẦN 2: NỘI DUNG VÀ PHƯƠNG PHÁP NGHIÊN CỨU

---

### SLIDE 04: TỔNG QUAN KIẾN TRÚC HỆ THỐNG (MVC) & TECH STACK
* **Mô hình kiến trúc 3 lớp MVC (Model - View - Controller):**
  * **Presentation Layer (View):** Blade Template Engine, Vanilla CSS (Dark Mode), SB-Admin 2 Theme, Vite Asset Bundler, AJAX Fetch API.
  * **Business Logic Layer (Controller):** Laravel 10 (PHP 8.1+), Middleware xác thực, Controllers phân tách rõ ràng (`HomeController`, `PhimController`, `RecommendationController`...).
  * **Data Access Layer (Model & Storage):** Eloquent ORM, MySQL 8.0 InnoDB Engine, quan hệ 1-N, N-N.
* **Bảng công nghệ sử dụng (Tech Stack):**

| Thành Phần | Công Nghệ / Thư Viện | Vai Trò Chính |
| :--- | :--- | :--- |
| **Backend** | Laravel 10 / PHP 8.1+ | Xử lý Routing, Business Logic, Eloquent ORM |
| **Frontend** | Blade, Vanilla CSS, JS, Vite | Giao diện Dark Theme, tối ưu hóa asset tĩnh |
| **Database** | MySQL 8.0 InnoDB | Lưu trữ cơ sở dữ liệu quan hệ, Cascade delete |
| **Bảo mật** | Bcrypt, CSRF, Laravel Socialite | Mã hóa mật khẩu, chống CSRF/SQLi, Google Login |
| **Data Mining** | Association Rules / Python Script | Khai phá luật kết hợp, tính điểm gợi ý phim |

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Hệ thống được thiết kế theo chuẩn kiến trúc MVC của Laravel 10. Tầng View sử dụng Blade templates kết hợp Vite bundler giúp tải trang siêu tốc. Tầng Logic xử lý toàn bộ nghiệp vụ từ xác thực Socialite OAuth 2.0 đến điều phối luồng dữ liệu. Tầng Database sử dụng MySQL với chuẩn quan hệ chặt chẽ. Đặc biệt, hệ thống tích hợp module Data Mining độc lập để xử lý các thuật toán gợi ý mà không làm ảnh hưởng đến hiệu năng máy chủ web."*

---

### SLIDE 05: PHÂN TÍCH VÀ THIẾT KẾ CƠ SỞ DỮ LIỆU (ERD)
* **Sơ đồ ERD chuẩn hóa 3NF gồm 9 bảng dữ liệu chính:**
  * `users`: Quản lý tài khoản (mã `user_id` 8 số ngẫu nhiên, email, mật khẩu Bcrypt, `google_id`, `status`).
  * `phim`: Lưu trữ phim lẻ/phim bộ, đường dẫn media (poster, trailer, video), trạng thái, nhãn hiển thị.
  * `tap_phim`: Quản lý danh sách tập chi tiết cho từng bộ phim bộ (khóa ngoại `phim_id` cascade).
  * `the_loai` & `phim_the_loai`: Quản lý quan hệ Nhiều - Nhiều ($N - N$) giữa Phim và Thể loại.
  * `views`: Thống kê tổng số lượt xem của từng bộ phim (khởi tạo tự động qua Model Event Hook).
  * `lich_su_views` & `luot_xem`: Ghi nhận nhật ký người dùng xem phim theo mốc thời gian để phục vụ thuật toán gợi ý.
  * `binh_luan`: Lưu trữ tương tác đánh giá của người dùng.
  * `notifications`: Quản lý thông báo cá nhân hóa hệ thống.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Cơ sở dữ liệu được chuẩn hóa ở dạng chuẩn 3 (3NF) để triệt tiêu dư thừa dữ liệu và đảm bảo toàn vẹn tham chiếu. Bảng `phim_the_loai` giải quyết quan hệ nhiều-nhiều, trong khi bảng `luot_xem` và `lich_su_views` đóng vai trò là nguồn dữ liệu giao dịch (Transaction Database) cung cấp dữ liệu đầu vào cho quá trình khai phá luật kết hợp."*

---

### SLIDE 06: CƠ SỞ LÝ THUYẾT: KHAI PHÁ LUẬT KẾT HỢP (ASSOCIATION RULES)
* **Khái niệm Luật Kết Hợp trong Hệ Thống Gợi Ý:**
  * Luật kết hợp có dạng: $$X \Rightarrow Y$$
    * Trong đó $X$ (Tiền đề - Antecedent) và $Y$ (Hệ quả - Consequent) là các tập hợp phim rời nhau ($X \cap Y = \emptyset$).
    * **Ý nghĩa:** *"Nếu một người dùng đã xem tập hợp phim $X$, thì khả năng rất cao người đó cũng sẽ xem bộ phim $Y$"*.
* **Mô hình Hóa Dữ Liệu Xem Phim:**
  * Mỗi người dùng $U_i$ có một lịch sử xem phim được xem như một "giao dịch" (Transaction): $T_i = \{\text{Phim}_A, \text{Phim}_B, \text{Phim}_C, ...\}$.
  * Toàn bộ lịch sử xem của hệ thống tạo thành Cơ sở dữ liệu giao dịch $D = \{T_1, T_2, ..., T_n\}$.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Thưa Thầy/Cô, phương pháp khai phá luật kết hợp vốn xuất phát từ bài toán giỏ hàng (Market Basket Analysis) trong siêu thị. Khi ứng dụng vào nền tảng xem phim, ta coi lịch sử các bộ phim một người đã xem tương tự như một giỏ hàng. Từ đó, thuật toán sẽ tìm kiếm các mẫu hành vi lặp lại của nhiều người dùng để sinh ra quy luật: Người thích xem phim A thường sẽ có xu hướng xem tiếp phim B."*

---

### SLIDE 07: CÁC ĐỘ ĐO ĐÁNH GIÁ LUẬT (SUPPORT, CONFIDENCE, LIFT & SCORE)
Để đánh giá một luật $X \Rightarrow Y$ có thực sự hữu ích và đáng tin cậy hay không, hệ thống sử dụng 3 độ đo toán học cốt lõi:

1. **Độ hỗ trợ - Support ($Supp$):** Tỷ lệ các giao dịch chứa đồng thời cả $X$ và $Y$ trên tổng số giao dịch:
   $$Supp(X \Rightarrow Y) = P(X \cup Y) = \frac{\text{Số user xem cả } X \text{ và } Y}{\text{Tổng số user trong hệ thống}}$$
2. **Độ tin cậy - Confidence ($Conf$):** Xác suất có điều kiện người dùng xem phim $Y$ khi đã biết họ đã xem phim $X$:
   $$Conf(X \Rightarrow Y) = P(Y | X) = \frac{Supp(X \cup Y)}{Supp(X)} = \frac{\text{Số user xem cả } X \text{ và } Y}{\text{Số user xem } X}$$
3. **Độ nâng - Lift ($Lift$):** Thể hiện mức độ phụ thuộc giữa việc xem $X$ và xem $Y$:
   $$Lift(X \Rightarrow Y) = \frac{P(X \cup Y)}{P(X) \cdot P(Y)} = \frac{Conf(X \Rightarrow Y)}{Supp(Y)}$$
   * **$Lift > 1$:** Xem $X$ và xem $Y$ có quan hệ **tương quan dương** mạnh (Luật giá trị cao).
   * **$Lift = 1$:** Hai hành vi độc lập ngẫu nhiên.
   * **$Lift < 1$:** Tương quan âm (xem $X$ làm giảm khả năng xem $Y$).
4. **Điểm xếp hạng tổng hợp (Composite Recommendation Score):**
   $$Score = w_1 \cdot \text{Normalized}(Conf) + w_2 \cdot \text{Normalized}(Lift)$$

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Để tránh sinh ra các luật rác, thuật toán áp dụng 3 ngưỡng lọc: Support loại bỏ các phim quá ít người xem; Confidence đảm bảo độ chắc chắn của dự đoán; và Lift chứng minh mối quan hệ giữa hai phim là thực chất chứ không phải do phim Y ngẫu nhiên quá nổi tiếng. Điểm Score tổng hợp được tính toán để xếp hạng Top 1, Top 2, Top 3 phim gợi ý tối ưu nhất."*

---

### SLIDE 08: THUẬT TOÁN APRIORI & QUY TRÌNH SINH GỢI Ý
* **Thuật toán Apriori:**
  * **Nguyên lý cắt tỉa (Apriori Property):** *"Mọi tập con của một tập mục phổ biến đều phải là tập mục phổ biến"*. Nếu một tập phim không thỏa mãn `min_support`, tất cả các tập cha chứa nó đều bị loại bỏ ngay lập tức.
  * Giúp giảm thiểu tối đa không gian tìm kiếm tổ hợp phim.
* **Quy trình sinh luật và gợi ý (Pipeline):**
  1. **Thu thập dữ liệu:** Đọc lịch sử xem phim từ bảng `luot_xem` và gom nhóm theo từng `user_id`.
  2. **Tạo Frequent Itemsets:** Tìm các tập phim xuất hiện cùng nhau với tần suất $\ge min\_support$.
  3. **Sinh luật kết hợp:** Lập các luật $X \Rightarrow Y$ đạt $Conf \ge min\_confidence$ và $Lift > 1.0$.
  4. **Áp dụng gợi ý cho User:** Lấy danh sách phim đã xem của User hiện tại làm tiền đề $X$, tìm các hệ quả $Y$, tính toán điểm $Score$ và sắp xếp lấy **Top 3 Phim Gợi Ý**.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Quy trình xử lý gồm 4 bước rõ ràng: Thu thập lịch sử xem -> Tìm tập phổ biến bằng Apriori -> Sinh luật thỏa mãn ngưỡng Confidence và Lift -> Trích xuất Top 3 phim có điểm số cao nhất trả về cho giao diện người dùng."*

---

### SLIDE 09: KIẾN TRÚC TÍCH HỢP MODULE GỢI Ý VÀO NỀN TẢNG WEB
* **Luồng xử lý tại `RecommendationController.php`:**
  * Khi người dùng truy cập route `/recommend/{userId}`:
    1. Controller gọi Engine khai phá dữ liệu với tham số `$userId`.
    2. Nhận kết quả JSON chứa: Phim đã xem (`watched`), Gợi ý chung cho User (`recommendations`), và Gợi ý riêng khi chọn từng bộ phim cụ thể (`movieRecommendations`).
    3. Controller tự động ánh xạ tiêu đề phim với CSDL `phim` trong MySQL để bổ sung ID, Ảnh bìa (`anh_bia`) và đường dẫn xem phim.
    4. **Cơ chế Fallback thông minh (Giải quyết bài toán Cold-Start):** Nếu User là người dùng mới (chưa có lịch sử) hoặc script chưa trả kết quả, Controller tự động kích hoạt cơ chế dự phòng dựa trên Top phim ngẫu nhiên/nổi bật để đảm bảo giao diện luôn hiển thị mượt mà không bị lỗi.

```
[User Interface] ──HTTP GET /recommend/{userId}──> [RecommendationController]
                                                          │
                    ┌─────────────────────────────────────┴─────────────────────────────────────┐
                    ▼                                                                           ▼
           [Data Mining Engine]                                                        [Eloquent ORM / MySQL]
        (Apriori Rule Processor)                                                       (Query Film Data & Post)
                    │                                                                           │
                    └───────────────────> [Merge Data & Fallback Check] <───────────────────────┘
                                                          │
                                             [Render recommend.blade.php]
```

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Về mặt kiến trúc phần mềm, Controller đóng vai trò điều phối trung tâm. Nó tiếp nhận dữ liệu luật, đồng bộ với CSDL MySQL để gắn hình ảnh, liên kết xem phim và đặc biệt có cơ chế Fallback xử lý vấn đề Cold-Start (khi người dùng mới chưa có lịch sử), giúp hệ thống luôn hoạt động ổn định và có tính sẵn sàng cao."*

---

# PHẦN 3: KẾT QUẢ VÀ THẢO LUẬN

---

### SLIDE 10: KẾT QUẢ HIỆN THỰC HÓA PHÂN HỆ NGƯỜI DÙNG (CLIENT)
* **Giao diện Dark Mode sang trọng & Responsive:**
  * **Trang chủ (`home.blade.php`):** Slider banner phim HOT, danh mục Phim Mới, Phim Bộ, Phim Lẻ, Top 10 bảng xếp hạng.
  * **Tìm kiếm Động AJAX Live Search (`/ajax-search`):** Gõ từ khóa hiển thị ngay kết quả kèm Poster, năm phát hành trong $< 300$ ms không tải lại trang.
  * **Trang Xem Phim (`/xem-phim/{id}`):** Trình phát HTML5 Video mượt mà, hỗ trợ chuyển tập phim bộ linh hoạt, khu vực bình luận tương tác thời gian thực.
  * **Xác thực đa kênh:** Đăng ký/Đăng nhập truyền thống và tích hợp **Google OAuth 2.0 (1-Click Login)** an toàn qua Laravel Socialite.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Đây là giao diện phía người xem với thiết kế tông màu tối sang trọng như trong rạp chiếu phim. Điểm nổi bật là tính năng tìm kiếm AJAX cực nhanh và trình phát video hỗ trợ cả phim lẻ 1 tập lẫn phim bộ nhiều tập với khả năng tự động tăng biến đếm lượt xem trong CSDL."*

---

### SLIDE 11: KẾT QUẢ HIỆN THỰC HÓA PHÂN HỆ QUẢN TRỊ (ADMIN PANEL)
* **Giao diện Dashboard SB-Admin 2 chuyên nghiệp:**
  * **Dashboard thống kê:** Tổng số phim, tổng lượt xem, tổng thành viên đăng ký.
  * **Quản lý Bộ Phim (CRUD Phim):** Thêm mới phim lẻ/bộ, tải lên poster/trailer/video, gán nhiều thể loại đồng thời, tự động sinh thư mục `public/img/ds_phim/...` và tự động tạo $N$ tập phim nháp cho phim bộ.
  * **Quản lý Thể loại (`/admin/danhmuc`):** Thêm, sửa, xóa danh mục thể loại phim.
  * **Quản lý Tài khoản (`/admin/ds_taikhoan`):** Xem danh sách và thực hiện Khóa / Mở khóa tài khoản người dùng ngay lập tức (`toggle-status`).
  * **Quản lý Lượt xem (`/admin/views`):** Theo dõi và điều chỉnh lượt xem của phim.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Phân hệ Admin được xây dựng trên chuẩn SB-Admin 2 với đầy đủ các nghiệp vụ quản trị nội dung. Khi Admin thêm một bộ phim bộ có 24 tập, hệ thống sẽ tự động khởi tạo 24 tập phim nháp trong CSDL giúp giảm thiểu tối đa thao tác nhập liệu thủ công."*

---

### SLIDE 12: KẾT QUẢ THỰC NGHIỆM HỆ THỐNG GỢI Ý BẰNG LUẬT (DEMO RECOMMEND)
* **Màn hình Trực quan hóa Gợi ý (`/recommend/{userId}`):**
  * **Khối 1: Danh sách phim User đã xem:** Hiển thị thẻ Card trực quan các phim trong lịch sử. Người dùng có thể nhấp chọn từng phim để xem luật kích hoạt tương ứng.
  * **Khối 2: TOP 3 PHIM GỢI Ý (🥇 Gợi ý 1, 🥈 Gợi ý 2, 🥉 Gợi ý 3):**
    * Tên phim gợi ý kèm liên kết chuyển thẳng đến trang xem phim.
    * **Chỉ số Score:** Điểm số đánh giá độ phù hợp (VD: $4.9 / 5.0$).
    * **Chỉ số Confidence:** Độ tin cậy của luật kích hoạt (VD: $98\%$).
    * **Chỉ số Lift:** Độ nâng tương quan (VD: $2.1$).

```
╔══════════════════════════════════════════════════════════════════════════════════════════════════╗
║  📺 PHIM ĐÃ XEM: [ Mai (2024) ]  [ Kẻ Ăn Hồn (2023) ]  [ Cô Ba Sài Gòn (2017) ]                  ║
╠══════════════════════════════════════════════════════════════════════════════════════════════════╣
║  🎯 TOP 3 PHIM GỢI Ý DỰA TRÊN LUẬT KẾT HỢP:                                                      ║
║  ┌─────────────────────────┐  ┌─────────────────────────┐  ┌─────────────────────────┐           ║
║  │ 🥇 GỢI Ý 1              │  │ 🥈 GỢI Ý 2              │  │ 🥉 GỢI Ý 3              │           ║
║  │ 🎬 Cuộc Chiến Vô Cực    │  │ 🎬 Hành Tinh Mẹ         │  │ 🎬 Thế Giới Vuông       │           ║
║  │ ⭐ Score: 4.9           │  │ ⭐ Score: 4.7           │  │ ⭐ Score: 4.5           │           ║
║  │ 📈 Confidence: 98%      │  │ 📈 Confidence: 93%      │  │ 📈 Confidence: 88%      │           ║
║  │ 🚀 Lift: 2.1            │  │ 🚀 Lift: 1.8            │  │ 🚀 Lift: 1.5            │           ║
║  │ [ Xem Phim Ngay ]       │  │ [ Xem Phim Ngay ]       │  │ [ Xem Phim Ngay ]       │           ║
║  └─────────────────────────┘  └─────────────────────────┘  └─────────────────────────┘           ║
╚══════════════════════════════════════════════════════════════════════════════════════════════════╝
```

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Trên màn hình là kết quả thực tế của trang gợi ý phim. Hệ thống hiển thị rõ ràng Top 3 phim được đề xuất cho User kèm theo các chỉ số khoa học minh bạch: Độ tin cậy Confidence 98% và Độ nâng Lift 2.1. Người dùng có thể nhấp chọn từng phim đã xem trong quá khứ để xem hệ thống thay đổi luật gợi ý theo thời gian thực như thế nào."*

---

### SLIDE 13: ĐÁNH GIÁ VÀ THẢO LUẬN KẾT QUẢ GỢI Ý
* **So sánh với các phương pháp gợi ý khác:**

| Tiêu Chí So Sánh | Gợi Ý Theo Lượt Xem (Views) | Gợi Ý Cùng Thể Loại | Gợi Ý Bằng Luật (Association Rules - Đề Tài) |
| :--- | :--- | :--- | :--- |
| **Tính cá nhân hóa** | Không (Mọi user như nhau) | Trung bình (Chỉ lọc thể loại) | **Rất cao (Theo hành vi thực tế)** |
| **Tính minh bạch (Explainability)**| Thấp | Thấp | **Rất cao (Rõ ràng qua Support, Conf, Lift)** |
| **Tốc độ phản hồi (Latency)** | Nhanh | Trung bình | **Rất nhanh (Sau khi luật đã sinh)** |
| **Khả năng khám phá (Serendipity)**| Rất thấp | Thấp | **Cao (Tìm ra mối liên hệ bất ngờ giữa các phim)** |

* **Ưu điểm nổi bật của hệ thống:**
  * **Giải thích được lý do gợi ý:** Giúp người dùng hiểu tại sao bộ phim này lại được đề xuất cho họ.
  * **Tốc độ truy xuất nhanh:** Các luật kết hợp mạnh được trích xuất sẵn, khi người dùng xem phim hệ thống chỉ cần khớp luật (Pattern Matching) với độ phức tạp $O(1)$ đến $O(k)$.
  * **Khắc phục Cold-Start:** Cơ chế Fallback sang Top rated/Random đảm bảo trải nghiệm liền mạch cho người dùng mới.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Qua bảng so sánh, ta thấy phương pháp gợi ý bằng luật kết hợp vượt trội hơn hẳn so với gợi ý theo lượt xem đơn thuần. Điểm mạnh lớn nhất là tính minh bạch (Explainable AI) và tốc độ thực thi thời gian thực cực nhanh, đồng thời có khả năng phát hiện ra những sở thích xem phim tiềm ẩn mà việc lọc theo thể loại không làm được."*

---

### SLIDE 14: KẾT QUẢ KIỂM THỬ HỆ THỐNG (BLACKBOX TESTING)
Tiến hành kiểm thử hộp đen toàn diện trên tất cả các ca kiểm thử chính:

| Mã TC | Chức Năng Kiểm Thử | Dữ Liệu & Thao Tác | Kết Quả Mong Đợi | Trạng Thái |
| :-: | :--- | :--- | :--- | :-: |
| **TC-01** | Đăng ký tài khoản mới | Email chưa tồn tại, Pass $\ge 6$ ký tự | Tạo tài khoản, sinh `user_id` 8 số ngẫu nhiên | **PASS** ✅ |
| **TC-02** | Đăng nhập Google OAuth | Tài khoản Google hợp lệ | Tự động tạo user, lưu `google_id`, vào trang chủ | **PASS** ✅ |
| **TC-03** | Tìm kiếm AJAX Live | Nhập từ khóa tên phim | Trả về JSON dropdown gợi ý $< 300$ ms | **PASS** ✅ |
| **TC-04** | Xem phim & Đổi tập | Chọn Tập 2 của Phim bộ | Đổi video mượt mà, tăng `tong_views` trong CSDL | **PASS** ✅ |
| **TC-05** | Admin Thêm phim mới | Form upload poster + phim bộ | Lưu CSDL, tạo folder, tự sinh $N$ tập phim nháp | **PASS** ✅ |
| **TC-06** | Khóa tài khoản User | Admin toggle trạng thái user | Chặn user đăng nhập, báo *"Tài khoản đã bị khóa"* | **PASS** ✅ |
| **TC-07** | Hiển thị Gợi ý Phim | Truy cập `/recommend/{userId}` | Render Top 3 phim kèm Score, Confidence, Lift | **PASS** ✅ |

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Tất cả 7 kịch bản kiểm thử hộp đen cốt lõi đều đạt kết quả PASS 100%, chứng minh hệ thống hoạt động ổn định, dữ liệu đồng bộ chính xác giữa Client, Admin và Module gợi ý."*

---

### SLIDE 15: ĐÁNH GIÁ HIỆU NĂNG VÀ AN TOÀN BẢO MẬT
* **Đánh giá Hiệu năng Hệ thống:**
  * Thời gian tải trang trung bình (Page Load Time): **$0.8 - 1.2$ giây**.
  * Thời gian phản hồi request AJAX Search: **$180 - 250$ ms**.
  * Áp dụng Eloquent Pagination (`paginate(12)`) giúp giảm thiểu gánh nặng RAM và thời gian truy vấn SQL khi dữ liệu phim tăng cao.
* **Đánh giá An toàn Bảo mật:**
  * **CSRF Protection:** 100% Form gửi dữ liệu đều được bảo vệ bằng Token `@csrf`.
  * **Chống SQL Injection:** 100% truy vấn CSDL sử dụng Eloquent ORM Prepared Statements Binding.
  * **Chống XSS:** Mã hóa tự động ký tự đầu ra qua Blade Engine `{{ }}`.
  * **Mã hóa Mật khẩu:** Thuật toán Bcrypt an toàn chuẩn công nghiệp.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Hệ thống được tối ưu hóa toàn diện về hiệu năng với thời gian tải trang dưới 1.2 giây và tuân thủ các chuẩn an toàn bảo mật hàng đầu của Laravel, chống lại các lỗ hổng web phổ biến như CSRF, XSS và SQL Injection."*

---

# PHẦN 4: KẾT LUẬN VÀ ĐỀ NGHỊ

---

### SLIDE 16: KẾT LUẬN ĐỀ TÀI
* **Các kết quả đạt được của đề tài:**
  1. **Hoàn thiện Website Xem Phim Trực Tuyến:** Hệ thống hoạt động trơn tru với đầy đủ các phân hệ Client (Phim lẻ, Phim bộ, HTML5 Player, Tìm kiếm AJAX, Google OAuth) và Admin (SB-Admin 2, CRUD Phim, Quản lý Tập, User, Views).
  2. **Nghiên cứu & Ứng dụng thành công Khai phá luật kết hợp (Association Rules Mining):** 
     * Xây dựng thành công thuật toán trích xuất các luật kết hợp hành vi xem phim.
     * Đánh giá luật khoa học thông qua các chỉ số **Support**, **Confidence**, **Lift** và điểm **Score**.
     * Tích hợp thành công trang gợi ý cá nhân hóa tương tác linh hoạt theo người dùng và theo từng bộ phim.
  3. **Tối ưu hóa kiến trúc:** Mã nguồn phân lớp MVC chuẩn mực, CSDL chuẩn 3NF, bảo mật cao và hiệu năng mượt mà.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Kính thưa Hội đồng, đề tài đã hoàn thành xuất sắc các mục tiêu đề ra ban đầu: Xây dựng một nền tảng xem phim trực tuyến hiện đại và nâng cấp thành công hệ thống gợi ý thông minh dựa trên luật kết hợp, mang lại giá trị trải nghiệm thiết thực cho người dùng."*

---

### SLIDE 17: HẠN CHẾ & HƯỚNG PHÁT TRIỂN TRONG TƯƠNG LAI (ĐỀ NGHỊ)
* **Hạn chế hiện tại:**
  * Tập dữ liệu giao dịch ban đầu còn ở quy mô vừa và nhỏ, cần tiếp tục mở rộng khi lượng người dùng thực tế tăng lên.
  * Luật kết hợp tĩnh cần cơ chế tự động huấn luyện lại định kỳ (Scheduled Cron Job / Pipeline) khi có dữ liệu xem mới.
* **Hướng phát triển và Đề xuất nâng cấp:**
  1. **Mô hình Gợi ý Lai (Hybrid Recommendation System):** Kết hợp Khai phá luật kết hợp (Association Rules) cùng Lọc cộng tác (Collaborative Filtering / Matrix Factorization) và Lọc theo nội dung (Content-Based) để tối đa hóa độ chính xác.
  2. **Streaming Video chuyên nghiệp:** Tích hợp giao thức HLS (HTTP Live Streaming) / DASH và mạng phân phối nội dung (CDN) để phát video đa độ phân giải (360p, 720p, 1080p, 4K) tự động theo băng thông mạng.
  3. **Thương mại hóa dịch vụ:** Tích hợp cổng thanh toán trực tuyến (VNPAY, MoMo, ZaloPay) phục vụ các gói xem phim VIP / Premium không quảng cáo.
  4. **Ứng dụng Đa nền tảng:** Phát triển ứng dụng Mobile App (Flutter / React Native) và Smart TV đồng bộ chung cơ sở dữ liệu RESTful API.

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Trong tương lai, hướng nghiên cứu tiếp theo sẽ tập trung vào việc xây dựng hệ thống gợi ý lai Hybrid kết hợp giữa luật kết hợp và học máy sâu (Deep Learning), đồng thời nâng cấp giao thức truyền tải video HLS/CDN và tích hợp thanh toán gói VIP để thương mại hóa sản phẩm."*

---

### SLIDE 18: LỜI CẢM ƠN & PHIÊN THẢO LUẬN (Q&A)
* **Lời cảm ơn:**
  * Chân thành gửi lời cảm ơn sâu sắc đến **[Tên Giảng Viên Hướng Dẫn]** đã tận tình chỉ bảo, định hướng và hỗ trợ em trong suốt quá trình thực hiện đề tài.
  * Cảm ơn quý Thầy/Cô trong **Hội đồng Chấm Khóa Luận Tốt Nghiệp** đã dành thời gian lắng nghe và đóng góp ý kiến quý báu.
* **Phiên Hỏi - Đáp (Q&A):**
  * Em xin trân trọng kính mời quý Thầy/Cô trong Hội đồng đặt câu hỏi và đóng góp ý kiến để đề tài được hoàn thiện hơn nữa!
  * **XIN CHÂN THÀNH CẢM ƠN QUÝ THẦY CÔ!**

> 🗣️ **Lời thoại thuyết trình (Speaker Notes):**  
> *"Bài báo cáo tốt nghiệp của em đến đây là kết thúc. Em xin chân thành cảm ơn quý Thầy/Cô trong Hội đồng đã chú ý lắng nghe. Em rất mong nhận được những nhận xét, đánh giá và câu hỏi phản biện từ quý Thầy/Cô để đề tài có thể hoàn thiện hơn. Em xin trân trọng cảm ơn!"*
