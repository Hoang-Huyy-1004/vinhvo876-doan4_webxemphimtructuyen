<nav class="navbar navbar-expand-lg navbar-dark bg-black px-4">
  <div class="container-fluid d-flex align-items-center justify-content-between">

    {{-- Logo --}}
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" class="me-2">
    </a>

    {{-- Toggle mobile --}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Main menu --}}
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav text-center">
        <li class="nav-item">
          <a class="nav-link text-white fw-bold" href="{{ url('/') }}">TRANG CHỦ</a>
        </li>

        <li class="nav-item"><a class="nav-link text-white" href="{{ route('show.phimle') }}">PHIM LẺ</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('show.phimbo') }}">PHIM BỘ</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('show.tinhcam') }}">TÌNH CẢM</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('show.hoathinh') }}">PHIM HOẠT HÌNH</a></li>

        {{-- XEM THÊM dropdown (chuẩn bootstrap) --}}
        <li class="nav-item dropdown">
          <a class="nav-link text-white dropdown-toggle" href="#" id="xemThemDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            XEM THÊM
          </a>
          <div class="dropdown-menu dropdown-menu-dark p-3" aria-labelledby="xemThemDropdown" style="min-width:200px;">
            <a class="dropdown-item text-white" href="#">Thiếu nhi</a>
            <a class="dropdown-item text-white" href="#">Podcast</a>
            <a class="dropdown-item text-white" href="#">Giải trí</a>
            <a class="dropdown-item text-white" href="#">Phim lẻ</a>
            <a class="dropdown-item text-white" href="#">Học tập</a>
          </div>
        </li>
      </ul>
    </div>

    {{-- Search + thông báo + mua gói + user --}}
    <div class="d-flex align-items-center gap-3">

      {{-- Search --}}
      <form action="" method="GET" class="d-flex align-items-center">
        <!-- <input type="text" name="q"
               class="form-control form-control-sm bg-dark text-white border-0"
               placeholder="Tìm phim..." value="{{ request('q') }}"> -->
        <!-- <button type="submit" class="border-0 bg-transparent ms-2">
          <i class="bi bi-search text-white"></i>
        </button> -->
        <a href="{{ route('page.timkiem') }}" class="border-0 bg-transparent ms-2 text-decoration-none" title="Tìm kiếm">
          <i class="bi bi-search text-white"></i>
        </a>
      </form>

      {{-- Icon Gợi ý phim (Chỉ hiển thị khi người dùng đã đăng nhập) --}}
      @auth
      <a href="{{ route('recommend', Auth::user()->user_id ?? Auth::id()) }}" class="text-warning text-decoration-none d-flex align-items-center position-relative px-1" title="Gợi ý phim thông minh">
        <i class="bi bi-lightbulb-fill fs-4"></i>
      </a>
      @endauth

      {{-- Notification --}}
      <div class="dropdown">
        <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Thông báo">
          <i class="bi bi-bell text-white fs-5"></i>
          @if(isset($notifications) && $notifications->where('is_read', false)->count() > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $notifications->where('is_read', false)->count() }}
          </span>
          @endif
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark p-2" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
          @forelse($notifications ?? [] as $notification)
          <li>
            <a href="{{ route('notifications.show', $notification->id) }}" class="dropdown-item {{ $notification->is_read ? 'text-muted' : 'fw-bold' }}">
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

      {{-- User dropdown - dùng cùng lớp dropdown-menu-dark + p-3 --}}
      <div class="dropdown">
        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle fs-4"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-dark p-3 dropdown-menu-end" aria-labelledby="userDropdown" style="min-width:180px;">
          @guest
          <a class="dropdown-item text-white" href="{{ route('dangnhap.form') }}">Đăng nhập</a>
          <a class="dropdown-item text-white" href="{{ route('dangky.form') }}">Đăng ký</a>
          @else
          <a class="dropdown-item text-warning fw-semibold" href="{{ route('recommend', Auth::user()->user_id ?? Auth::id()) }}">
            <i class="bi bi-lightbulb-fill me-2"></i>Gợi ý phim cho bạn
          </a>
          <a class="dropdown-item text-white" href="{{ route('thongtintaikhoan') }}">Tài khoản của tôi</a>
          <hr class="dropdown-divider">
          <form action="{{ route('dangxuat') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="dropdown-item text-white">Đăng xuất</button>
          </form>
          @endguest
        </div>
      </div>

    </div>
  </div>
</nav>

<!-- Thêm CSS nhẹ (đặt dưới nav, trong header.blade.php) -->
<style>
  /* animation: fade + slide */
  .dropdown-menu {
    opacity: 0;
    visibility: hidden;
    transform: translateY(8px);
    transition: opacity .2s ease, transform .2s ease;
  }

  .dropdown.show>.dropdown-menu,
  .dropdown-menu.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }
</style>