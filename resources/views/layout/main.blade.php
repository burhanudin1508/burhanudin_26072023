<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    @include('layout.header')
    @yield('custom-css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('layout.navbar')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    @include('layout.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    {{-- <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0"> --}}
    <!-- BEGIN: Main Content-->
    @yield('content')
    <!-- END: Main Content-->
    {{-- </div>
    </div> --}}
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{\Carbon\Carbon::now()->year}}<a
                    class="ms-25" href="#" target="_blank">Best</a><span class="d-none d-sm-inline-block">,
                    All rights Reserved</span></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- BEGIN: Footer JS-->
    @include('layout.footer')
    @yield('custom-js')
    <!-- END: Footer JS-->

</body>
<!-- END: Body-->

</html>
