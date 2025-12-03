@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem phim - {{ $phim->ten_phim ?? 'Chi tiết phim' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        .video-wrapper {
            max-width: 100%;
        }

        .episode-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            cursor: pointer;
            background: #111;
            border-bottom: 1px solid #222;
            transition: background 0.3s;
        }

        .episode-item:hover {
            background: #1a1a1a;
        }

        .episode-item .thumb {
            position: relative;
            width: 100px;
            height: 56px;
            flex-shrink: 0;
        }

        .episode-item .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .episode-item .thumb .time {
            position: absolute;
            bottom: 4px;
            right: 4px;
            background: rgba(0, 0, 0, 0.7);
            padding: 2px 6px;
            font-size: 12px;
            border-radius: 4px;
        }

        .episode-item .info {
            font-size: 15px;
            color: #fff;
            font-weight: 500;
        }

        /* Tùy chỉnh thanh cuộn ngang */
        .movie-scroll-container {
            overflow-x: auto;
            scroll-behavior: smooth;
            /* Ẩn thanh cuộn trên Firefox */
            scrollbar-width: none;
        }

        /* Ẩn thanh cuộn trên Chrome/Safari/Edge */
        .movie-scroll-container::-webkit-scrollbar {
            display: none;
        }

        /* Style cho Card phim */
        .movie-card {
            width: 260px;
            flex: 0 0 auto;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-right: 15px;
        }

        .movie-card:hover {
            transform: scale(1.05);
            /* Hiệu ứng phóng to nhẹ khi di chuột */
            z-index: 10;
        }

        .movie-thumbnail {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            aspect-ratio: 16/9;
            width: 100%;
            background: #222;
        }

        .movie-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Icon viên đá quý (VIP/Premium) */
        .vip-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.5);
            /* Nền mờ nhẹ */
            padding: 2px 6px;
            border-radius: 4px;
        }

        .bi-gem {
            color: #ff3d00;
            /* Màu cam đỏ giống trong ảnh */
            text-shadow: 0 0 5px #ff3d00;
        }

        /* Nút mũi tên điều hướng */
        .scroll-btn {
            background: rgba(20, 20, 20, 0.8);
            border: none;
            color: white;
            width: 40px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .scroll-btn:hover {
            background: rgba(50, 50, 50, 0.9);
        }

        /* Gradient mờ bên phải để tạo cảm giác list còn dài */
        /* fade overlays (left + right) */
        .fade-right,
        .fade-left {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100px;
            pointer-events: none;
            z-index: 2;
            transition: opacity .18s ease;
            opacity: 0;
        }

        .fade-right {
            right: 0;
            background: linear-gradient(to right, transparent, #121212);
        }

        .fade-left {
            left: 0;
            background: linear-gradient(to left, transparent, #121212);
        }
    </style>
</head>

<body>
    @include('header')

    <main class="container my-4">
        <div class="row">
            <div class="col-lg-9">
                <div class="video-wrapper">
                    <div id="video-player-container" class="ratio ratio-16x9 bg-dark rounded">
                        @php
                        $initialVideoSrc = '';
                        $isUrl = false; // thêm biến kiểm tra URL

                        if ($phim->loai == 'phim_le' && $phim->video) {
                        $initialVideoSrc = $phim->video;
                        } elseif ($phim->loai == 'phim_bo' && $phim->taps->count() > 0 && $phim->taps->first()->video) {
                        $initialVideoSrc = $phim->taps->first()->video;
                        }

                        // Kiểm tra xem có phải là URL ngoài không
                        if (Str::startsWith($initialVideoSrc, ['http://', 'https://'])) {
                        $isUrl = true;
                        } else {
                        $initialVideoSrc = asset($initialVideoSrc); // nếu không phải URL ngoài → dùng asset()
                        }
                        @endphp

                        @if($initialVideoSrc)
                        @if($isUrl)
                        {{-- Trường hợp là URL (YouTube, Drive, v.v.) --}}
                        <iframe src="{{ $initialVideoSrc }}"
                            class="w-100 h-100 rounded border-0"
                            allowfullscreen></iframe>
                        @else
                        {{-- Trường hợp là file video trong hệ thống --}}
                        <video controls autoplay muted playsinline
                            poster="{{ asset($phim->anh_bia ?? '') }}"
                            style="width: 100%; height: 100%;">
                            <source src="{{ $initialVideoSrc }}" type="video/mp4">
                            Trình duyệt không hỗ trợ phát video.
                        </video>
                        @endif
                        @else
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <p class="text-danger">Chưa có video cho phim này.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card mt-3 bg-dark text-light border-0">
                    <div class="card-body">
                        <h4 class="card-title">{{ $phim->ten_phim }} ({{ $phim->nam_phat_hanh ?? '' }})</h4>
                        <p class="card-text">{!! nl2br(e($phim->mo_ta)) !!}</p>
                    </div>
                </div>

                <!-- nội dung liên quan  -->
                <div class="container-fluid py-4">
                    <h4 class="mb-3 fw-bold">Nội dung liên quan</h4>

                    <div class="position-relative group-slider">

                        <button class="scroll-btn position-absolute start-0 top-50 translate-middle-y z-3 rounded-end"
                            onclick="scrollList(-1)" type="button">
                            <i class="bi bi-chevron-left fs-4"></i>
                        </button>

                        {{-- SỬA LẠI: Chỉ giữ 1 thẻ div có id="movieList" ở đây --}}
                        <div class="d-flex flex-nowrap gap-3 movie-scroll-container py-2" id="movieList">

                            @if(isset($phimLienQuan) && count($phimLienQuan) > 0)
                            @foreach($phimLienQuan as $item)
                            <a href="{{ route('xemphim', $item->id) }}" class="text-decoration-none">

                                <div class="movie-card" title="{{ $item->ten_phim }}">
                                    <div class="movie-thumbnail">
                                        <img src="{{ asset($item->anh_bia) }}"
                                            alt="{{ $item->ten_phim }}"
                                            onerror="this.src='https://placehold.co/300x170?text=No+Image'">

                                        {{-- @if($item->vip) <div class="vip-badge"><i class="bi bi-gem"></i></div> @endif --}}
                                    </div>

                                    <div class="mt-2">
                                        <h6 class="mb-0 text-white fw-bold text-truncate" style="max-width: 260px;">
                                            {{ $item->ten_phim }}
                                        </h6>
                                    </div>
                                </div>

                            </a>
                            @endforeach
                            @else
                            <div class="text-white-50 p-3">Chưa có phim cùng thể loại.</div>
                            @endif

                        </div>
                        {{-- Kết thúc thẻ div #movieList --}}

                        <div class="fade-left"></div>
                        <div class="fade-right"></div>

                        <button class="scroll-btn position-absolute end-0 top-50 translate-middle-y z-3 rounded-start"
                            onclick="scrollList(1)">
                            <i class="bi bi-chevron-right fs-4"></i>
                        </button>

                    </div>
                </div>

            </div>

            <div class="col-lg-3">
                <div class="card bg-dark text-light border-0">
                    <div class="card-header fw-bold">
                        @if($phim->loai == 'phim_le')
                        Trailer & Video
                        @else
                        Danh sách phát
                        @endif
                    </div>

                    <div class="list-group list-group-flush">
                        {{-- Trailer (nếu có) --}}
                        @if($phim->trailer)
                        @php
                        // Xử lý link trailer: Nếu là link ngoài thì giữ nguyên, nếu là file thì dùng asset()
                        $trailerSrc = Str::startsWith($phim->trailer, ['http://', 'https://']) ? $phim->trailer : asset($phim->trailer);
                        @endphp
                        <div class="episode-item" onclick="changeEpisode('{{ $trailerSrc }}')">
                            <div class="thumb">
                                <img src="{{ asset($phim->anh_bia ?? 'default.jpg') }}" alt="Trailer">
                                <span class="time">Trailer</span>
                            </div>
                            <div class="info">🎬 Trailer</div>
                        </div>
                        @endif

                        {{-- Danh sách tập phim --}}
                        @if($phim->loai == 'phim_bo' && $phim->taps->isNotEmpty())

                        {{-- === XỬ LÝ CHO PHIM BỘ === --}}
                        @foreach($phim->taps as $tap)
                        @if($tap->video) {{-- Chỉ hiển thị những tập đã có video --}}
                        @php
                        // SỬA LỖI Ở ĐÂY: Kiểm tra link là URL ngoài hay file local
                        $videoSrc = Str::startsWith($tap->video, ['http://', 'https://']) ? $tap->video : asset($tap->video);
                        @endphp
                        <div class="episode-item" onclick="changeEpisode('{{ $videoSrc }}')">
                            <div class="thumb">
                                <img src="{{ asset($tap->thumbnail ?? $phim->anh_bia ?? 'default.jpg') }}" alt="Tập {{ $tap->tap }}">
                                <span class="time">{{ $tap->thoi_luong ?? '24 phút' }}</span>
                            </div>
                            <div class="info">{{ $tap->ten_tap ?? 'Tập ' . $tap->tap }}</div>
                        </div>
                        @endif
                        @endforeach

                        @elseif($phim->loai == 'phim_le')

                        {{-- === XỬ LÝ CHO PHIM LẺ === --}}
                        @if($phim->video) {{-- Chỉ hiển thị nếu phim lẻ có video --}}
                        @php
                        // SỬA LỖI Ở ĐÂY: Kiểm tra link là URL ngoài hay file local
                        $videoSrc = Str::startsWith($phim->video, ['http://', 'https://']) ? $phim->video : asset($phim->video);
                        @endphp
                        <div class="episode-item active" onclick="changeEpisode('{{ $videoSrc }}')">
                            <div class="thumb">
                                <img src="{{ asset($phim->anh_bia ?? 'default.jpg') }}" alt="{{ $phim->ten_phim }}">
                                <span class="time">{{ $phim->thoi_luong ?? '90 phút' }}</span>
                            </div>
                            <div class="info">Full</div>
                        </div>
                        @endif

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('footer')
    <script>
        function changeEpisode(url) {
            const videoContainer = document.getElementById('video-player-container');
            let playerHtml = '';

            // Biểu thức chính quy để tìm ID video từ các nền tảng phổ biến
            const youtubePattern = /(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
            const vimeoPattern = /vimeo\.com\/(?:video\/)?([0-9]+)/;

            const youtubeMatch = url.match(youtubePattern);
            const vimeoMatch = url.match(vimeoPattern);

            // Kiểm tra xem có phải link file video trực tiếp không (mp4, webm, ogg)
            const isDirectVideoLink = url.endsWith('.mp4') || url.endsWith('.webm') || url.endsWith('.ogg');

            if (youtubeMatch) {
                // TRƯỜNG HỢP 1: LÀ LINK YOUTUBE
                const videoId = youtubeMatch[1];
                const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
                playerHtml = `<iframe src="${embedUrl}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%;"></iframe>`;

            } else if (vimeoMatch) {
                // TRƯỜNG HỢP 2: LÀ LINK VIMEO
                const videoId = vimeoMatch[1];
                const embedUrl = `https://player.vimeo.com/video/${videoId}?autoplay=1`;
                playerHtml = `<iframe src="${embedUrl}" title="Vimeo video player" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="width: 100%; height: 100%;"></iframe>`;

            } else if (isDirectVideoLink || url.startsWith('http')) {
                // TRƯỜNG HỢP 3: LÀ LINK FILE VIDEO TRỰC TIẾP hoặc URL nhúng iframe khác (Google Drive)
                if (url.includes("drive.google.com")) {
                    // Xử lý link Google Drive để nhúng
                    url = url.replace("/view", "/preview");
                }

                // Nếu là URL trực tiếp, dùng iframe để tránh các vấn đề về CORS nếu có thể
                if (!isDirectVideoLink && !url.endsWith('.m3u8')) {
                    playerHtml = `<iframe src="${url}" frameborder="0" allowfullscreen style="width: 100%; height: 100%;"></iframe>`;
                } else {
                    // Nếu là link file video thì dùng thẻ <video>
                    playerHtml = `
                    <video controls autoplay muted playsinline poster="{{ asset($phim->anh_bia ?? '') }}" style="width: 100%; height: 100%;">
                        <source src="${url}" type="video/mp4">
                        Trình duyệt không hỗ trợ phát video.
                    </video>`;
                }
            } else {
                // TRƯỜNG HỢP 4: LÀ FILE BẠN UPLOAD (đã được xử lý bởi hàm asset() trong Blade)
                playerHtml = `
                <video controls autoplay muted playsinline poster="{{ asset($phim->anh_bia ?? '') }}" style="width: 100%; height: 100%;">
                    <source src="${url}" type="video/mp4">
                    Trình duyệt không hỗ trợ phát video.
                </video>`;
            }

            // Thay thế nội dung của container bằng trình phát phù hợp
            videoContainer.innerHTML = playerHtml;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function scrollList(direction) {
            const container = document.getElementById('movieList');
            const scrollAmount = 300;
            if (!container) return;
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
            setTimeout(updateFades, 220); // cập nhật sau khi animation smooth kết thúc
        }

        function updateFades() {
            const container = document.getElementById('movieList');
            const fadeLeft = document.querySelector('.fade-left');
            const fadeRight = document.querySelector('.fade-right');
            if (!container || !fadeLeft || !fadeRight) return;

            const maxScrollLeft = container.scrollWidth - container.clientWidth;
            const current = container.scrollLeft;

            fadeLeft.style.opacity = (current > 10) ? '1' : '0';
            fadeRight.style.opacity = (current < maxScrollLeft - 10) ? '1' : '0';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('movieList');
            if (!container) return;
            updateFades(); // lúc load
            container.addEventListener('scroll', updateFades, {
                passive: true
            });
            window.addEventListener('resize', () => {
                clearTimeout(window._r);
                window._r = setTimeout(updateFades, 120);
            });
        });
    </script>
</body>

</html>