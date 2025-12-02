@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILMHAY - PHIM TÌNH CẢM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #fff;
        }
        main { flex: 1; }
        .card { cursor: pointer; transition: transform 0.2s; }
        .card:hover { transform: scale(1.05); }
        .poster-wrapper {
            width: 100%;
            aspect-ratio: 2 / 3;
            overflow: hidden;
            border-radius: 8px;
            background: #111;
        }
        .poster-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        /* Style phân trang */
        .page-item.active .page-link {
            background-color: #ff4081; /* Màu hồng cho phim tình cảm */
            border-color: #ff4081;
            color: white;
        }
        .page-link { color: #333; }
        .page-link:hover { color: #ff4081; }
    </style>
</head>

<body>
    @include('header')

    <main class="container my-4 text-black">

        <h4 class="mb-3">Phim Tình Cảm</h4>
        
        <div class="row g-3">
            @if($danhSachPhim->count() > 0)
                @foreach($danhSachPhim as $phim)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none">
                        <div class="card bg-dark text-white border-0 h-100">
                            <div class="position-relative poster-wrapper">
                                <img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}">
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">Tình Cảm</span>
                            </div>
                            <div class="card-body p-2 text-center">
                                <h6 class="card-title text-truncate">{{ $phim->ten_phim }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <p class="text-center">Chưa có phim thuộc thể loại này.</p>
            @endif
        </div>

        @if ($danhSachPhim->lastPage() > 1)
        <div class="d-flex justify-content-center mt-5">
            <nav>
                <ul class="pagination">
                    
                    {{-- Nút Trước --}}
                    @if ($danhSachPhim->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $danhSachPhim->previousPageUrl() }}">&laquo;</a>
                        </li>
                    @endif

                    {{-- Số trang --}}
                    @for ($i = 1; $i <= $danhSachPhim->lastPage(); $i++)
                        <li class="page-item {{ ($danhSachPhim->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $danhSachPhim->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Nút Sau --}}
                    @if ($danhSachPhim->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $danhSachPhim->nextPageUrl() }}">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                    
                </ul>
            </nav>
        </div>
        @endif

    </main>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>