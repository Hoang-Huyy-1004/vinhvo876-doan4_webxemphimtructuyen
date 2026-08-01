<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 3 Phim Gợi Ý - User {{ $userId }}</title>
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
        .recommend-card {
            border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .recommend-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }
    </style>
</head>
<body>
    @include('header')

    <main class="container my-5">
        <h2 class="text-center mb-4 fw-bold text-dark">
            🎯 TOP 3 PHIM GỢI Ý CHO USER #{{ $userId }}
        </h2>

        @if(!empty($recommendations) && count($recommendations) > 0)
            <div class="row justify-content-center">
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
                                @if(isset($movie['id']))
                                <a href="{{ route('xemphim', $movie['id']) }}" class="btn btn-outline-primary mt-3 w-100">
                                    Xem Phim Ngay
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning text-center" role="alert">
                Hiện chưa có dữ liệu gợi ý cho người dùng này.
            </div>
        @endif
    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>