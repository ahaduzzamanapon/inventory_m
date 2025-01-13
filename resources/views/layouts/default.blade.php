<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>
        @php
            if (!Auth::check()) {
                // dd("Please login first");
                // redirect(route('welcome'));
            }
            $setting = DB::table('sitesettings')->first();
        @endphp
        @section('title')| {{ !empty($setting) ? $setting->name : 'Gym Master' }} -
        {{ !empty($setting) ? $setting->slogan : 'Gym Master' }} @show
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">


    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('fonts/iconmind.css') }}">

    <!-- global css -->
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    {{-- //<script src="https://cdn.tailwindcss.com"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- DataTables Buttons Extension CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.0/css/buttons.dataTables.min.css">



<!-- DataTables JS -->
<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons Extension JS -->
<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/2.2.0/js/dataTables.buttons.min.js"></script>

<!-- JS for pdfmake (PDF export functionality) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.69/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.69/vfs_fonts.min.js"></script>

<!-- JS for individual button types like Excel, Print, etc. -->
<script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.print.min.js"></script>






<!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<!-- jQuery UI Library -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <!-- jQuery Library -->




    <style>
        #demo {
            position: relative;

            overflow: auto;
        }
    </style>
    <style>
        .dataTables_wrapper {
            overflow-x: scroll;
        }
        .chosen-single {
            padding: 6px !important;
            height: fit-content !important;
        }
    </style>
    <!-- end of global css -->

    <!-- vendors  css -->
    @yield('header_styles')
</head>

<body>
    <!-- header logo: style can be found in header-->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light navbar-static-top" role="navigation">
            <a href="javascript:void(0)" class="ml-100 toggle-right d-xl-none d-lg-block">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="{{ asset('img/images/toggle.png') }}" alt="logo" />
            </a>
            <!-- Header Navbar: style can be found in header-->
            <!-- Sidebar toggle button-->
            <!-- Sidebar toggle button-->
            <h3 style="display: flex;width: -webkit-fill-available;place-content: center;font-size: x-large;width: -moz-available;">
                {{ !empty($setting) ? $setting->name : 'Inventory' }} -
                {{ !empty($setting) ? $setting->slogan : 'Inventory' }} </h3>

            <div class="navbar-right ml-auto">
                <ul class="navbar-nav nav">
                    <li class="dropdown notifications-menu nav-item dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle nav-link dropdown-toggle"
                            data-toggle="dropdown" id="navbarDropdown" style="border: 1px solid #a9a9a9;padding: 0 17px;border-radius: 7px;">
                            <i class="im im-icon-Boy fs-16"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-notifications table-striped" aria-labelledby="navbarDropdown">

                            <li class="dropdown-footer">
                                @if (!empty(Auth::user()) && Auth::user()->member_id != null)
                                    <a class="dropdown-item"
                                        href="{{ route('members.details', ['id' => Auth::user()->member_id]) }}">
                                        Profile
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper">


        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-aside" style="min-height: 100vh;height: 100vh;">
            <!-- sidebar: style can be found in sidebar-->
            <section class="sidebar metismenu sidebar-res">
                @include('layouts/leftmenu')
                <!-- menu -->
            </section>
            <!-- /.sidebar -->
        </aside>



        <!--            right side bar ----------->
        <aside class="right-aside">
            @yield('content')
        </aside>
    </div>
    <!-- ./wrapper -->
    <!-- Footer end -->
    <!-- SCRIPTS -->
    <!-- global js -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <!-- end of page level js -->
    <!-- Start of vendor js -->
    @yield('footer_scripts')

    <script src="{{ asset('vendors/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>




    {{-- <script>
        document.body.style.zoom = "90%";
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            $('input').attr('required', 'required');
        });
    </script> --}}

    <style>
        .top_solver {
            top: -161px!important;
        }
    </style>

    <script>
        $(document).ready(function() {
            var ww = $(window).width();
            console.log(ww);
            $(window).resize(function() {
                checkWidth();
            });
        });

        function checkWidth() {
            var ww = $(window).width();
            console.log(ww);

            if(ww < 767) {
                $('.sidebar-res').css('margin-left', '');
            }

            if (ww < 992) {
                console.log('rhb');
                $('.left-aside').addClass('top_solver');
            }else{
                $('.left-aside').removeClass('top_solver');
            }

        }
    </script>
    <script>
        $(document).ready(function() {
            var table = new DataTable('.data_t', {
                dom: 'Bfrtip', // This will place the buttons in the top of the table
                buttons: [
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['copy', 'excel', 'print']
                    }
                ],
            });
        });
    </script>



</body>

</html>
