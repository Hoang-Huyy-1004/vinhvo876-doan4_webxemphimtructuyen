<style>
    /* Các biến và style tổng thể cho body, container */
    :root {
        --sidebar-width: 280px;
        --sidebar-bg: #000;
        --main-bg: #000;
        --text-color: #e0e0e0;
        --text-muted: #888;
        --active-item-bg: #333;
        --card-bg: #111;
        --card-border: #444;
        --fpt-orange: #ff6600;
    }

    body {
        background-color: var(--main-bg);
        color: var(--text-color);
        font-family: 'Roboto', sans-serif;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    /* Sidebar styling */
    .sidebar {
        width: var(--sidebar-width);
        background-color: var(--sidebar-bg);
        padding: 20px;
        display: flex;
        flex-direction: column;
        border-right: 1px solid var(--card-border);
    }

    .sidebar-header {
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--fpt-orange);
        font-weight: 700;
        font-size: 1.25rem;
    }

    .sidebar-nav .nav-link {
        color: var(--text-color);
        padding: 12px 15px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: background-color 0.2s ease;
    }

    .sidebar-nav .nav-link:hover {
        background-color: var(--active-item-bg);
    }

    .sidebar-nav .nav-link.active {
        background-color: var(--active-item-bg);
    }
</style>

<div class="sidebar">
    <div class="sidebar-header d-flex align-items-center">
        <i class="bi bi-arrow-left me-3"></i>
        <a href="{{ route('home') }}" class="text-decoration-none text-white ">Quay lại trang chủ</a>
    </div>

    <ul class="nav flex-column sidebar-nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('thongtintaikhoan') }}">
                <i class="bi bi-person-circle"></i>
                <span>Thông tin tài khoản</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-wallet2"></i>
                <span>Quản lý thanh toán và gói</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-hdd-fill"></i>
                <span>Quản lý thiết bị</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-collection-fill"></i>
                <span>Thư viện</span>
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('dangxuat') }}" method="POST" id="logout-form">
                @csrf
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Đăng xuất</span>
                </a>
            </form>
        </li>
    </ul>
</div>