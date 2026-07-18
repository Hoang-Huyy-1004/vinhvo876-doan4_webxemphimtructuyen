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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/top10.css') }}">

    <style>
        /* --- CẤU TRÚC CHÍNH --- */
        body {
            background-color: #0a0a0a;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            color: #fff;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 40px 20px;
            gap: 50px;
        }

        /* --- THANH TÌM KIẾM (SEARCH BAR) --- */
        .search-container-relative {
            position: relative;
            /* Để định vị khung kết quả bên dưới */
            width: 100%;
            max-width: 800px;
            z-index: 1000;
        }

        .search-wrapper {
            background-color: #1a1a1a;
            border-radius: 50px;
            padding: 8px 10px 8px 25px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            border: 1px solid #333;
        }

        .search-icon {
            color: #888;
            font-size: 1.4rem;
            margin-right: 15px;
        }

        .search-input {
            background: transparent;
            border: none;
            color: #fff;
            flex-grow: 1;
            outline: none;
            font-size: 1.1rem;
        }

        .search-input::placeholder {
            color: #555;
        }

        .btn-search-custom {
            background-color: #333;
            color: #ccc;
            border-radius: 40px;
            padding: 10px 30px;
            border: none;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-search-custom:hover {
            background-color: #ff6600;
            color: white;
        }

        /* --- KHUNG KẾT QUẢ TÌM KIẾM (DROPDOWN) - GIỐNG ẢNH --- */
        #search-results {
            position: absolute;
            top: 100%;
            /* Nằm ngay dưới thanh tìm kiếm */
            left: 0;
            width: 100%;
            background-color: #181818;
            /* Màu nền tối xám */
            border: 1px solid #333;
            border-radius: 12px;
            margin-top: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8);
            display: none;
            /* Mặc định ẩn */
            overflow: hidden;
        }

        /* Dòng thông báo kết quả */
        .result-header {
            padding: 12px 15px;
            font-size: 0.9rem;
            color: #888;
            border-bottom: 1px solid #2a2a2a;
        }

        /* Danh sách cuộn */
        .result-list {
            max-height: 450px;
            /* Chiều cao tối đa trước khi hiện scrollbar */
            overflow-y: auto;
        }

        /* Tùy chỉnh thanh cuộn (Scrollbar) cho giống ảnh */
        .result-list::-webkit-scrollbar {
            width: 8px;
        }

        .result-list::-webkit-scrollbar-track {
            background: #181818;
        }

        .result-list::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 4px;
        }

        .result-list::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Từng dòng phim */
        .result-item {
            display: flex;
            padding: 12px 15px;
            border-bottom: 1px solid #2a2a2a;
            text-decoration: none;
            transition: background 0.2s;
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .result-item:hover {
            background-color: #252525;
        }

        /* Ảnh poster nhỏ bên trái */
        .ri-img {
            width: 60px;
            height: 85px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        /* Phần nội dung bên phải */
        .ri-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .ri-title {
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .ri-meta {
            color: #aaa;
            font-size: 0.85rem;
            margin-bottom: 6px;
        }

        .ri-badges {
            display: flex;
            gap: 5px;
            font-size: 0.75rem;
        }

        .ri-badge {
            background-color: #333;
            color: #ccc;
            padding: 2px 6px;
            border-radius: 4px;
        }

        /* --- CSS TOP 10 CŨ (GIỮ NGUYÊN) --- */
        .top10-container-custom {
            width: 100%;
            max-width: 1400px;
        }

        .top10-title-heading {
            color: white !important;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body>

    @include('header')

    <div class="main-content">

        <form action="" method="GET" class="w-100 d-flex justify-content-center mt-4">
            <div class="search-container-relative">

                <div class="search-wrapper">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="keyword" name="keyword" class="search-input"
                        placeholder="Tìm kiếm nội dung giải trí..." autocomplete="off">
                    <button type="submit" class="btn-search-custom">Tìm kiếm</button>
                </div>

                <div id="search-results">
                    <div class="result-header" id="result-count">
                        Gõ từ khóa để tìm kiếm...
                    </div>

                    <div class="result-list" id="result-list-content">
                    </div>
                </div>

            </div>
        </form>

        <div class="top10-container-custom mt-5">
            <h4 class="mb-4 fw-bold top10-title-heading">
                <i class="bi bi-fire text-danger"></i> Top 10 Phim Xu Hướng
            </h4>

            <div class="slider-container position-relative">
                <button class="nav-btn nav-left" onclick="scrollAny('top10List', 'left')"><i class="bi bi-chevron-left"></i></button>

                <div class="slider-list" id="top10List">
                    @if(isset($top10) && $top10->count() > 0)
                    @foreach($top10 as $index => $view)
                    @php
                    if (!$view->phim) continue;
                    $anhBia = $view->phim->anh_bia;
                    if (!Str::startsWith($anhBia, ['http://', 'https://'])) { $anhBia = asset($anhBia); }
                    $gradClass = 't-grad-' . ($index % 5);
                    $rank = $index + 1;
                    @endphp
                    <div class="top10-item">
                        <a href="{{ route('xemphim', $view->phim->id) }}" class="text-white text-decoration-none">
                            <img src="{{ $anhBia }}" class="top10-poster">
                            <div class="top10-overlay {{ $gradClass }}"></div>
                            <div class="top10-rank" data-rank="{{ $rank }}">{{ $rank }}</div>
                            <div class="top10-title text-truncate">{{ $view->phim->ten_phim }}</div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>

                <button class="nav-btn nav-right" onclick="scrollAny('top10List', 'right')"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            let timer;

            $('#keyword').on('input', function() {
                let query = $(this).val().trim();

                // Xóa timer cũ (Debounce: đợi người dùng dừng gõ 300ms mới tìm)
                clearTimeout(timer);

                if (query.length === 0) {
                    $('#search-results').hide();
                    return;
                }

                timer = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('ajax.search') }}",
                        method: "GET",
                        data: {
                            keyword: query
                        },
                        success: function(response) {
                            let html = '';

                            // Cập nhật dòng header: "Hiển thị X / Y kết quả..."
                            if (response.count > 0) {
                                $('#result-count').text(`Hiển thị ${response.count} / ${response.total} kết quả cho "${query}"`);

                                // Tạo danh sách HTML
                                response.data.forEach(movie => {
                                    html += `
                                        <a href="${movie.url}" class="result-item">
                                            <img src="${movie.anh_bia}" class="ri-img" alt="${movie.ten_phim}">
                                            <div class="ri-content">
                                                <div class="ri-title">${movie.ten_phim}</div>
                                                <div class="ri-meta">${movie.ten_phim} • ${movie.nam_san_xuat}</div>
                                                <div class="ri-badges">
                                                    <span class="ri-badge">${movie.chat_luong}</span>
                                                    <span class="ri-badge">${movie.trang_thai_text} (${movie.tap_hien_tai})</span>
                                                </div>
                                            </div>
                                        </a>
                                    `;
                                });

                                $('#result-list-content').html(html);
                                $('#search-results').show();
                            } else {
                                $('#result-count').text(`Không tìm thấy kết quả nào cho "${query}"`);
                                $('#result-list-content').html(''); // Xóa danh sách
                                $('#search-results').show();
                            }
                        }
                    });
                }, 300); // Delay 300ms
            });

            // Click ra ngoài thì ẩn bảng kết quả
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-container-relative').length) {
                    $('#search-results').hide();
                }
            });
        });

        // Script Scroll Top 10 (Cũ)
        function scrollAny(elementId, direction) {
            const container = document.getElementById(elementId);
            if (container) {
                const scrollAmount = 500;
                container.scrollLeft += (direction === 'left' ? -scrollAmount : scrollAmount);
            }
        }
    </script>
</body>

</html>