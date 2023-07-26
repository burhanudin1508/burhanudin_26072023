@extends('layout.main')

@section('custom-css')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #5e71c0;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #5e71c0;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
@endsection

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-12">
                            <h2 class="content-header-title float-start mb-0">{{ $title }}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Beranda</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Data Master User</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $title }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i class="me-1" data-feather="filter"></i><span
                                        class="align-middle">Filter</span></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="content-body">
                <div class="row" id="basic-table">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-end pb-0">
                        {{-- <a onclick="tess()" class="btn btn-outline-primary me-1">
                            <i data-feather="file" class="me-25"></i>
                            <span>tess</span>
                        </a> --}}
                                <a href="javascript:void(0)" id="add-user" type="button" class="btn btn-primary">
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
                                                <th>Nama Lengkap</th>
                                                <th>Tempat, Tanggal Lahir</th>
                                                <th>No Hp</th>
                                                <th>Alamat</th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; ?>
                                            @foreach ($data as $data)
                                                <?php $no++; ?>
                                                <tr>
                                                    <td>{{ $no }}</td>
                                                    <td>{{ $data->nama_lengkap }}</td>
                                                    <td>{{ $data->tempat_lahir }}, {{ $data->tanggal_lahir }}</td>
                                                    <td>{{ $data->no_hp }}</td>
                                                    <td>{{ $data->alamat }}</td>
                                                    <td>
                                                        
                                                        <div class="badge badge-light-primary">User</div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" id="edit-jabatan"
                                                            data-id="{{ $data->id }}"
                                                            class="btn btn-icon rounded-circle btn-outline-dark"
                                                            data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i data-feather="edit-2"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" id="delete-user"
                                                            data-id="{{ $data->id }}"
                                                            class="btn btn-icon rounded-circle btn-outline-danger"
                                                            data-toggle="tooltip" data-placement="top" title="Hapus">
                                                            <i data-feather="trash"></i>
                                                        </a>
                                                        {{-- <a href="javascript:void(0)" id="reset-pass"
                                                            data-id="{{ $data->id }}"
                                                            class="btn btn-icon rounded-circle btn-outline-primary"
                                                            data-toggle="tooltip" data-placement="top" title="Reset Password"></i> 
                                                            <i data-feather='sliders'></i>
                                                        </a> --}}
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
            </div>

            <!-- Modal edit -->
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
                                            <label class="form-label">Username</label>
                                            <div class="mb-1">
                                                <input type="text" name="username" id="username" class="form-control"
                                                    placeholder="Masukan Username" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <a onclick="cekUsername()" class="btn btn-info waves-effect">Check</a>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label">NIK</label>
                                            <div class="mb-1">
                                                <input type="number" id="nik" name="nik" class="form-control"
                                                    placeholder="Masukan NIK" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Jabatan</label>
                                            <div class="mb-1">
                                                <input type="text" name="jabatan" id="jabatan" class="form-control"
                                                    placeholder="Masukan jabatan" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <div class="mb-1">
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="Masukan Email" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Role</label>
                                            <div class="mb-1">
                                                <select class="select2 form-select" name="role" id="role" required>
                                                    <option value="1">Super Admin</option>
                                                    <option value="2">User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Status Pegawai</label>
                                            <div class="mb-1">
                                                <select class="select2 form-select" name="is_external" id="is_external"
                                                    required>
                                                    <option value="0">Internal</option>
                                                    <option value="1">External</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12" id="input-password">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <div class="mb-1">
                                                {{-- <div class="input-group input-group-merge form-password-toggle">
                                                    <input class="form-control form-control-merge" id="password"
                                                        pattern="[0-9]*" inputmode="text" type="password" name="password"
                                                        placeholder="Masukan Password" aria-describedby="login-password"
                                                        required /><span
                                                        class="input-group-text cursor-pointer"><i
                                                            data-feather="eye"></i></span>
                                                </div> --}}
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Masukan Password" required/>
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

            <!-- Modal reset pass -->
            <div class="modal fade text-start" id="modal-reset" tabindex="-1" aria-labelledby="myModalLabel1"aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabelPass"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="card-body">
                            <form id="postForm" name="postForm">
                                <input type="hidden" name="post_id" id="post_id">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Password Baru</label>
                                            <div class="mb-1">
                                                <input type="hidden" id="reset-id" />
                                                <div class="input-group input-group-merge form-password-toggle">
                                                    <input class="form-control form-control-merge" id="password-baru"
                                                        pattern="[0-9]*" inputmode="text" type="password" name="password"
                                                        placeholder="Masukan Password" aria-describedby="login-password"
                                                        required /><span
                                                        class="input-group-text cursor-pointer"><i
                                                            data-feather="eye"></i></span>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Password Anda</label>
                                            <div class="mb-1">
                                                <div class="input-group input-group-merge form-password-toggle">
                                                    <input class="form-control form-control-merge" id="password-anda"
                                                        pattern="[0-9]*" inputmode="text" type="password" name="password"
                                                        placeholder="Masukan Password" aria-describedby="login-password"
                                                        required /><span
                                                        class="input-group-text cursor-pointer"><i
                                                            data-feather="eye"></i></span>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <a href="javascript:void(0)" onclick="reset()"  class="btn btn-primary"
                                            value="create">Simpan</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        $('.SwitchStatus').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            console.log(status);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Edit it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('status-user') }}" + '/' + id,
                        data: {
                            'status': status,
                            'id': id
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Edited!',
                                text: 'Your file has been Edited.',
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
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your imaginary file is safe :)',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {
                            location.reload();
                        }
                    });
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
            $('body').on('click', '#edit-jabatan', function() {
                var post_id = $(this).data('id');
                $.get('edit-user/' + post_id + '/ubah', function(data) {
                    $('#myModalLabelUser').html("Edit User");
                    $('#btn-save').val("edit-jabatan");
                    $('#modal-user').modal('show');
                    $("#input-password").hide();
                    $("#password").hide();
                    $('#post_id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#username').val(data.username);
                    $('#nik').val(data.nik);
                    $('#jabatan').val(data.jabatan);
                    $('#email').val(data.email);
                    $("#role").val(data.role).trigger('change');
                    $("#is_external").val(data.is_external).trigger('change');
                    $('#kode_unit_kerja').val(data.kode_unit_kerja);
                    $("#btn-save").prop('disabled', false);
                })
            });
            $('body').on('click', '#delete-user', function() {
                var post_id = $(this).data("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ml-1'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('hapus-user') }}" + '/' + post_id,
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
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'Your imaginary file is safe :)',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
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
                            $('#postForm').trigger("reset");
                            $('#modal-user').modal('hide');
                            Swal.fire({
                                title: 'Berhasil!!!',
                                // text: 'Data Berhasil Ditambah!',
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
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#btn-save').html('Save Changes');
                        }
                    });
                }
            })
        }
    </script>
@endsection
