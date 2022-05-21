<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('admin/img/favicon.png') }}">
    <title>
        Quản lý tiêm chủng
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('admin/css/material-dashboard.css?v=3.0.1') }}" rel="stylesheet" />

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('editor/css/editor.dataTables.min.css') }}" /> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>120 --}}
</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('layouts.sidenav')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.header')
        <div class="container-fluid py-4">
            @include('layouts.head-reports')
            @yield('content')
            @include('layouts.footer')
        </div>
    </main>
    @include('layouts.fixed-plugin')
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/chartjs.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('editor/js/editor.jqueryui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('editor/js/editor.jqueryui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('editor/js/dataTables.editor.js') }}"></script> --}}
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('admin/js/material-dashboard.min.js?v=3.0.1') }}"></script>
    <script>
        var language = {
                "decimal": "",
                "emptyTable": "Không có dữ liệu phù hợp",
                "info": "Đang xem từ _START_ đến _END_ trên tổng _TOTAL_ ",
                "infoEmpty": "Đang xem từ 0 đến 0 trên tổng 0 ",
                "infoFiltered": "(lọc trong _MAX_ total)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Hiển thị _MENU_ ",
                "loadingRecords": "Đang tải...",
                "processing": "Đang xử lý...",
                "search": "Tìm kiếm:",
                "zeroRecords": "Không tìm thấy dữ liệu phù hợp",
                "paginate": {
                    "first": "Đầu tiên",
                    "last": "Cuối",
                    "next": "Tiếp theo",
                    "previous": "Trước"
                },
                "aria": {
                    "sortAscending": ": sắp xếp tăng dần",
                    "sortDescending": ": sắp xép giảm dần"
                }
            }
    </script>
    @stack('scripts')
</body>

</html>
