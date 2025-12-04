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

    <link rel="stylesheet" href="{{ asset('css/top10.css') }}">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #ffffffff;
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
            border-radius: 8px;
        }
    </style>
</head>

<body>
    @include('header')

    <main class="container my-4 text-black">

        <div class="mb-3 top10-wrapper">
            <div class="container">
                <h4 class="mb-3 fw-bold" style="color: black">
                    <i class="bi bi-fire text-danger"></i> Top 10 Phim Xu Hướng
                </h4>

                <div class="slider-container mb-4">
                    <button class="nav-btn nav-left" onclick="scrollAny('top10List', 'left')"><i class="bi bi-chevron-left"></i></button>

                    <div class="slider-list" id="top10List">
                        {{-- BẮT ĐẦU VÒNG LẶP TOP 10 --}}
                        @if(isset($top10) && $top10->count() > 0)
                        @foreach($top10 as $index => $view)
                        @php
                        // Kiểm tra xem phim có tồn tại không (đề phòng xóa phim nhưng chưa xóa view)
                        if (!$view->phim) continue;

                        // Xử lý ảnh bìa
                        $anhBia = $view->phim->anh_bia;
                        if (!Str::startsWith($anhBia, ['http://', 'https://'])) {
                        $anhBia = asset($anhBia);
                        }

                        // Tính toán class màu gradient (0 -> 4 rồi lặp lại)
                        $gradClass = 't-grad-' . ($index % 5);

                        // Số thứ tự (index bắt đầu từ 0 nên +1)
                        $rank = $index + 1;
                        @endphp

                        <div class="top10-item">
                            {{-- Link đến chi tiết phim --}}
                            <a href="{{ route('xemphim', $view->phim->id) }}" class="text-white text-decoration-none">
                                <img src="{{ $anhBia }}" class="top10-poster" alt="{{ $view->phim->ten_phim }}">

                                {{-- Lớp phủ màu theo thứ tự --}}
                                <div class="top10-overlay {{ $gradClass }}"></div>

                                {{-- Số thứ tự to --}}
                                <div class="top10-rank" data-rank="{{ $rank }}">{{ $rank }}</div>

                                {{-- Tên phim --}}
                                <div class="top10-title">{{ $view->phim->ten_phim }}</div>

                                <!-- {{-- Badge TOP 1 --}}
                                @if($rank == 1)
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">TOP 1</span>
                                @endif -->
                            </a>
                        </div>
                        @endforeach
                        @else
                        {{-- Hiển thị thông báo hoặc placeholder nếu chưa có dữ liệu --}}
                        <p class="text-muted ms-3">Đang cập nhật bảng xếp hạng...</p>
                        @endif
                        {{-- KẾT THÚC VÒNG LẶP --}}
                    </div>

                    <button class="nav-btn nav-right" onclick="scrollAny('top10List', 'right')"><i class="bi bi-chevron-right"></i></button>
                </div>
            </div>
        </div>


        <h4 class="mb-3">Mới ra mắt</h4>

        <div class="slider-container mb-4">
            <button class="nav-btn nav-left" onclick="scrollAny('listMoi', 'left')"><i class="bi bi-chevron-left"></i></button>

            <div class="slider-list" id="listMoi">
                @foreach($phimMoi as $phim)
                <div class="standard-item">
                    <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none text-white">
                        <div class="card bg-dark text-white border-0 h-100">
                            <div class="position-relative poster-wrapper">
                                <img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}">
                                <span class="badge bg-primary position-absolute top-0 start-0 m-2">MỚI</span>
                                @if($phim->loai == 'phim_bo')
                                <span class="badge bg-dark position-absolute bottom-0 end-0 m-2 opacity-75">{{ $phim->so_tap }} Tập</span>
                                @endif
                            </div>
                            <div class="card-body p-2 text-center">
                                <h6 class="card-title text-truncate small mt-2 text-white">{{ $phim->ten_phim }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <button class="nav-btn nav-right" onclick="scrollAny('listMoi', 'right')"><i class="bi bi-chevron-right"></i></button>
        </div>


        <h4 class="mb-3 mt-4">Phim nổi bật</h4>
        <div class="slider-container mb-4">
            <button class="nav-btn nav-left" onclick="scrollAny('listNoiBat', 'left')"><i class="bi bi-chevron-left"></i></button>

            <div class="slider-list" id="listNoiBat">
                @foreach($phimNoiBat as $phim)
                <div class="standard-item">
                    <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none text-white">
                        <div class="card bg-dark text-white border-0 h-100">
                            <div class="position-relative poster-wrapper">
                                <img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}">
                                <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">NỔI BẬT</span>
                                @if($phim->loai == 'phim_bo')
                                <span class="badge bg-dark position-absolute bottom-0 end-0 m-2 opacity-75">{{ $phim->so_tap }} Tập</span>
                                @endif
                            </div>
                            <div class="card-body p-2 text-center">
                                <h6 class="card-title text-truncate small mt-2 text-white">{{ $phim->ten_phim }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <button class="nav-btn nav-right" onclick="scrollAny('listNoiBat', 'right')"><i class="bi bi-chevron-right"></i></button>
        </div>


        <h4 class="mb-3 mt-4">Phim HOT</h4>
        <div class="slider-container mb-4">
            <button class="nav-btn nav-left" onclick="scrollAny('listHot', 'left')"><i class="bi bi-chevron-left"></i></button>

            <div class="slider-list" id="listHot">
                @foreach($phimHot as $phim)
                <div class="standard-item">
                    <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none text-white">
                        <div class="card bg-dark text-white border-0 h-100">
                            <div class="position-relative poster-wrapper">
                                <img src="{{ asset($phim->anh_bia) }}" alt="{{ $phim->ten_phim }}">
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">HOT</span>
                                @if($phim->loai == 'phim_bo')
                                <span class="badge bg-dark position-absolute bottom-0 end-0 m-2 opacity-75">{{ $phim->so_tap }} Tập</span>
                                @endif
                            </div>
                            <div class="card-body p-2 text-center">
                                <h6 class="card-title text-truncate small mt-2 text-white">{{ $phim->ten_phim }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <button class="nav-btn nav-right" onclick="scrollAny('listHot', 'right')"><i class="bi bi-chevron-right"></i></button>
        </div>


        <h4 class="mb-3 mt-4">Phim </h4>
        <div class="slider-container mb-5">
            <button class="nav-btn nav-left" onclick="scrollAny('listKho', 'left')"><i class="bi bi-chevron-left"></i></button>

            <div class="slider-list" id="listKho">
                @foreach($phimbinhthuong as $phim)
                <div class="standard-item">
                    <a href="{{ route('xemphim', $phim->id) }}" class="text-decoration-none text-white">
                        <div class="card bg-dark text-white border-0 h-100">
                            <div class="position-relative poster-wrapper">
                                @php
                                $anhBia = $phim->anh_bia;
                                if (!Str::startsWith($anhBia, ['http://', 'https://'])) { $anhBia = asset($anhBia); }
                                @endphp

                                <img src="{{ $anhBia }}" alt="{{ $phim->ten_phim }}">
                                <span class="badge bg-light text-dark position-absolute top-0 start-0 m-2">Phim</span>
                                @if($phim->loai == 'phim_bo')
                                <span class="badge bg-dark position-absolute bottom-0 end-0 m-2 opacity-75">{{ $phim->so_tap }} Tập</span>
                                @endif
                            </div>
                            <div class="card-body p-2 text-center">
                                <h6 class="card-title text-truncate small mt-2 text-white">{{ $phim->ten_phim }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <button class="nav-btn nav-right" onclick="scrollAny('listKho', 'right')"><i class="bi bi-chevron-right"></i></button>
        </div>

    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // 1. Hàm xử lý nút bấm cuộn (Scroll 1 trang)
        function scrollAny(elementId, direction) {
            const container = document.getElementById(elementId);
            if (container) {
                // container.clientWidth = Độ rộng đang hiển thị của khung
                const scrollAmount = 500;

                if (direction === 'left') {
                    container.scrollLeft -= scrollAmount;
                } else {
                    container.scrollLeft += scrollAmount;
                }
            }
        }

        // 2. Tự động ẨN NÚT nếu không cần cuộn (ít phim)
        document.addEventListener("DOMContentLoaded", function() {
            checkScrollButtons(); // Chạy ngay khi tải trang
            window.addEventListener('resize', checkScrollButtons); // Chạy lại khi co giãn màn hình
        });

        function checkScrollButtons() {
            // Lấy tất cả các khung slider
            const sliders = document.querySelectorAll('.slider-container');

            sliders.forEach(slider => {
                const list = slider.querySelector('.slider-list');
                const leftBtn = slider.querySelector('.nav-left');
                const rightBtn = slider.querySelector('.nav-right');

                if (list && leftBtn && rightBtn) {
                    // So sánh: Độ rộng thực tế nội dung (scrollWidth) > Độ rộng khung nhìn (clientWidth)
                    if (list.scrollWidth > list.clientWidth) {
                        // Cần cuộn -> Hiện nút (để CSS xử lý hover)
                        leftBtn.style.display = 'flex';
                        rightBtn.style.display = 'flex';
                    } else {
                        // Không cần cuộn -> Ẩn hoàn toàn nút
                        leftBtn.style.display = 'none';
                        rightBtn.style.display = 'none';
                    }
                }
            });
        }
    </script>
</body>

</html>