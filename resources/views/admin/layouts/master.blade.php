<!doctype html>
<html lang="en">
<!-- index.html  Tue, 07 Jan 2020 03:35:33 GMT -->

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
    <meta name="csrf" content="{{ csrf_token() }}">
    <title>@yield('title') &mdash; {{ config('settings.site_name') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}" />
    <!-- <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/jqvmap/dist/jqvmap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/summernote/summernote-bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/prism/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>

<body class="layout-4">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!-- Start app top navbar -->
            @include('admin.layouts.header')

            <!-- Start main left sidebar menu -->
            @include('admin.layouts.sidebar')

            <!-- Start app main Content -->
            @yield('content')

            <!-- Start app Footer part -->
            <footer class="main-footer">
                <div class="footer-left">
                    <div class="bullet"></div>
                    Copyright &copy; CodiePie 2026
                </div>
                <div class="footer-right"></div>
            </footer>
        </div>
    </div>
    {{-- <script src="{{ asset('admin/js/jquery.js') }}"></script> --}}


    <!-- General JS Scripts -->
    <script src="{{ asset('admin/assets/bundles/lib.vendor.bundle.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- <script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

    <script src="{{ asset('admin/js/CodiePie.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('admin/assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('admin/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('admin/assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/js/page/forms-advanced-forms.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/js/page/modules-datatables.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/js/page/index.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        var notyf = new Notyf({
            duration: 5000,
            dismissible: true
        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        "use strict";

        const csrf = $("meta[name=csrf]").attr("content");

        $(document).on("click", ".delete-btn", function() {

            let deleteUrl = $(this).data("url");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: deleteUrl,
                        type: "DELETE",
                        data: {
                            _token: csrf
                        },
                        success: function(data) {

                            if (data.status === "success") {
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted!",
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: xhr.responseJSON?.message ??
                                    "Something went wrong"
                            });
                        }
                    });

                }

            });

        });
    </script>


</body>

<!-- index.html  Tue, 07 Jan 2020 03:35:33 GMT -->

</html>
