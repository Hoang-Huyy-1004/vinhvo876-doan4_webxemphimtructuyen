<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gợi Ý Phim - {{ $userName ?? 'Dành Cho Bạn' }}</title>
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
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .recommend-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(13, 110, 253, 0.15) !important;
            border-color: rgba(13, 110, 253, 0.3);
        }
        .rec-header-1 {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #ffffff;
        }
        .rec-header-2 {
            background: linear-gradient(135deg, #0284c7, #0369a1);
            color: #ffffff;
        }
        .rec-header-3 {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #ffffff;
        }
        .rec-poster-container {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #0f172a;
        }
        .rec-poster-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .recommend-card:hover .rec-poster-img {
            transform: scale(1.06);
        }
        .rec-rating-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fef3c7;
            color: #92400e;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.88rem;
        }
        .poster-img {
            height: 160px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
        .placeholder-poster {
            height: 100%;
            min-height: 140px;
            background: linear-gradient(135deg, #1e293b, #334155);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
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
                <h3 class="fw-bold text-dark section-title text-uppercase">
                    📺 DANH SÁCH PHIM <span class="text-primary">{{ $userName }}</span> ĐANG / ĐÃ XEM
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
                                 data-movie-title="{{ $item['title'] }}"
                                 style="cursor: pointer;">
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
                    Chưa có lịch sử phim đã xem cho {{ $userName }}.
                </div>
            @endif
        </section>

        <hr class="my-5 opacity-25">

        <!-- THÔNG TIN GỢI Ý PHIM -->
        <section id="recommendation-section">
            <h2 class="text-center mb-4 fw-bold text-dark" id="recommendation-header">
                🎯 TOP 3 PHIM GỢI Ý <span id="recommend-target-title" class="text-primary">DÀNH CHO {{ strtoupper($userName) }}</span>
            </h2>

            <div id="recommendation-container">
                @if(!empty($recommendations) && count($recommendations) > 0)
                    <div class="row justify-content-center" id="recommendation-cards-row">
                        @foreach($recommendations as $index => $movie)
                            <div class="col-md-4 mb-4">
                                <div class="card recommend-card shadow-sm h-100">
                                    <div class="card-header {{ $index == 0 ? 'rec-header-1' : ($index == 1 ? 'rec-header-2' : 'rec-header-3') }} text-center py-3 border-0">
                                        <h5 class="mb-0 fw-bold">
                                            @if($index == 0)
                                                🥇 GỢI Ý HÀNG ĐẦU
                                            @elseif($index == 1)
                                                🥈 GỢI Ý PHÙ HỢP
                                            @else
                                                🥉 CŨNG NÊN XEM
                                            @endif
                                        </h5>
                                    </div>
                                    
                                    <div class="rec-poster-container">
                                        @if(!empty($movie['anh_bia']))
                                            <img src="{{ asset($movie['anh_bia']) }}" class="rec-poster-img" alt="{{ $movie['title'] }}"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="placeholder-poster" style="display: none;">🎬</div>
                                        @else
                                            <div class="placeholder-poster">🎬</div>
                                        @endif
                                    </div>

                                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title fw-bold text-dark mb-3 fs-5" title="{{ $movie['title'] }}">
                                                {{ $movie['title'] ?? 'Phim Chưa Đặt Tên' }}
                                            </h5>
                                            <div class="d-flex align-items-center gap-2 mb-3">
                                                <span class="rec-rating-badge">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <span>Độ phù hợp: {{ $movie['score'] ?? '4.8' }}/5.0</span>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        @if(isset($movie['id']) && $movie['id'])
                                        <a href="{{ route('xemphim', $movie['id']) }}" class="btn btn-primary rounded-pill py-2 fw-bold d-flex align-items-center justify-content-center gap-2 mt-3 shadow-sm">
                                            <i class="bi bi-play-circle-fill fs-5"></i> Xem Phim Ngay
                                        </a>
                                        @else
                                        <a href="{{ route('page.timkiem', ['query' => $movie['title'] ?? '']) }}" class="btn btn-outline-primary rounded-pill py-2 fw-bold d-flex align-items-center justify-content-center gap-2 mt-3">
                                            <i class="bi bi-search"></i> Khám Phá Phim
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning text-center py-4 rounded-4 shadow-sm" role="alert" id="no-recommendation-alert">
                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
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
            if (!movieTitle) return;

            // Đổi active card
            document.querySelectorAll('.watched-card').forEach(card => card.classList.remove('active'));
            if (element) {
                element.classList.add('active');
            }

            // Cập nhật tiêu đề gợi ý
            const targetTitleEl = document.getElementById('recommend-target-title');
            if (targetTitleEl) {
                targetTitleEl.innerText = `KHI XEM "${movieTitle.toUpperCase()}"`;
            }

            // Lấy danh sách gợi ý cho phim đã chọn (hoặc default)
            let recs = movieRecommendations[movieTitle];
            if (!recs || recs.length === 0) {
                for (let key in movieRecommendations) {
                    if (key.toLowerCase().includes(movieTitle.toLowerCase()) || movieTitle.toLowerCase().includes(key.toLowerCase())) {
                        recs = movieRecommendations[key];
                        break;
                    }
                }
            }
            if (!recs || recs.length === 0) {
                recs = defaultRecommendations;
            }

            renderRecommendations(recs);

            // Cuộn mượt tới phần gợi ý
            const recSection = document.getElementById('recommendation-section');
            if (recSection) {
                recSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }

        function renderRecommendations(recs) {
            const container = document.getElementById('recommendation-container');
            if (!recs || recs.length === 0) {
                container.innerHTML = `
                    <div class="alert alert-warning text-center py-4 rounded-4 shadow-sm" role="alert">
                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                        Chưa có phim gợi ý cụ thể dựa trên bộ phim này.
                    </div>
                `;
                return;
            }

            let html = '<div class="row justify-content-center" id="recommendation-cards-row">';
            recs.forEach((movie, index) => {
                let medalTitle = index === 0 ? '🥇 GỢI Ý HÀNG ĐẦU' : (index === 1 ? '🥈 GỢI Ý PHÙ HỢP' : '🥉 CŨNG NÊN XEM');
                let headerClass = index === 0 ? 'rec-header-1' : (index === 1 ? 'rec-header-2' : 'rec-header-3');
                let score = movie.score !== undefined ? movie.score : '4.8';
                let xemUrl = movie.id ? `/xem-phim/${movie.id}` : `/tim-kiem?query=${encodeURIComponent(movie.title)}`;
                let btnText = movie.id ? '<i class="bi bi-play-circle-fill fs-5"></i> Xem Phim Ngay' : '<i class="bi bi-search"></i> Khám Phá Phim';
                let btnClass = movie.id ? 'btn-primary' : 'btn-outline-primary';
                let posterSrc = movie.anh_bia ? `/${movie.anh_bia.replace(/^\/+/, '')}` : '';

                html += `
                    <div class="col-md-4 mb-4">
                        <div class="card recommend-card shadow-sm h-100">
                            <div class="card-header ${headerClass} text-center py-3 border-0">
                                <h5 class="mb-0 fw-bold">${medalTitle}</h5>
                            </div>

                            <div class="rec-poster-container">
                                ${posterSrc ? `
                                    <img src="${posterSrc}" class="rec-poster-img" alt="${movie.title}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="placeholder-poster h-100" style="display: none;">🎬</div>
                                ` : `
                                    <div class="placeholder-poster h-100">🎬</div>
                                `}
                            </div>

                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold text-dark mb-3 fs-5" title="${movie.title}">
                                        ${movie.title}
                                    </h5>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="rec-rating-badge">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <span>Độ phù hợp: ${score}/5.0</span>
                                        </span>
                                    </div>
                                </div>
                                <a href="${xemUrl}" class="btn ${btnClass} rounded-pill py-2 fw-bold d-flex align-items-center justify-content-center gap-2 mt-3 shadow-sm">
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

        // Tự động gán sự kiện click và kích hoạt phim đầu tiên
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.watched-card').forEach(card => {
                card.addEventListener('click', function () {
                    const title = this.getAttribute('data-movie-title');
                    selectWatchedMovie(this, title);
                });
            });

            const firstActive = document.querySelector('.watched-card.active');
            if (firstActive) {
                const title = firstActive.getAttribute('data-movie-title');
                if (title && movieRecommendations[title]) {
                    selectWatchedMovie(firstActive, title);
                }
            }
        });
    </script>
</body>
</html>