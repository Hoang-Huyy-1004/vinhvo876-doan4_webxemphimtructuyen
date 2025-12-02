@php
use Illuminate\Support\Str;
@endphp

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
            min-height: 100vh;
            background-color: #ffffffff;
            /* nền đen cho giống giao diện phim */
        }

        main {
            flex: 1;
        }

        .navbar-nav .nav-link {
            font-size: 15px;
            margin-right: 10px;
        }

        .navbar-nav .nav-link:hover {
            color: #ff6600 !important;
        }

        .card {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        /* ==== Khung ảnh poster chuẩn 2:3 ==== */
        .poster-wrapper {
            width: 100%;
            aspect-ratio: 2 / 3;
            /* giữ tỉ lệ 2:3 */
            overflow: hidden;
            border-radius: 8px;
            background: #111;
            /* nền tối nếu ảnh lỗi */
        }

        .poster-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* crop ảnh vừa khung */
            border-radius: 8px;
        }
    </style>
</head>

<body>
    @include('header')

    <main class="container my-4 text-black">

        <!-- Mới ra mắt -->
        <h4 class="mb-3">Mới ra mắt</h4>
        <div class="row flex-nowrap overflow-auto">
            @foreach($phimMoi as $phim)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none text-white">
                    <div class="card bg-dark text-white border-0">
                        <div class="position-relative poster-wrapper">
                            <img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}">
                            <span class="badge bg-primary position-absolute top-0 start-0 m-2">MỚI</span>
                            @if($phim->loai == 'phim_bo')
                            <span class="badge bg-dark position-absolute bottom-0 end-0 m-2 opacity-75">
                                {{ $phim->so_tap }} Tập
                            </span>
                            @endif
                        </div>
                        <div class="card-body p-2 text-center">
                            <h6 class="card-title text-truncate">{{ $phim->ten_phim }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Phim nổi bật -->
        <h4 class="mb-3 mt-4">Phim nổi bật</h4>
        <div class="row flex-nowrap overflow-auto">
            @foreach($phimNoiBat as $phim)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none text-white">
                    <div class="card bg-dark text-white border-0">
                        <div class="position-relative poster-wrapper">
                            <img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}">
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">NỔI BẬT</span>
                            @if($phim->loai == 'phim_bo')
                            <span class="badge bg-dark position-absolute bottom-0 end-0 m-2 opacity-75">
                                {{ $phim->so_tap }} Tập
                            </span>
                            @endif
                        </div>
                        <div class="card-body p-2 text-center">
                            <h6 class="card-title text-truncate">{{ $phim->ten_phim }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Phim hot -->
        <h4 class="mb-3 mt-4">Phim HOT</h4>
        <div class="row flex-nowrap overflow-auto">
            @foreach($phimHot as $phim)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none text-white">
                    <div class="card bg-dark text-white border-0">
                        <div class="position-relative poster-wrapper">
                            <img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}">
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">HOT</span>
                            @if($phim->loai == 'phim_bo')
                            <span class="badge bg-dark position-absolute bottom-0 end-0 m-2 opacity-75">
                                {{ $phim->so_tap }} Tập
                            </span>
                            @endif
                        </div>
                        <div class="card-body p-2 text-center">
                            <h6 class="card-title text-truncate">{{ $phim->ten_phim }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Phim bình thường -->
        <h4 class="mb-3 mt-4">Phim </h4>
        <div class="row flex-nowrap overflow-auto">
            @foreach($phimbinhthuong as $phim)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none text-white">
                    <div class="card bg-dark text-white border-0">
                        <div class="position-relative poster-wrapper">
                            @php
                            $anhBia = $phim->anh_bia;
                            if (!Str::startsWith($anhBia, ['http://', 'https://'])) {
                            $anhBia = asset($anhBia);
                            }
                            @endphp

                            <img src="{{ $anhBia }}" alt="{{ $phim->ten_phim }}">

                            <span class="badge bg-light text-dark position-absolute top-0 start-0 m-2">Phim</span>
                            @if($phim->loai == 'phim_bo')
                            <span class="badge bg-dark position-absolute bottom-0 end-0 m-2 opacity-75">
                                {{ $phim->so_tap }} Tập
                            </span>
                            @endif
                        </div>
                        <div class="card-body p-2 text-center">
                            <h6 class="card-title text-truncate">{{ $phim->ten_phim }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>