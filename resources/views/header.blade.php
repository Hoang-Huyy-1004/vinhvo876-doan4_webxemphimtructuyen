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
                <a class="nav-link text-white fw-bold" href="{{ url('/') }}">Trang chủ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Phim lẻ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Phim bộ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Anime</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Phim hoạt hình</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Xem thêm
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


            <a href="#" class="text-white me-3"><i class="bi bi-bell"></i></a>
            <a href="#" class="btn btn-danger rounded-pill px-3 me-3">Mua gói</a>
            <a href="#" class="text-white"><i class="bi bi-person-circle fs-4"></i></a>
        </div>
    </div>
</nav>
