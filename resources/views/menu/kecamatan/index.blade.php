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
        $('body').on('click', '#delete-wilayah', function() {
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
                        url: "{{ url('hapus-tte') }}" + '/' + post_id,
                        success: function(data) {
                            $("#post_id_" + post_id).remove();
                            Swal.fire({
                                icon: 'success',
                                text: 'Data Berhasil dihapus.',
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

        $('body').on('click', '#activate-wilayah', function() {
            var post_id = $(this).data("id");
            Swal.fire({
                title: 'Apakah Anda Yakin Untuk Aktifkan Data Wilayah?',
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
                        url: "{{ url('activate-kecamatan') }}" + '/' + post_id,
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

        function getProvinsi(val) {
            $.ajax({
                url: '/provinsi-list',
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#provinsi').empty();
                        $('#provinsi').append('<option hidden>Pilih Provinsi</option>');
                        $.each(data, function(key, provinsi) {
                            if (val == null || val == 'null') {
                                $('select[name="provinsi"]').append('<option value="' + provinsi.id +
                                    '">' + provinsi.nama_daerah + '</option>');
                            } else {
                                if (provinsi.id == val) {
                                    $('select[name="provinsi"]').append('<option value="' + provinsi
                                        .id + '" selected>' + provinsi.nama_daerah + '</option>');
                                } else {
                                    $('select[name="provinsi"]').append('<option value="' + provinsi
                                        .id + '">' + provinsi.nama_daerah + '</option>');
                                }
                            }
                        });
                    } else {
                        $('#provinsi').empty();
                    }
                }
            });
        }
        function getKabupaten(provinsi_id,val) {
            $.ajax({
                url: '/kabupaten-list/'+provinsi_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#kabupaten').empty();
                        $('#kabupaten').append('<option hidden>Pilih Kabupaten</option>');
                        $.each(data, function(key, kabupaten) {
                            if (val == null || val == 'null') {
                                $('select[name="kabupaten"]').append('<option value="' + kabupaten.id +
                                    '">' + kabupaten.nama_daerah + '</option>');
                            } else {
                                if (kabupaten.id == val) {
                                    $('select[name="kabupaten"]').append('<option value="' + kabupaten
                                        .id + '" selected>' + kabupaten.nama_daerah + '</option>');
                                } else {
                                    $('select[name="kabupaten"]').append('<option value="' + kabupaten
                                        .id + '">' + kabupaten.nama_daerah + '</option>');
                                }
                            }
                        });
                    } else {
                        $('#kabupaten').empty();
                    }
                }
            });
        }
        $(document).ready(function() {
            $("#provinsi").change(function(){
                getKabupaten(this.value,null);
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#add-wilayah').click(function() {
                $('#btn-save').val("create-wilayah");
                $('#postForm').trigger("reset");
                $('#myModalLabelWilayah').html("Tambah Wilayah");
                $('#modal-wilayah').modal('show');
                var val = null;
                getProvinsi(val);
            });
            $('body').on('click', '#edit-wilayah', function() {
                var post_id = $(this).data('id');
                $.get('get-kecamatan/' + post_id, function(data) {
                    $('#myModalLabelWilayah').html("Edit Wilayah");
                    $('#btn-save').val("edit-wilayah");
                    $('#modal-wilayah').modal('show');
                    $('#kode').val(data.kode_daerah);
                    $('#nama').val(data.nama_daerah);
                    $("#btn-save").prop('disabled', false);
                    getProvinsi(data.kabupaten.provinsi_id);
                    getKabupaten(data.kabupaten.provinsi_id,data.kabupaten_id);
                })
            });
            $('body').on('click', '#detail-wilayah', function() {
                var post_id = $(this).data('id');
                $.get('get-provinsi/' + post_id, function(data) {
                    $('#myModalLabelWilayah').html("Edit Wilayah");
                    $(".group-password").hide();
                    $('#btn-save').val("edit-wilayah");
                    $('#modal-wilayah').modal('show');
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
            $('body').on('click', '#delete-wilayah', function() {
                var post_id = $(this).data("id");
                Swal.fire({
                    title: 'Hapus Data Kecamatan',
                    text: "Apakah anda yakin hapus data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus data',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ml-1'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('delete-kecamatan') }}" + '/' + post_id,
                            success: function(data) {
                                $("#post_id_" + post_id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Data berhasil dinonaktifkan.',
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
                    } else if (result.dismiss === Swal.DismissReason.cancel) {}
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

                        url: "{{ route('post-kecamatan') }}",
                        type: "POST",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            if (data.status_msg == true) {
                                $('#postForm').trigger("reset");
                                $('#modal-wilayah').modal('hide');
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
                    <div class="content-header row">
                        <div class="content-header-left col-md-9 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h2 class="content-header-title float-start mb-0">Data Kecamatan</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-body">
                        <div class="card profile-header mb-2">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" aria-expanded="true">
                                    <!-- profile info section -->
                                    <section id="profile-info">
                                        <div class="row" id="basic-table">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-end pb-0">
                                                        <a href="javascript:void(0)" id="add-wilayah" type="button"
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
                                                                        <th>Kode Daerah</th>
                                                                        <th>Nama Daerah</th>
                                                                        <th>Kabupaten</th>
                                                                        <th>Status</th>
                                                                        <th>Aksi</th>
                                                                    </tr>

                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $no = 1;
                                                                    ?>
                                                                    @foreach ($data as $item)
                                                                        <tr>
                                                                            <td>{{ $no++ }}</td>
                                                                            <td>{{ $item->kode_daerah }}</td>
                                                                            <td>{{ $item->nama_daerah }}</td>
                                                                            <td>{{ $item->kabupaten->nama_daerah }}</td>
                                                                            <td>
                                                                                @if ($item->status == 1)
                                                                                    <div class="badge badge-light-success">
                                                                                        Aktif
                                                                                    </div>
                                                                                @else
                                                                                    <div class="badge badge-light-danger">
                                                                                        Tidak Aktif
                                                                                    </div>
                                                                                @endif
                                                                            </td>

                                                                            <td>
                                                                                <a href="{{ url('detail-view-kecamatan', \Crypt::encrypt($item->id)) }}"
                                                                                    id="detail-wilayah" data-id=""
                                                                                    class="btn btn-icon rounded-circle btn-outline-primary"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Lihat">
                                                                                    <i data-feather='eye'></i>
                                                                                </a>
                                                                                <a href="javascript:void(0)"
                                                                                    id="edit-wilayah"
                                                                                    data-id="{{ \Crypt::encrypt($item->id) }}"
                                                                                    class="btn btn-icon rounded-circle btn-outline-dark"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Edit">
                                                                                    <i data-feather="edit-2"></i>
                                                                                </a>
                                                                                @if ($item->status == 1)
                                                                                    <a href="javascript:void(0)"
                                                                                        id="delete-wilayah"
                                                                                        data-id="{{ \Crypt::encrypt($item->id) }}"
                                                                                        class="btn btn-icon rounded-circle btn-outline-danger"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Non Aktifkan">
                                                                                        <i data-feather="x"></i>
                                                                                    </a>
                                                                                @else
                                                                                    <a href="javascript:void(0)"
                                                                                        id="activate-wilayah"
                                                                                        data-id="{{ \Crypt::encrypt($item->id) }}"
                                                                                        class="btn btn-icon rounded-circle btn-outline-warning"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Aktifkan">
                                                                                        <i data-feather="check"></i>
                                                                                    </a>
                                                                                @endif

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
    <div class="modal fade text-start" id="modal-wilayah" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabelWilayah"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card-body">
                    <form id="postForm" name="postForm">
                        <input type="hidden" name="post_id" id="post_id">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label">Pilih Provinsi</label>
                                    <div class="mb-1">
                                        <select class="form-control select2" name="provinsi" id="provinsi"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label">Pilih Kabupaten</label>
                                    <div class="mb-1">
                                        <select class="form-control select2" name="kabupaten" id="kabupaten"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label">Kode Wilayah</label>
                                        <div class="mb-1">
                                            <input type="text" name="kode" id="kode" class="form-control"
                                                placeholder="Masukan Kode Wilayah" required="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label">Nama Wilayah</label>
                                        <div class="mb-1">
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                placeholder="Masukan Nama Wilayah" required="" />
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
