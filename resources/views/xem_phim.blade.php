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
    </style>
</head>

<body>
    @include('header')

    <main class="container my-4">
        <div class="row">
            <div class="col-lg-9">
                <div class="video-wrapper">
                    {{-- SỬA Ở ĐÂY: Thêm ID cho container để JS có thể tìm thấy --}}
                    <div id="video-player-container" class="ratio ratio-16x9 bg-dark rounded">
                        {{-- Logic hiển thị video ban đầu --}}
                        @php
                        $initialVideoSrc = '';
                        if ($phim->loai == 'phim_le' && $phim->video) {
                        $initialVideoSrc = asset($phim->video);
                        } elseif ($phim->loai == 'phim_bo' && $phim->taps->count() > 0 && $phim->taps->first()->video) {
                        $initialVideoSrc = asset($phim->taps->first()->video);
                        }
                        @endphp

                        @if($initialVideoSrc)
                        <video controls autoplay muted playsinline poster="{{ asset($phim->anh_bia ?? '') }}" style="width: 100%; height: 100%;">
                            <source src="{{ $initialVideoSrc }}" type="video/mp4">
                            Trình duyệt không hỗ trợ phát video.
                        </video>
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

                        {{-- Danh sách tập phim bộ --}}

                        {{-- Kiểm tra xem phim có nhiều hơn 1 tập và có danh sách tập không --}}
                        @if(isset($phim->so_tap) && $phim->so_tap > 1 && $phim->taps->isNotEmpty())

                        {{-- === XỬ LÝ CHO PHIM BỘ === --}}
                        @foreach($phim->taps as $tap)
                        @if($tap->video) {{-- Chỉ hiển thị những tập đã có video --}}
                        <div class="episode-item" onclick="changeEpisode('{{ asset($tap->video) }}')">
                            <div class="thumb">
                                <img src="{{ asset($tap->thumbnail ?? $phim->anh_bia ?? 'default.jpg') }}" alt="Tập {{ $tap->tap }}">
                                <span class="time">{{ $tap->thoi_luong ?? '24 phút' }}</span>
                            </div>
                            <div class="info">{{ $tap->ten_tap ?? 'Tập ' . $tap->tap }}</div>
                        </div>
                        @endif
                        @endforeach

                        @else

                        {{-- === XỬ LÝ CHO PHIM LẺ === --}}
                        @if($phim->video) {{-- Chỉ hiển thị nếu phim lẻ có video --}}
                        <div class="episode-item active" onclick="changeEpisode('{{ asset($phim->video) }}')">
                            <div class="thumb">
                                <img src="{{ asset($phim->anh_bia ?? 'default.jpg') }}" alt="{{ $phim->ten_phim }}">
                                <span class="time">{{ $phim->thoi_luong ?? '90 phút' }}</span>
                            </div>
                            <div class="info">Full </div>
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

            } else if (isDirectVideoLink) {
                // TRƯỜNG HỢP 3: LÀ LINK FILE VIDEO TRỰC TIẾP (.MP4, .WEBM, ...)
                playerHtml = `
                <video controls autoplay muted playsinline poster="{{ asset($phim->anh_bia ?? '') }}" style="width: 100%; height: 100%;">
                    <source src="${url}" type="video/mp4">
                    Trình duyệt không hỗ trợ phát video.
                </video>`;
            } else {
                // TRƯỜNG HỢP 4: LÀ FILE BẠN UPLOAD (không có http) hoặc một URL không xác định
                // Đối với file upload, hàm asset() đã tạo ra đường dẫn đúng
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
</body>

</html>