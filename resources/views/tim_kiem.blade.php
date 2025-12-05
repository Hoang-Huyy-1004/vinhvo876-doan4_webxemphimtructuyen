@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm - FILMHAY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/top10.css') }}">

    <style>
        /* 1. Cấu trúc trang dạng cột: Header trên, Footer dưới */
        body {
            background-color: #0a0a0a;
            display: flex;
            flex-direction: column; /* Quan trọng: Xếp dọc */
            min-height: 100vh;
            margin: 0;
            color: #fff;
            overflow-x: hidden; /* Chặn thanh cuộn ngang trang web */
        }

        /* 2. Vùng nội dung chính: Tự giãn nở */
        .main-content {
            flex: 1; 
            display: flex;
            flex-direction: column; /* Xếp dọc: Thanh tìm kiếm trên, Top 10 dưới */
            justify-content: center; /* Căn giữa theo chiều dọc */
            align-items: center;     /* Căn giữa theo chiều ngang */
            width: 100%;
            padding: 40px 20px;
            gap: 50px; /* Khoảng cách giữa thanh tìm kiếm và Top 10 */
        }

        /* --- CSS THANH TÌM KIẾM --- */
        .search-wrapper {
            background-color: #1a1a1a;
            border-radius: 60px;
            padding: 10px 10px 10px 30px;
            width: 100%;
            max-width: 900px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
            border: 1px solid #333;
        }

        .search-icon {
            color: #b0b0b0;
            font-size: 1.6rem;
            margin-right: 15px;
        }

        .search-input {
            background: transparent;
            border: none;
            color: #e0e0e0;
            flex-grow: 1;
            outline: none;
            font-size: 1.3rem;
        }

        .search-input::placeholder {
            color: #555;
            font-weight: 400;
        }

        .btn-search-custom {
            background-color: #2b2b2b;
            color: #b0b0b0;
            border-radius: 50px;
            padding: 12px 40px;
            border: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-search-custom:hover {
            background-color: #ff6600; /* Đổi màu cam cho nổi bật */
            color: #ffffff;
            cursor: pointer;
        }

        /* --- CSS TÙY CHỈNH CHO TOP 10 TRONG TRANG TỐI --- */
        .top10-container-custom {
            width: 100%;
            max-width: 1400px; 
            /* Giới hạn chiều rộng Top 10 */
        }
        
        /* Ghi đè màu chữ tiêu đề Top 10 thành màu trắng */
        .top10-title-heading {
            color: white !important;
            text-shadow: 0 0 10px rgba(255,255,255,0.2);
        }
    </style>
</head>

<body>

    @include('header')

    <div class="main-content">
        
        <form action="" method="GET" class="w-100 d-flex justify-content-center mt-5">
            <div class="search-wrapper">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="keyword" class="search-input" placeholder="Nhập tên phim muốn tìm..." autocomplete="off">
                <button type="submit" class="btn-search-custom">Tìm kiếm</button>
            </div>
        </form>

        <div class="top10-container-custom mt-5">
            <h4 class="mb-4 fw-bold top10-title-heading">
                <i class="bi bi-fire text-danger"></i> Top 10 Phim Xu Hướng
            </h4>

            <div class="slider-container position-relative">
                <button class="nav-btn nav-left" onclick="scrollAny('top10List', 'left')">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="slider-list" id="top10List">
                    @if(isset($top10) && $top10->count() > 0)
                        @foreach($top10 as $index => $view)
                            @php
                                if (!$view->phim) continue;
                                $anhBia = $view->phim->anh_bia;
                                if (!Str::startsWith($anhBia, ['http://', 'https://'])) {
                                    $anhBia = asset($anhBia);
                                }
                                $gradClass = 't-grad-' . ($index % 5);
                                $rank = $index + 1;
                            @endphp

                            <div class="top10-item">
                                <a href="{{ route('xemphim', $view->phim->id) }}" class="text-white text-decoration-none">
                                    <img src="{{ $anhBia }}" class="top10-poster" alt="{{ $view->phim->ten_phim }}">
                                    <div class="top10-overlay {{ $gradClass }}"></div>
                                    <div class="top10-rank" data-rank="{{ $rank }}">{{ $rank }}</div>
                                    <div class="top10-title text-truncate">{{ $view->phim->ten_phim }}</div>

                                    @if($view->phim->loai == 'phim_bo')
                                        <span class="badge bg-success position-absolute top-0 end-0 m-2">PHIM BỘ</span>
                                    @elseif($view->phim->loai == 'phim_le')
                                        <span class="badge bg-light btn btn-outline-info border-2 text-dark position-absolute top-0 end-0 m-2">PHIM LẺ</span>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p class="text-secondary fst-italic">Dữ liệu Top 10 đang cập nhật...</p>
                    @endif
                </div>

                <button class="nav-btn nav-right" onclick="scrollAny('top10List', 'right')">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function scrollAny(elementId, direction) {
            const container = document.getElementById(elementId);
            if (container) {
                const scrollAmount = 500;
                if (direction === 'left') {
                    container.scrollLeft -= scrollAmount;
                } else {
                    container.scrollLeft += scrollAmount;
                }
            }
        }

        // Tự động ẩn/hiện nút scroll
        function checkScrollButtons() {
            const sliderLists = document.querySelectorAll('.slider-list');
            sliderLists.forEach(list => {
                const parent = list.parentElement;
                const leftBtn = parent.querySelector('.nav-left');
                const rightBtn = parent.querySelector('.nav-right');

                if (leftBtn && rightBtn) {
                    if (list.scrollWidth > list.clientWidth) {
                        leftBtn.style.display = 'flex';
                        rightBtn.style.display = 'flex';
                    } else {
                        leftBtn.style.display = 'none';
                        rightBtn.style.display = 'none';
                    }
                }
            });
        }

        document.addEventListener("DOMContentLoaded", checkScrollButtons);
        window.addEventListener('resize', checkScrollButtons);
    </script>
</body>

</html>