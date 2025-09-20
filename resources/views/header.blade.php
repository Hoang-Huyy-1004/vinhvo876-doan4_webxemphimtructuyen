<!-- resources/views/layouts/header.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black px-4">
    <a class="navbar-brand d-flex align-items-center" href="#">
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
                <a class="nav-link text-white fw-bold" href="#">Trang chủ</a>
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

        <!-- Icon bên phải -->
        <div class="d-flex align-items-center">
            <a href="#" class="text-white me-3"><i class="bi bi-search"></i></a>
            <a href="#" class="text-white me-3"><i class="bi bi-bell"></i></a>
            <a href="#" class="btn btn-danger rounded-pill px-3 me-3">Mua gói</a>
            <a href="#" class="text-white"><i class="bi bi-person-circle fs-4"></i></a>
        </div>
    </div>
</nav>
