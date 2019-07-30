<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Siliwangi Integrated System - Sintesys - Universitas Siliwangi</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets/batagor/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets/batagor/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/css/bootstrap_limitless.min.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/global_assets/css/icons/fa5/css/all.min.css') }} " rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets/batagor/css/layout.min.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/css/components.min.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/batagor/css/colors.min.css') }} " rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('assets/batagor/global_assets/js/main/jquery.min.js')  }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/ui/slinky.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/notifications/noty.min.js') }}"></script>
    <script src="{{ asset('assets/batagor/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

    <script src="{{ asset('assets/batagor/js/app.js') }}"></script>
    <!-- /theme JS files -->

    @yield('styles')


</head>

<body>

<!-- Main navbar -->
@include('layouts.header')
<!-- /main navbar -->


<!-- Secondary navbar -->
    @include('layouts.menu')
<!-- /secondary navbar -->


<!-- Page header -->
@yield('page_header')
<!-- /page header -->


<!-- Page content -->
<div class="page-content pt-0">
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content area -->
    @yield("main")
    <!-- /content area -->
    </div>
    <!-- /main content -->
</div>
<!-- /page content -->


<script>
    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
        "processing": true,
        "serverSide": true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
    });

    $('.singleDP').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        "locale": {
            "format": "YYYY-MM-DD",
        }
    });
</script>
@include('layouts.alerts')
@yield('scripts')
<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
			<span class="navbar-text">
				&copy; {{ date('Y') }}. <a href="https://upttik.unsil.ac.id/">UPT TIK</a> - <a
                        href="https://unsil.ac.id/" target="_blank">Universitas Siliwangi</a> - Made With Double shot Espresso 🐈
			</span>

        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item"><a href="http://info.unsil.ac.id/" class="navbar-nav-link"
                                    target="_blank"><i class="icon-lifebuoy mr-2"></i> Informasi dan Bantuan</a></li>
        </ul>
    </div>
</div>
<!-- /footer -->


</body>
</html>
