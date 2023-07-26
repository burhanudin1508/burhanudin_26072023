@extends('layout.main')

@section('custom-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
    <style>
        .card-statistics .statistics-body {
            padding: 2rem 2.4rem !important;
        }

        @media (max-width: 991.98px) {

            .card-statistics .card-header,
            .card-statistics .statistics-body {
                padding: 1.5rem !important;
            }
        }

        .card-company-table thead th {
            border: 0;
        }

        .card-company-table td {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .card-company-table td .avatar {
            background-color: #f8f8f8;
            margin-right: 2rem;
        }

        .card-company-table td .avatar img {
            border-radius: 0;
        }

        .card-browser-states .browser-states:first-child {
            margin-top: 0;
        }

        .card-browser-states .browser-states:not(:first-child) {
            margin-top: 1.7rem;
        }

        .card-transaction .transaction-item:not(:last-child) {
            margin-bottom: 1.5rem;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        $('body').on('click', '#delete-user', function() {
            var post_id = $(this).data("id");
            Swal.fire({
                title: 'Apakah Anda Yakin Untuk Hapus Data?',
                text: "Data yang sudah diproses tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus data!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('hapus-user') }}" + '/' + post_id,
                        success: function(data) {
                            $("#post_id_" + post_id).remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Data Berhasil Terhapus',
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                },
                                buttonsStyling: false
                            }).then(function(result) {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    
                }
            });

        });
        $('body').on('click', '#activate-user', function() {
            var post_id = $(this).data("id");
            Swal.fire({
                title: 'Apakah Anda Yakin Untuk Aktifkan Data User?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Aktifkan!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('activate-user') }}" + '/' + post_id,
                        success: function(data) {
                            $("#post_id_" + post_id).remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Aktivasi Berhasil',
                                text: ' ',
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                },
                                buttonsStyling: false
                            }).then(function(result) {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    
                }
            });

        });
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#add-user').click(function() {
                $('#btn-save').val("create-user");
                $('#postForm').trigger("reset");
                $('#myModalLabelUser').html("Tambah User");
                $('#modal-user').modal('show');
            });
            $('body').on('click', '#edit-user', function() {
                var post_id = $(this).data('id');
                $.get('get-user/' + post_id, function(data) {
                    $('#myModalLabelUser').html("Edit User");
                    $('.group-password').show();
                    $("#password").prop('required', false);
                    $("#repassword").prop('required', false);
                    $('#btn-save').val("edit-user");
                    $('#modal-user').modal('show');
                    $('#post_id').val(data.id);
                    $('#nama').val(data.name);
                    $('#email').val(data.email);
                    $("#gender").val(data.gender).trigger('change');
                    $("#role").val(data.role).trigger('change');
                    $("#btn-save").prop('disabled', false);
                })
            });
            $('body').on('click', '#detail-user', function() {
                var post_id = $(this).data('id');
                $.get('get-user/' + post_id, function(data) {
                    $('#myModalLabelUser').html("Edit User");
                    $(".group-password").hide();
                    $('#btn-save').val("edit-user");
                    $('#modal-user').modal('show');
                    $('#post_id').val(data.id);
                    $('#nama').val(data.name);
                    $("#nama").prop('disabled', true);
                    $('#email').val(data.email);
                    $("#email").prop('disabled', true);
                    $("#gender").val(data.gender).trigger('change');
                    $("#gender").prop('disabled', true);
                    $("#role").val(data.role).trigger('change');
                    $("#role").prop('disabled', true);
                    $("#btn-save").hide();
                })
            });
            $('body').on('click', '#delete-user', function() {
                var post_id = $(this).data("id");
                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Data yang sudah dihapus tidak dapat diubah kembali",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ml-1'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('delete-user') }}" + '/' + post_id,
                            success: function(data) {
                                $("#post_id_" + post_id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    },
                                    buttonsStyling: false
                                }).then(function(result) {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        
                    }
                });

            });
            $('body').on('click', '#reset-pass', function() {
                var post_id = $(this).data('id');
                $('#myModalLabelPass').html("Reset Password");
                $('#modal-reset').modal('show');
                $('#reset-id').val(post_id);
            });
        });
        if ($("#postForm").length > 0) {
            $("#postForm").validate({

                submitHandler: function(form) {
                    var actionType = $('#btn-save').val();
                    $('#btn-save').html('Sending..');

                    $.ajax({
                        data: $('#postForm').serialize(),

                        url: "{{ route('post-user') }}",
                        type: "POST",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            if (data.status_msg == true) {
                                $('#postForm').trigger("reset");
                                $('#modal-user').modal('hide');
                                Swal.fire({
                                    title: 'Berhasil!',
                                    icon: 'success',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                }).then(function(result) {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            } else {
                                $('#btn-save').html('Simpan');
                                Swal.fire({
                                    text: 'Penyimpanan data gagal, ' + data.message,
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                }).then(function(result) {
                                    // if (result.value) {
                                    //     location.reload();
                                    // }
                                });
                            }

                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#btn-save').html('Save Changes');
                        }
                    });
                }
            })
        }

        function cekEmail() {
            var email = $('#email').val();
            var _url = "{{ route('cek-email') }}";
            $.ajax({
                type: "GET",
                url: _url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "email": email,
                },
                success: function(xhr, data) {
                    if (xhr.error == true) {
                        Swal.fire({
                            text: xhr.Message,
                            icon: 'warning',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        }).then(function(result) {
                            if (result.value) {
                                //
                            }
                        });
                    } else {
                        Swal.fire({
                            text: 'Email Dapat Digunakan',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        }).then(function(result) {
                            if (result.value) {
                                $("#btn-save").prop('disabled', false);
                                // window.location.reload();
                            }
                        });

                    }
                },
            });
        }
    </script>
