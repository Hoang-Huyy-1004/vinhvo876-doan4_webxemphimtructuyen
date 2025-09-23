<nav class="navbar navbar-expand-lg navbar-dark bg-black px-4">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" class="me-2">
        </a>

        {{-- Nút toggle cho mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu chính --}}
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav text-center">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="{{ url('/') }}">TRANG CHỦ</a>
                </li>
                <li class="nav-item"><a class="nav-link text-white" href="#">PHIM LẺ</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">PHIM BỘ</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">ANIME</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">PHIM HOẠT HÌNH</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        XEM THÊM
                    </a>
                    <div class="dropdown-menu dropdown-menu-dark p-3" aria-labelledby="navbarDropdown">
                        <div class="d-flex flex-wrap" style="min-width: 100px;">
                            <a class="dropdown-item text-white" href="#">Thiếu nhi</a>
                            <a class="dropdown-item text-white" href="#">Podcast</a>
                            <a class="dropdown-item text-white" href="#">Giải trí</a>
                            <a class="dropdown-item text-white" href="#">Phim lẻ</a>
                            <a class="dropdown-item text-white" href="#">Học tập</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        {{-- Search + thông báo + user --}}
        <div class="d-flex align-items-center gap-3">

            {{-- Search --}}
            <form action="{{ route('search') }}" method="GET" class="d-flex align-items-center">
                <input type="text" name="q"
                    class="form-control form-control-sm bg-dark text-white border-0"
                    placeholder="Tìm phim..." value="{{ request('q') }}">
                <button type="submit" class="border-0 bg-transparent ms-2">
                    <i class="bi bi-search text-white"></i>
                </button>
            </form>

            {{-- Thông báo --}}
            <div class="dropdown">
                <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell text-white fs-5"></i>
                    @if(isset($notifications) && $notifications->where('is_read', false)->count() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $notifications->where('is_read', false)->count() }}
                        </span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark p-2" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
                    @forelse($notifications as $notification)
                        <li>
                            <a href="{{ route('notifications.show', $notification->id) }}"
                                class="dropdown-item {{ $notification->is_read ? 'text-muted' : 'fw-bold' }}">
                                {{ $notification->message }}
                                <small class="d-block text-secondary">{{ $notification->created_at->diffForHumans() }}</small>
                            </a>
                        </li>
                    @empty
                        <li><span class="dropdown-item text-center text-muted">Không có thông báo</span></li>
                    @endforelse
                </ul>
            </div>

            {{-- Mua gói --}}
            <a href="#" class="btn btn-danger rounded-pill px-3">Mua gói</a>

            {{-- User --}}
            <a href="#" class="text-white"><i class="bi bi-person-circle fs-4"></i></a>
        </div>
    </div>
</nav>
