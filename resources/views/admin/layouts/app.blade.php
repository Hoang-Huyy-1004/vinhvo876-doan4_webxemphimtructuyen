<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - phimhay</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        {{-- Sidebar --}}
        @include('admin.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                {{-- Topbar --}}
                @include('admin.layouts.navbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- End Page Content -->

            </div>
            <!-- End Main Content -->

            {{-- Footer --}}
            @include('admin.layouts.footer')

        </div>
        <!-- End Content Wrapper -->

    </div>
    <!-- End Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are
                    ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary"
                        type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- CHÚ Ý: Đã dùng jquery trong vendor thì KHÔNG nạp thêm jquery CDN nữa để tránh xung đột -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

    <!-- Đã xóa dòng nạp jQuery CDN thừa ở đây -->

    <script>
        $(document).ready(function() {
            let adminTimer;

            // ĐÃ SỬA: Đổi #admin-search-input thành #header-search-input cho khớp với navbar
            $('#header-search-input').on('keyup', function() {
                let query = $(this).val().trim();

                clearTimeout(adminTimer);

                // ĐÃ SỬA: Đổi #admin-search-results thành #header-search-results
                if (query.length === 0) {
                    $('#header-search-results').hide();
                    return;
                }

                // Debounce 300ms (đợi ngừng gõ mới tìm)
                adminTimer = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('ajax.search') }}",
                        method: "GET",
                        data: {
                            keyword: query
                        },
                        success: function(response) {
                            let html = '';

                            if (response.count > 0) {
                                response.data.forEach(movie => {

                                    let adminLink = "{{ url('/admin/phim') }}/" + movie.id;

                                    // Lưu ý: Class CSS ở đây (h-result-item...) phải khớp với CSS bạn đã định nghĩa trong navbar
                                    // Trong navbar bạn dùng class: h-result-item, h-res-img, h-res-info
                                    // Nên mình sửa lại class ở đây cho khớp luôn để nó ăn Style

                                    html += `
                                        <a href="${adminLink}" class="h-result-item">
                                            <img src="${movie.anh_bia}" class="h-res-img" onerror="this.src='https://via.placeholder.com/40x60'">
                                            <div class="h-res-info">
                                                <h6>${movie.ten_phim}</h6>
                                                <span>
                                                    ${movie.nam_san_xuat} 
                                                    <span class="badge badge-info">${movie.chat_luong || 'HD'}</span>
                                                </span>
                                            </div>
                                        </a>
                                    `;
                                });

                                html += `
                                    <a href="{{ route('phim.index') }}" class="h-result-item justify-content-center py-2">
                                        <span style="font-size: 12px; color: #aaa;">Xem tất cả kết quả...</span>
                                    </a>
                                `;

                                $('#header-search-results').html(html).fadeIn();
                            } else {
                                $('#header-search-results').html('<div class="p-3 text-center text-muted small" style="color:#aaa;">Không tìm thấy phim phù hợp.</div>').fadeIn();
                            }
                        },
                        error: function() {
                            console.log('Lỗi Ajax tìm kiếm Admin');
                        }
                    });
                }, 300);
            });

            // Ẩn bảng kết quả khi click ra ngoài
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.navbar-search').length) {
                    $('#header-search-results').fadeOut();
                }
            });
        });
    </script>

</body>

</html>