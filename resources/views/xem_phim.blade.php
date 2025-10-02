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
            <!-- Khung video -->
            <div class="col-lg-9">
                <div class="video-wrapper">
                    <div class="ratio ratio-16x9 bg-dark rounded">
                        @if($phim->loai == 'phim_le')
                            @if($phim->video)
                                <video id="videoPlayer" controls autoplay muted playsinline poster="{{ asset($phim->anh_bia ?? '') }}">
                                    <source src="{{ asset($phim->video) }}" type="video/mp4">
                                    Trình duyệt không hỗ trợ phát video.
                                </video>
                            @else
                                <div class="text-center text-danger p-3">Chưa có video cho phim này.</div>
                            @endif
                        @else
                            @if($phim->taps->count() > 0)
                                <video id="videoPlayer" controls autoplay muted playsinline poster="{{ asset($phim->anh_bia ?? '') }}">
                                    <source src="{{ asset($phim->taps[0]->video) }}" type="video/mp4">
                                    Trình duyệt không hỗ trợ phát video.
                                </video>
                            @else
                                <div class="text-center text-danger p-3">Chưa có tập phim nào.</div>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Thông tin phim -->
                <div class="card mt-3 bg-dark text-light border-0">
                    <div class="card-body">
                        <h4 class="card-title">{{ $phim->ten_phim }} ({{ $phim->nam_phat_hanh ?? '' }})</h4>
                        <p class="card-text">{!! nl2br(e($phim->mo_ta)) !!}</p>
                    </div>
                </div>
            </div>

            <!-- Danh sách tập / trailer -->
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
                        <div class="episode-item" onclick="changeEpisode('{{ asset($phim->trailer) }}')">
                            <div class="thumb">
                                <img src="{{ asset($phim->anh_bia ?? 'default.jpg') }}" alt="Trailer">
                                <span class="time">Trailer</span>
                            </div>
                            <div class="info">🎬 Trailer</div>
                        </div>
                        @endif

                        {{-- Phim bộ hoặc phân đoạn --}}
                        @foreach($phim->taps as $tap)
                        <div class="episode-item" onclick="changeEpisode('{{ asset($tap->video) }}')">
                            <div class="thumb">
                                <img src="{{ asset($tap->thumbnail ?? $phim->anh_bia ?? 'default.jpg') }}" alt="Tập {{ $tap->tap }}">
                                <span class="time">{{ $tap->thoi_luong ?? '24 phút' }}</span>
                            </div>
                            <div class="info">{{ $tap->ten_tap ?? 'Tập ' . $tap->tap }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('footer')

    <script>
        function changeEpisode(link) {
            let video = document.getElementById("videoPlayer");
            let source = video.querySelector("source");
            source.src = link;
            video.load();
            video.play();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
