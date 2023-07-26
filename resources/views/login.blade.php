<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Jasa Medika</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/logo/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-auth.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo--><a class="brand-logo" href="#">
                            {{-- <img class="img-fluid" alt="Responsive image"
                                src="{{ asset('app-assets/images/logo/logo.png') }}" width="32px"
                                height="32px">
                            <h2 class="brand-text text-primary ms-1">RSIA PUTI BUNGSU</h2> --}}
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img
                                    class="img-fluid" src="{{ asset('app-assets/images/pages/login-v2.svg') }}"
                                    alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <div class="i-am-centered">
                                    {{-- <img class="img-fluid" alt="Responsive image" style="width: 25px!important"
                                        src="{{ asset('app-assets/images/logo/logo.png') }}" /> --}}
                                </div>
                                <h2 class="card-title fw-bold mb-0">Welcome To BEST Coorporation</h2>
                                {{-- <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    @if (session('errors'))
                                        <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                    </ul>
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('error') }}
                                        </div>
                                    @endif
                                    <div class="mb-1">
                                        <label class="form-label" for="login-username">Email </label>
                                        <input type="text" name="email" class="form-control"
                                            placeholder="Masukkan email" tabindex="1" required />
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="login-password">Password</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="login-password"
                                                inputmode="text" type="password" name="password"
                                                placeholder="Masukan Password" aria-describedby="login-password"
                                                tabindex="2" required /><span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100" tabindex="3">Login</button>
                                </form> --}}
                                <button id="add-user" type="submit" class="btn btn-primary w-100" tabindex="3">Tambah Data Diri</button>
                                
                                <button id="add-pegawai" type="submit" class="btn btn-primary w-100" tabindex="3" style="margin-top :15px">Data Pegawai</button>
                                
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-start" id="modal-user" tabindex="-1" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabelUser"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="card-body">
                <form id="postForm" name="postForm">
                    <input type="hidden" name="post_id" id="post_id">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="mb-1">
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        placeholder="Masukan Nama" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label">Tampat Lahir</label>
                                <div class="mb-1">
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                        placeholder="Masukan Tempat Lahir" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="mb-1">
                                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                        placeholder="Masukan Tanggal Lahir" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Alamat</label>
                                <div class="mb-1">
                                    <textarea type="number" id="alamat" name="alamat" class="form-control"
                                        placeholder="Masukan Alamat" required="" /><textarea
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">No Telpon</label>
                                <div class="mb-1">
                                    <input type="text" name="no_telp" id="no_telp" class="form-control"
                                        placeholder="Masukan Telpon" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Agama</label>
                                <div class="mb-1">
                                    <select class="select2 form-select" name="agama" id="agama" required>
                                        <option value="1">Islam</option>
                                        <option value="2">Kristen</option>
                                        <option value="3">Katolik</option>
                                        <option value="4">Hindu</option>
                                        <option value="5">Budha</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <div class="mb-1">
                                    <select class="select2 form-select" name="hobi" id="hobi" required multiple>
                                        <option value="1">baca buku</option>
                                        <option value="2">olah raga</option>
                                        <option value="3">Main Game</option>
                                        <option value="4">Hacking</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" id="btn-save"
                                value="create" disabled>Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/page-auth-login.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        'use strict';
        var select = $('.select2');
        $('#add-user').click(function() {
                $('#modal-user').modal('show');
                $('#btn-save').val("create-user");
                $('#postForm').trigger("reset");
                $('#myModalLabelUser').html("Tambah User");
                // $('#modal-user').modal('show');
            });
        select.each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
            });
        });

        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