@endsection

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section class="app-user-view">
                    <!-- User Card & Plan Starts -->
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>

                                        <p class="font-small-2 ">Pengguna Active</p>
                                    </div>
                                    <div class="avatar bg-light-success p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="user-check" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <p class="font-small-2 ">Pengguna Tidak Aktif</p>
                                    </div>
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="user-x" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <p class="font-small-2 ">Pasien</p>
                                    </div>
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-header row">
                        <div class="content-header-left col-md-9 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h2 class="content-header-title float-start mb-0">Data Pengguna</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-body">
                        <div class="card profile-header mb-2">
                            <div class="profile-header-nav">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        <span id="JudulKategoriPegawai"></span>
                                    </h2>
                                </div>
                                <!-- navbar -->
                                <nav
                                    class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                                    <button class="btn btn-icon navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <i data-feather="align-justify" class="font-medium-5"></i>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0"
                                            style="margin-left: 1.2rem;">
                                            <ul class="nav nav-pills mb-0">
                                                <li class="nav-item">
                                                    <a class="nav-link fw-bold active" data-bs-toggle="pill"
                                                        href="#tab-data-pribadi">
                                                        <span class="d-none d-md-block">Pengguna Aktif</span>
                                                        <i data-feather="rss" class="d-block d-md-none"></i>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link fw-bold" data-bs-toggle="pill"
                                                        href="#tab-inactive">
                                                        <span class="d-none d-md-block">Pengguna Tidak Aktif</span>
                                                        <i data-feather="info" class="d-block d-md-none"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                                <!--/ navbar -->
                            </div>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tab-data-pribadi" aria-expanded="true">
                                    <!-- profile info section -->
                                    <section id="profile-info">
                                        <div class="row" id="basic-table">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-end pb-0">
                                                        <a href="javascript:void(0)" id="add-user" type="button"
                                                            class="btn btn-primary">
                                                            <i data-feather="plus" class="me-25"></i>
                                                            <span>Tambah Data</span>
                                                        </a>

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="datatables-basic table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama</th>
                                                                        <th>Email</th>
                                                                        <th>Jenis Kelamin</th>
                                                                        <th>Role</th>
                                                                        <th>Aksi</th>
                                                                    </tr>

                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $no = 0;
                                                                    ?>
                                                                    @foreach ($active as $item)
                                                                        <?php $no++; ?>
                                                                        <tr>
                                                                            <td>{{ $no }}</td>
                                                                            <td>{{ $item->name }}</td>
                                                                            <td>{{ $item->email }}</td>
                                                                            <td>
                                                                                @if ($item->gender == 1)
                                                                                    Pria
                                                                                @else
                                                                                    Wanita
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($item->gender == 1)
                                                                                    Admin
                                                                                @else
                                                                                    Operator
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:void(0)"
                                                                                    id="detail-user"
                                                                                    data-id="{{ \Crypt::encrypt($item->id) }}"
                                                                                    class="btn btn-icon rounded-circle btn-outline-primary"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Lihat">
                                                                                    <i data-feather='eye'></i>
                                                                                </a>
                                                                                <a href="javascript:void(0)"
                                                                                    id="edit-user"
                                                                                    data-id="{{ \Crypt::encrypt($item->id) }}"
                                                                                    class="btn btn-icon rounded-circle btn-outline-dark"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Edit">
                                                                                    <i data-feather="edit-2"></i>
                                                                                </a>
                                                                                <a href="javascript:void(0)"
                                                                                    id="delete-user"
                                                                                    data-id="{{ \Crypt::encrypt($item->id) }}"
                                                                                    class="btn btn-icon rounded-circle btn-outline-danger"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Hapus">
                                                                                    <i data-feather="trash"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!--/ profile info section -->
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab-inactive"
                                    aria-expanded="true">
                                    <section id="riwayat-penempatan">
                                        <div class="row" id="basic-table">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="datatables-basic table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama</th>
                                                                        <th>Email</th>
                                                                        <th>Jenis Kelamin</th>
                                                                        <th>Role</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $no = 0;
                                                                    ?>
                                                                    @foreach ($inactive as $item)
                                                                        <?php $no++; ?>
                                                                        <tr>
                                                                            <td>{{ $no }}</td>
                                                                            <td>{{ $item->name }}</td>
                                                                            <td>{{ $item->email }}</td>
                                                                            <td>
                                                                                @if ($item->gender == 1)
                                                                                    Pria
                                                                                @else
                                                                                    Wanita
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($item->gender == 1)
                                                                                    Admin
                                                                                @else
                                                                                    Operator
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:void(0)"
                                                                                    id="detail-user"
                                                                                    data-id="{{ \Crypt::encrypt($item->id) }}"
                                                                                    class="btn btn-icon rounded-circle btn-outline-primary"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Lihat">
                                                                                    <i data-feather='eye'></i>
                                                                                </a>
                                                                                <a href="javascript:void(0)"
                                                                                    id="edit-user"
                                                                                    data-id="{{ \Crypt::encrypt($item->id) }}"
                                                                                    class="btn btn-icon rounded-circle btn-outline-dark"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Edit">
                                                                                    <i data-feather="edit-2"></i>
                                                                                </a>
                                                                                <a href="javascript:void(0)"
                                                                                    id="activate-user"
                                                                                    data-id="{{ \Crypt::encrypt($item->id) }}"
                                                                                    class="btn btn-icon rounded-circle btn-outline-warning"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Aktifkan">
                                                                                    <i data-feather="user-check"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- User Card & Plan Ends -->
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>

        </div>
    </div>
    <!-- Modal edit -->
    <div class="modal fade text-start" id="modal-user" tabindex="-1" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabelUser"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    <label class="form-label">Email</label>
                                    <div class="mb-1">
                                        <input type="text" name="email" id="email" class="form-control"
                                            placeholder="Masukan email" required="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 pt-2">
                                <a onclick="cekEmail()" class="btn btn-info waves-effect">Check</a>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <div class="mb-1">
                                        <select class="select2 form-select" name="gender" id="gender" required>
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="1">Pria</option>
                                            <option value="2">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label">Role</label>
                                    <div class="mb-1">
                                        <select class="select2 form-select" name="role" id="role" required>
                                            <option value="" selected>Pilih Jenis Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Operator</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 group-password">
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <div class="mb-1">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Masukan Password" required="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 group-password">
                                <div class="form-group">
                                    <label class="form-label">Ketik Ulang Password</label>
                                    <div class="mb-1">
                                        <input type="password" name="repassword" id="repassword" class="form-control"
                                            placeholder="Masukan Ulang Password" required="" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="btn-save"
                                    value="create">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
