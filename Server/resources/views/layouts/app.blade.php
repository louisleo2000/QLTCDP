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

    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('css/editor.bootstrap.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('css/editor.bootstrap5.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('css/editor.dataTables.min.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('css/editor.jqueryui.min.css') }}" rel="stylesheet" /> --}}
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/editor.dataTables.min.css') }}" /> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    {{-- Data table --}}

    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css"
        type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.bootstrap5.min.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
    <link id="pagestyle" href="{{ asset('admin/css/material-dashboard.css?v=3.0.1') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
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

    <!-- DataTables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0-beta1/js/bootstrap.min.js"></script>

    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="{{ asset('js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/editor.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/editor.jqueryui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/editor.jqueryui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/editor.bootstrap5.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/select.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script src="//cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    {{-- <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/chartjs.min.js') }}"></script>

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
