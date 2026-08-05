<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gợi Ý Phim - User {{ $userId }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        main {
            flex: 1;
        }
        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 8px;
        }
        .watched-card {
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.25s ease-in-out;
            background: #ffffff;
            border: 2px solid #e2e8f0;
        }
        .watched-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
            border-color: #0d6efd;
        }
        .watched-card.active {
            border-color: #0d6efd;
            background-color: #f0f7ff;
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.25) !important;
        }
        .watched-card .badge-active {
            display: none;
        }
        .watched-card.active .badge-active {
            display: inline-block;
        }
        .recommend-card {
            border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .recommend-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }
        .poster-img {
            height: 160px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
        .placeholder-poster {
            height: 100px;
            background: linear-gradient(135deg, #1e293b, #334155);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px 8px 0 0;
            font-size: 2.5rem;
        }
    </style>
</head>
<body>
    @include('header')

    <main class="container my-5">

        <!-- THÔNG TIN PHIM ĐÃ XEM CỦA USER -->
        <section class="mb-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark section-title">
                    📺 DANH SÁCH PHIM USER #{{ $userId }} ĐANG / ĐÃ XEM
                </h3>
                <p class="text-muted fs-6">
                    Nhấp vào một bộ phim bên dưới để xem các phim gợi ý phù hợp nhất cho phim đó!
                </p>
            </div>

            @if(!empty($watched) && count($watched) > 0)
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3 justify-content-center">
                    @foreach($watched as $index => $item)
                        <div class="col">
                            <div class="card watched-card shadow-sm h-100 {{ $index === 0 ? 'active' : '' }}" 
                                 onclick="selectWatchedMovie(this, '{{ addslashes($item['title']) }}')">
                                @if(!empty($item['anh_bia']))
                                    <img src="{{ asset($item['anh_bia']) }}" class="card-img-top poster-img" alt="{{ $item['title'] }}"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="placeholder-poster" style="display: none;">🎬</div>
                                @else
                                    <div class="placeholder-poster">🎬</div>
                                @endif
                                <div class="card-body p-2 text-center d-flex flex-column justify-content-between">
                                    <h6 class="card-title text-dark fw-bold mb-1 fs-7 text-truncate" title="{{ $item['title'] }}">
                                        {{ $item['title'] }}
                                    </h6>
                                    <div>
                                        <span class="badge bg-primary badge-active mt-1">
                                            <i class="bi bi-check-circle-fill"></i> Đang xem gợi ý
                                        </span>
                                        <span class="badge bg-light text-secondary border mt-1">
                                            <i class="bi bi-eye-fill me-1"></i> Đã xem
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-secondary text-center" role="alert">
                    Chưa có lịch sử phim đã xem cho User này.
                </div>
            @endif
        </section>

        <hr class="my-5 opacity-25">

        <!-- THÔNG TIN GỢI Ý PHIM -->
        <section id="recommendation-section">
            <h2 class="text-center mb-4 fw-bold text-dark" id="recommendation-header">
                🎯 TOP 3 PHIM GỢI Ý <span id="recommend-target-title" class="text-primary">CHO USER #{{ $userId }}</span>
            </h2>

            <div id="recommendation-container">
                @if(!empty($recommendations) && count($recommendations) > 0)
                    <div class="row justify-content-center" id="recommendation-cards-row">
                        @foreach($recommendations as $index => $movie)
                            <div class="col-md-4 mb-4">
                                <div class="card recommend-card shadow border-0 h-100">
                                    <div class="card-header bg-dark text-white text-center py-3">
                                        <h4 class="mb-0">
                                            @if($index == 0)
                                                🥇 GỢI Ý 1
                                            @elseif($index == 1)
                                                🥈 GỢI Ý 2
                                            @else
                                                🥉 GỢI Ý 3
                                            @endif
                                        </h4>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title fw-bold text-primary mb-3">
                                                🎬 {{ $movie['title'] ?? 'Phim Chưa Đặt Tên' }}
                                            </h5>
                                            <p class="card-text mb-2">
                                                ⭐ <strong>Score:</strong> {{ $movie['score'] ?? 'N/A' }}
                                            </p>
                                            @if(isset($movie['confidence']))
                                            <p class="card-text mb-2 text-success">
                                                📈 <strong>Confidence:</strong> {{ $movie['confidence'] }}%
                                            </p>
                                            @endif
                                            @if(isset($movie['lift']))
                                            <p class="card-text mb-2 text-info">
                                                🚀 <strong>Lift:</strong> {{ $movie['lift'] }}
                                            </p>
                                            @endif
                                        </div>
                                        @if(isset($movie['id']) && $movie['id'])
                                        <a href="{{ route('xemphim', $movie['id']) }}" class="btn btn-outline-primary mt-3 w-100">
                                            Xem Phim Ngay
                                        </a>
                                        @else
                                        <a href="{{ route('page.timkiem', ['query' => $movie['title'] ?? '']) }}" class="btn btn-outline-primary mt-3 w-100">
                                            Tìm Phim Này
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning text-center" role="alert" id="no-recommendation-alert">
                        Hiện chưa có dữ liệu gợi ý cho người dùng này.
                    </div>
                @endif
            </div>
        </section>

    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dữ liệu gợi ý riêng cho từng phim (truyền từ Controller)
        const movieRecommendations = @json($movieRecommendations ?? []);
        const defaultRecommendations = @json($recommendations ?? []);
        const userId = @json($userId);

        function selectWatchedMovie(element, movieTitle) {
            // Đổi active card
            document.querySelectorAll('.watched-card').forEach(card => card.classList.remove('active'));
            if (element) {
                element.classList.add('active');
            }

            // Cập nhật tiêu đề gợi ý
            const targetTitleEl = document.getElementById('recommend-target-title');
            if (targetTitleEl) {
                targetTitleEl.innerText = `KHI XEM "${movieTitle}"`;
            }

            // Lấy danh sách gợi ý cho phim đã chọn
            let recs = movieRecommendations[movieTitle] || defaultRecommendations;
            renderRecommendations(recs);

            // Cuộn mượt tới phần gợi ý
            document.getElementById('recommendation-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function renderRecommendations(recs) {
            const container = document.getElementById('recommendation-container');
            if (!recs || recs.length === 0) {
                container.innerHTML = `
                    <div class="alert alert-warning text-center" role="alert">
                        Chưa có phim gợi ý cụ thể dựa trên bộ phim này.
                    </div>
                `;
                return;
            }

            let html = '<div class="row justify-content-center" id="recommendation-cards-row">';
            recs.forEach((movie, index) => {
                let medal = index === 0 ? '🥇 GỢI Ý 1' : (index === 1 ? '🥈 GỢI Ý 2' : '🥉 GỢI Ý 3');
                let score = movie.score !== undefined ? movie.score : 'N/A';
                let confidence = movie.confidence !== undefined ? `${movie.confidence}%` : null;
                let lift = movie.lift !== undefined ? movie.lift : null;
                let xemUrl = movie.id ? `/xem-phim/${movie.id}` : `/tim-kiem?query=${encodeURIComponent(movie.title)}`;
                let btnText = movie.id ? 'Xem Phim Ngay' : 'Tìm Phim Này';

                html += `
                    <div class="col-md-4 mb-4">
                        <div class="card recommend-card shadow border-0 h-100">
                            <div class="card-header bg-dark text-white text-center py-3">
                                <h4 class="mb-0">${medal}</h4>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold text-primary mb-3">
                                        🎬 ${movie.title}
                                    </h5>
                                    <p class="card-text mb-2">
                                        ⭐ <strong>Score:</strong> ${score}
                                    </p>
                                    ${confidence ? `<p class="card-text mb-2 text-success">📈 <strong>Confidence:</strong> ${confidence}</p>` : ''}
                                    ${lift ? `<p class="card-text mb-2 text-info">🚀 <strong>Lift:</strong> ${lift}</p>` : ''}
                                </div>
                                <a href="${xemUrl}" class="btn btn-outline-primary mt-3 w-100">
                                    ${btnText}
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            });
            html += '</div>';

            container.innerHTML = html;
        }

        // Tự động kích hoạt phim đầu tiên trong danh sách nếu có
        document.addEventListener("DOMContentLoaded", function () {
            const firstActive = document.querySelector('.watched-card.active');
            if (firstActive) {
                const title = firstActive.getAttribute('onclick')?.match(/'([^']+)'/)?.[1];
                if (title && movieRecommendations[title]) {
                    selectWatchedMovie(firstActive, title);
                }
            }
        });
    </script>
</body>
</html>