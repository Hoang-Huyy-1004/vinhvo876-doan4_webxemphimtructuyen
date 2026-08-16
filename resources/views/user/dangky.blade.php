<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản - FILMHAY</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-red: #e50914;
            --brand-red-hover: #ff1e27;
            --brand-red-dark: #b20710;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-bg);
            background-image: 
                radial-gradient(at 90% 10%, rgba(229, 9, 20, 0.07) 0px, transparent 45%),
                radial-gradient(at 10% 90%, rgba(14, 165, 233, 0.08) 0px, transparent 45%),
                radial-gradient(at 50% 30%, rgba(99, 102, 241, 0.05) 0px, transparent 55%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1.5rem;
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
        }

        .auth-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 2.75rem 2.25rem;
            box-shadow: 
                0 20px 45px -10px rgba(15, 23, 42, 0.08),
                0 0 1px rgba(15, 23, 42, 0.12);
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Brand Logo */
        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-dark);
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .brand-logo i {
            color: var(--brand-red);
            font-size: 1.9rem;
            filter: drop-shadow(0 2px 8px rgba(229, 9, 20, 0.3));
        }

        .brand-logo span {
            background: linear-gradient(135deg, #0f172a 30%, #334155 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        /* Form Controls */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.4rem;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            color: #94a3b8;
            font-size: 1.1rem;
            pointer-events: none;
            transition: color 0.2s;
            z-index: 2;
        }

        .form-control-custom {
            width: 100%;
            background: #f8fafc;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            padding: 0.85rem 1rem 0.85rem 2.85rem;
            color: var(--text-dark);
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.25s ease;
        }

        .form-control-custom::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-control-custom:focus {
            background: #ffffff;
            border-color: var(--brand-red);
            box-shadow: 0 0 0 4px rgba(229, 9, 20, 0.12);
            outline: none;
            color: var(--text-dark);
        }

        .input-group-custom:focus-within .input-icon {
            color: var(--brand-red);
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            color: #94a3b8;
            cursor: pointer;
            border: none;
            background: transparent;
            padding: 0;
            font-size: 1.1rem;
            z-index: 2;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #475569;
        }

        /* Buttons */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--brand-red) 0%, var(--brand-red-dark) 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 0.9rem;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 18px rgba(229, 9, 20, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--brand-red-hover) 0%, var(--brand-red) 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(229, 9, 20, 0.35);
            color: #ffffff;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Links */
        .auth-footer {
            margin-top: 1.75rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .auth-footer a {
            color: var(--brand-red);
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
        }

        .auth-footer a:hover {
            color: var(--brand-red-hover);
            text-decoration: underline;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 1.25rem;
            transition: color 0.2s;
        }

        .back-home:hover {
            color: var(--text-dark);
        }

        /* Alerts */
        .alert-custom-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 12px;
            font-size: 0.88rem;
            padding: 0.75rem 1rem;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <!-- Quay lại trang chủ -->
        <a href="{{ route('home') }}" class="back-home">
            <i class="bi bi-arrow-left"></i> Quay lại trang chủ
        </a>

        <!-- Header / Logo -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="brand-logo">
                <i class="bi bi-film"></i>
                <span>FILMHAY</span>
            </a>
            <p class="subtitle">Tạo tài khoản mới để bắt đầu xem hàng ngàn bộ phim bom tấn</p>
        </div>

        <!-- Thông báo lỗi nếu có -->
        @if ($errors->any())
        <div class="alert alert-custom-danger mb-3">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Đăng ký -->
        <form action="{{ route('dangky') }}" method="POST">
            @csrf
            
            <!-- Ô Gmail -->
            <div class="mb-3">
                <label class="form-label">Địa chỉ Email / Gmail</label>
                <div class="input-group-custom">
                    <i class="bi bi-envelope-fill input-icon"></i>
                    <input type="email" name="email" class="form-control-custom" placeholder="nhapemail@gmail.com" value="{{ old('email') }}" required autocomplete="email">
                </div>
            </div>

            <!-- Ô Mật khẩu -->
            <div class="mb-3">
                <label class="form-label">Mật khẩu (tối thiểu 6 ký tự)</label>
                <div class="input-group-custom">
                    <i class="bi bi-shield-lock-fill input-icon"></i>
                    <input type="password" name="password" id="regPassword" class="form-control-custom" placeholder="Nhập mật khẩu" required autocomplete="new-password">
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility('regPassword', this)">
                        <i class="bi bi-eye-slash-fill"></i>
                    </button>
                </div>
            </div>

            <!-- Ô Xác nhận Mật khẩu -->
            <div class="mb-4">
                <label class="form-label">Xác nhận mật khẩu</label>
                <div class="input-group-custom">
                    <i class="bi bi-check-circle-fill input-icon"></i>
                    <input type="password" name="password_confirmation" id="regPasswordConfirm" class="form-control-custom" placeholder="Nhập lại mật khẩu" required autocomplete="new-password">
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility('regPasswordConfirm', this)">
                        <i class="bi bi-eye-slash-fill"></i>
                    </button>
                </div>
            </div>

            <!-- Nút Submit Đăng ký -->
            <button type="submit" class="btn btn-submit">
                <span>Đăng ký tài khoản</span>
                <i class="bi bi-arrow-right-circle-fill"></i>
            </button>
        </form>

        <!-- Footer / Link Đăng nhập -->
        <div class="auth-footer">
            Đã có tài khoản? <a href="{{ route('dangnhap.form') }}">Đăng nhập ngay</a>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            }
        }
    </script>
</body>

</html>