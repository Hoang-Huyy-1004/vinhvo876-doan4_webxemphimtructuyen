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

        .movie-info {
            background: #111;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        /* 👇 Khung video thu nhỏ và căn giữa khi là phim lẻ */
        .video-wrapper {
            max-width: 80%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    @include('header')

    <main class="container my-4">
        <div class="row">
            <!-- Khung video -->
            <div class="@if($phim->loai == 'phim_le') col-lg-12 @else col-lg-9 @endif">
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

            <!-- Danh sách tập (chỉ hiện với phim bộ) -->
            @if($phim->loai == 'bo' && $phim->taps->count() > 0)
            <div class="col-lg-3">
                <div class="card bg-dark text-light border-0">
                    <div class="card-header">Danh sách tập</div>
                    <ul class="list-group list-group-flush">
                        @foreach($phim->taps as $tap)
                        <li class="list-group-item bg-dark text-light">
                            <button class="btn btn-link text-light text-decoration-none p-0 w-100 text-start"
                                onclick="changeEpisode('{{ asset($tap->video) }}')">
                                {{ $tap->ten_tap ?? 'Tập ' . $tap->tap }}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>

    </main>

    @include('footer')

    <script>
        function changeEpisode(link) {
            let video = document.getElementById("videoPlayer");
            let source = video.querySelector("source");
            source.src = link;
            video.load();
            video.play(); // tự động phát khi đổi tập
        }

        // 👇 Nếu là phim bộ, tự động phát tập đầu khi load trang
        document.addEventListener("DOMContentLoaded", function () {
            let video = document.getElementById("videoPlayer");
            if (video) {
                video.play().catch(err => {
                    console.log("Autoplay bị chặn bởi trình duyệt:", err);
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
