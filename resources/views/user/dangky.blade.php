<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .custom-card {
            max-width: 400px;
            width: 100%;
            border: none; /* Remove default card border */
            border-radius: 12px; /* More rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .form-control-custom {
            border-radius: 8px; /* Slightly more rounded inputs */
            border: 1px solid #ced4da; /* Default border color */
            padding: 12px 15px; /* Adjust padding for height */
        }
        .form-control-custom:focus {
            border-color: #007bff; /* Keep Bootstrap's primary blue on focus */
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25); /* Bootstrap focus shadow */
        }
        .btn-custom-primary {
            background-color: #007bff; /* Bootstrap primary blue */
            border-color: #007bff; /* Match border color */
            color: #fff;
            padding: 12px 20px; /* Larger padding for button */
            border-radius: 8px; /* Match input border-radius */
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }
        .btn-custom-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3;
        }
        .link-secondary-custom {
            color: #0d6efd; /* Bootstrap blue for links */
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .link-secondary-custom:hover {
            color: #0a58ca; /* Darker blue on hover */
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card p-4 custom-card">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 fs-3 fw-bold">Đăng ký</h2>
            <form action="{{ route('dangky') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control form-control-custom" placeholder="Nhập Gmail" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control form-control-custom" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="mb-4"> <input type="password" name="password_confirmation" class="form-control form-control-custom" placeholder="Xác nhận mật khẩu" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom-primary">Đăng ký</button>
                </div>
            </form>
            <div class="text-center mt-4"> <a href="{{ route('dangnhap.form') }}" class="link-secondary-custom">Đã có tài khoản? Đăng nhập</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>