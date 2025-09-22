<!-- resources/views/layouts/header.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black px-4">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/47/FPT_Telecom_logo_2017.svg"
            alt="Logo" width="40" height="40" class="me-2">
        <span class="fw-bold text-white">FILMHAY</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Menu giữa -->
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link text-white fw-bold" href="{{ url('/') }}">TRANG CHỦ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">PHIM LẺ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">PHIM BỘ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">ANIME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">PHIM HOẠT HÌNH</a>
            </li>
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

        <!-- Search Form -->
        <form action="{{ route('search') }}" method="GET" class="d-flex me-3">
            <input type="text" name="q"
                class="form-control form-control-sm bg-dark text-white border-0"
                placeholder="Tìm phim..." value="{{ request('q') }}">

            <!-- Icon search nằm ngoài, không có ô vuông -->
            <button type="submit" class="border-0 bg-transparent ms-2">
                <i class="bi bi-search text-white"></i>
            </button>
        </form>


        <!-- <a href="#" class="text-white me-3"><i class="bi bi-bell"></i></a> -->
        <!-- Thông báo -->
        <div class="nav-item dropdown me-3">
            <a class="nav-link position-relative" href="#" id="notificationDropdown"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell text-white fs-5"></i>
                @if($notifications->where('is_read', false)->count() > 0)
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

        <a href="#" class="btn btn-danger rounded-pill px-3 me-3">Mua gói</a>
        <a href="#" class="text-white"><i class="bi bi-person-circle fs-4"></i></a>
    </div>
    </div>
</nav>
