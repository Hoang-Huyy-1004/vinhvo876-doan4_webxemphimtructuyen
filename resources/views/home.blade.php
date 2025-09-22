<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILMHAY - HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* luôn full chiều cao */
            background-color: #000; /* nền đen cho giống giao diện phim */
        }

        main {
            flex: 1; /* đẩy footer xuống cuối */
        }

        .navbar-nav .nav-link {
            font-size: 15px;
            margin-right: 10px;
        }

        .navbar-nav .nav-link:hover {
            color: #ff6600 !important;
        }
    </style>
</head>

<body>
    @include('header')

    <main class="container my-4 text-white">

<div class="container mt-4">
    <h5 class="text-white mb-3"><b>Mới ra mắt</b></h5>

    <div class="d-flex overflow-auto">
        @foreach($videos as $video)
            <div class="me-3" style="width: 200px;">
                <div class="position-relative">
                    <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="img-fluid rounded">

                    @if($video->tag)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                            {{ $video->tag }}
                        </span>
                    @endif
                </div>
                <p class="text-white mt-2">{{ $video->title }}</p>
            </div>
        @endforeach
    </div>
</div>

    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
