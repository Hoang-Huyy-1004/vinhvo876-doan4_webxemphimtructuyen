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
            --dark-bg: #07090e;
            --card-bg: rgba(15, 23, 42, 0.75);
            --border-glass: rgba(255, 255, 255, 0.1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--dark-bg);
            background-image: 
                radial-gradient(at 85% 15%, rgba(229, 9, 20, 0.18) 0px, transparent 50%),
                radial-gradient(at 15% 85%, rgba(14, 165, 233, 0.12) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(99, 102, 241, 0.08) 0px, transparent 60%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1.5rem;
            color: #f8fafc;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glow Decor */
        .ambient-glow {
            position: absolute;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(229, 9, 20, 0.25) 0%, rgba(0, 0, 0, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            filter: blur(50px);
            z-index: 0;
        }

        .auth-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            background: var(--card-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            padding: 2.75rem 2.25rem;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.7),
                0 0 35px rgba(229, 9, 20, 0.12);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Brand Logo */
        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #ffffff;
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .brand-logo i {
            color: var(--brand-red);
            font-size: 1.9rem;
            filter: drop-shadow(0 0 10px rgba(229, 9, 20, 0.6));
        }

        .brand-logo span {
            background: linear-gradient(135deg, #ffffff 40%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        /* Form Controls */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #cbd5e1;
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
            color: #64748b;
            font-size: 1.1rem;
            pointer-events: none;
            transition: color 0.2s;
            z-index: 2;
        }

        .form-control-custom {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            padding: 0.85rem 1rem 0.85rem 2.85rem;
            color: #ffffff;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }

        .form-control-custom::placeholder {
            color: #64748b;
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--brand-red);
            box-shadow: 0 0 0 4px rgba(229, 9, 20, 0.2);
            outline: none;
            color: #ffffff;
        }

        .input-group-custom:focus-within .input-icon {
            color: var(--brand-red);
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            color: #64748b;
            cursor: pointer;
            border: none;
            background: transparent;
            padding: 0;
            font-size: 1.1rem;
            z-index: 2;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #cbd5e1;
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
            box-shadow: 0 8px 20px rgba(229, 9, 20, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--brand-red-hover) 0%, var(--brand-red) 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(229, 9, 20, 0.45);
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
            color: #94a3b8;
        }

        .auth-footer a {
            color: #38bdf8;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .auth-footer a:hover {
            color: #7dd3fc;
            text-decoration: underline;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            font-size: 0.85rem;
            text-decoration: none;
            margin-bottom: 1.25rem;
            transition: color 0.2s;
        }

        .back-home:hover {
            color: #cbd5e1;
        }

        /* Alerts */
        .alert-custom-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 12px;
            font-size: 0.88rem;
            padding: 0.75rem 1rem;
        }
    </style>
</head>

<body>
    <!-- Ambient glowing light -->
    <div class="ambient-glow"></div>

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