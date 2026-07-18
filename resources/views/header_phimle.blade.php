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

        <h4 class="mb-3">Tất cả phim lẻ</h4>

        <div class="row g-3">

            @if($danhSachPhimLe->count() > 0)

            @foreach($danhSachPhimLe as $phim)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none">
                    <div class="card bg-dark text-white border-0 h-100">
                        <div class="position-relative poster-wrapper">
                            <img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}">
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">Phim Lẻ</span>
                        </div>
                        <div class="card-body p-2 text-center">
                            <h6 class="card-title text-truncate">{{ $phim->ten_phim }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

            @else
            <p class="text-center">Hiện chưa có phim lẻ nào được cập nhật.</p>
            @endif

        </div>

        <div class="d-flex justify-content-center mt-4">
            @if ($danhSachPhimLe->lastPage() > 1)
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination">

                        {{-- 1. Nút Lùi (Previous) --}}
                        @if ($danhSachPhimLe->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">&laquo;</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $danhSachPhimLe->previousPageUrl() }}">&laquo;</a>
                        </li>
                        @endif

                        {{-- 2. Các số trang (Vòng lặp từ trang 1 đến trang cuối) --}}
                        @for ($i = 1; $i <= $danhSachPhimLe->lastPage(); $i++)
                            <li class="page-item {{ ($danhSachPhimLe->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $danhSachPhimLe->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            {{-- 3. Nút Tiếp (Next) --}}
                            @if ($danhSachPhimLe->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $danhSachPhimLe->nextPageUrl() }}">&raquo;</a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                            @endif

                    </ul>
                </nav>
            </div>
            @endif
        </div>

    </main>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>