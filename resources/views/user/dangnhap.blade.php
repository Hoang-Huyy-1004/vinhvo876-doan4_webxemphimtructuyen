<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --primary-hover: #0069d9;
            --background-color: #f4f6f8;
            --card-bg-color: #ffffff;
            --text-color: #333;
            --placeholder-color: #888;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .custom-card {
            max-width: 400px;
            width: 100%;
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 3rem;
        }
        .card-title {
            color: var(--text-color);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease-in-out;
        }
        .form-control::placeholder {
            color: var(--placeholder-color);
            font-weight: 400;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.1);
        }
        .btn-custom {
            width: 100%;
            background-color: var(--primary-color);
            border: none;
            color: #fff;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.2);
        }
        .link-text {
            display: block;
            margin-top: 2rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        .link-text:hover {
            text-decoration: underline;
            color: var(--primary-hover);
        }
    </style>
</head>
<body>
    <div class="card custom-card">
        <div class="card-body">
            <h2 class="card-title text-center">Đăng nhập</h2>
            <form action="{{ route('dangnhap') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="email" name="email" class="form-control" placeholder="Nhập Gmail" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-custom">Đăng nhập</button>
            </form>
            <a href="{{ route('dangky.form') }}" class="link-text text-center">Chưa có tài khoản? Đăng ký</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>