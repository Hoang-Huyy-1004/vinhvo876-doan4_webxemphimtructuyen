<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản FPT Play</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* CSS của phần nội dung chính */
        .app-container {
            display: flex;
            height: 85vh;
            width: 85vw;
            max-width: 1400px;
            border-radius: 12px;
            overflow: hidden;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 1cm;
            padding: 10px;
            overflow-y: auto;
        }

        .content-header {
            margin-bottom: 35px;
        }

        .content-header h1 {
            font-size: 2rem;
            font-weight: 500;
            color: var(--text-color);
        }

        .info-card {
            background-color: transparent;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Border bottom cho các thẻ con bên trong, tạo đường phân cách */
            border-bottom: 1px solid var(--card-border);
        }

        .info-card:last-child {
            border-bottom: none;
            /* Bỏ border bottom của thẻ cuối cùng */
        }

        .info-card .label {
            color: var(--text-muted);
            font-weight: 400;
            width: 150px;
            /* Cố định chiều rộng của label để căn chỉnh */
        }

        .info-card .value {
            font-weight: 500;
            color: var(--text-color);
            margin-left: 20px;
            /* Thêm khoảng cách giữa label và value */
            flex-grow: 1;
            /* Cho phép value chiếm hết phần còn lại */
        }

        .info-card-container {
            border: 1px solid var(--card-border);
            border-radius: 8px;
            /* Bo góc cho toàn bộ khối */
            background-color: var(--card-bg);
            margin-bottom: 20px;
            overflow: hidden;
            /* Quan trọng để border-radius hiển thị đúng */
        }
    </style>
</head>

<body>
    <div class="app-container">
        @include('user.menu_taikhoan')

        <div class="main-content">
            <div class="content-header">
                <h1>Thông tin tài khoản</h1>
            </div>
            <div class="info-card-container">
                <div class="info-card">
                    <span class="label">Tên tài khoản</span>
                    <span class="value">{{ $user->name }}</span>
                </div>
                <div class="info-card">
                    <span class="label">UID</span>
                    <span class="value">{{ $user->uid }}</span>
                </div>
                <div class="info-card">
                    <span class="label">Email</span>
                    <span class="value">{{ $user->email }}</span>
                </div>
                <div class="info-card">
                    <span class="label">Số điện thoại</span>
                    <span class="value">{{ $user->phone ?? 'Chưa cập nhật' }}</span>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>