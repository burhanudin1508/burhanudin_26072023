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

        .card2 {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 40%;
            border-radius: 5px;
        }

        .card2:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        img {
            border-radius: 5px 5px 0 0;
        }

        .container {
            padding: 2px 16px;
        }
        .main {
  background-image: url("https://images.unsplash.com/photo-1556742205-e10c9486e506?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60");
  color: #00cc65;
  width: 500px;
  padding-left: 25px;
  padding-top: 10rem;
}
    </style>
@endsection

@section('custom-js')
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        function downloadimage() {
                /*var container = document.getElementById("image-wrap");*/ /*specific element on page*/
                document.getElementById('unduh').style.display = 'none';
                var container = document.getElementById("htmltoimage");; /* full page */
                html2canvas(container, { allowTaint: false,
    useCORS: false}).then(function (canvas) {

                    var link = document.createElement("a");
                    document.body.appendChild(link);
                    link.download = "BestCard.jpg";
                    link.href = canvas.toDataURL();
                    link.target = '_blank';
                    link.click();
                });
                document.getElementById('unduh').style.display = 'block';
            }
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
                        url: "{{ url('activate-desa') }}" + '/' + post_id,
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

        function getKabupaten(provinsi_id, val) {
            $.ajax({
                url: '/kabupaten-list/' + provinsi_id,
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

        function getKecamatan(kab_id, val) {
            $.ajax({
                url: '/kecamatan-list/' + kab_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#kecamatan').empty();
                        $('#kecamatan').append('<option hidden>Pilih Kecamatan</option>');
                        $.each(data, function(key, kecamatan) {
                            if (val == null || val == 'null') {
                                $('select[name="kecamatan"]').append('<option value="' + kecamatan.id +
                                    '">' + kecamatan.nama_daerah + '</option>');
                            } else {
                                if (kecamatan.id == val) {
                                    $('select[name="kecamatan"]').append('<option value="' + kecamatan
                                        .id + '" selected>' + kecamatan.nama_daerah + '</option>');
                                } else {
                                    $('select[name="kecamatan"]').append('<option value="' + kecamatan
                                        .id + '">' + kecamatan.nama_daerah + '</option>');
                                }
                            }
                        });
                    } else {
                        $('#kecamatan').empty();
                    }
                }
            });
        }

        function getDesa(kec_id, val) {
            $.ajax({
                url: '/desa-list/' + kec_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#desa').empty();
                        $('#desa').append('<option hidden>Pilih Desa</option>');
                        $.each(data, function(key, desa) {
                            if (val == null || val == 'null') {
                                $('select[name="desa"]').append('<option value="' + desa.id +
                                    '">' + desa.nama_daerah + '</option>');
                            } else {
                                if (desa.id == val) {
                                    $('select[name="desa"]').append('<option value="' + desa
                                        .id + '" selected>' + desa.nama_daerah + '</option>');
                                } else {
                                    $('select[name="desa"]').append('<option value="' + desa
                                        .id + '">' + desa.nama_daerah + '</option>');
                                }
                            }
                        });
                    } else {
                        $('#desa').empty();
                    }
                }
            });
        }
        $(document).ready(function() {
            
        getProvinsi(null);
        $("#provinsi").change(function() {
            getKabupaten(this.value, null);
        });
        $("#kabupaten").change(function() {
            getKecamatan(this.value, null);
        });
        $("#kecamatan").change(function() {
            getDesa(this.value, null);
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
            $.get('get-desa/' + post_id, function(data) {
                $('#myModalLabelWilayah').html("Edit Wilayah");
                $('#btn-save').val("edit-wilayah");
                $('#modal-wilayah').modal('show');
                $('#kode').val(data.kode_daerah);
                $('#nama').val(data.nama_daerah);
                $("#btn-save").prop('disabled', false);
                getProvinsi(data.kecamatan.kabupaten.provinsi_id);
                getKabupaten(data.kecamatan.kabupaten.provinsi_id, data.kecamatan.kabupaten_id);
                getKecamatan(data.kecamatan.kabupaten_id, data.kecamatan.id);
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
                title: 'Hapus Data Desa',
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
                        url: "{{ url('delete-desa') }}" + '/' + post_id,
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

                        url: "{{ route('post-pasien') }}",
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
                                    <h2 class="content-header-title float-start mb-0">Tambah Pasien</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $id = $data->id;
                    $date = strtotime($data->created_at);
                    $created_at = date('ym', $date);
                    $id_pasien = $created_at . sprintf('%05s', $id);
                    ?>

                    <div class="content-body">
                        <div class="card profile-header mb-2">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" aria-expanded="true">
                                    <!-- profile info section -->
                                    <section id="profile-info">
                                        <div class="card-body">
                                            <div id="">
                                                <div class="card2" style="float:right" id="htmltoimage">
                                                    <img src="{{ asset('app-assets/images/logo/logo.png') }}"
                                                        alt="Avatar" style="width:100%">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-6" style="float: left">

                                                                <h4><b>{{ $data->nama }}</b></h4>
                                                                <p>{{ $id_pasien }}</p>
                                                            </div>
                                                            <div class="col-sm-6" style="float: right">
                                                                <img src="{{ asset('app-assets/images/barcode.png') }}"
                                                                    alt="" style="width: 70%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="float: right">

                                                        <button onclick="downloadimage()"
                                                            class="btn btn-primary" id="unduh"
                                                            value="create">Unduh</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="postForm" name="postForm">
                                                <input type="hidden" name="post_id" id="post_id">
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Nomor ID Pasien</label>
                                                            <div class="mb-1">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Nama Lengkap" value="{{ $id_pasien }}"
                                                                    disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Nama Lengkap</label>
                                                            <div class="mb-1">
                                                                <input type="text" name="nama" id="nama"
                                                                    class="form-control" placeholder="Nama Lengkap"
                                                                    required="" value="{{ $data->nama }}" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Jenis Kelamin</label>
                                                            <div class="mb-1">
                                                                <select class="form-control select2" name="jenis_kelamin"
                                                                    id="jenis_kelamin" required disabled>
                                                                    <option value="" selected>Pilih Jenis Kelamin
                                                                    </option>
                                                                    @if ($data->jenis_kelamin == 1)
                                                                        <option value="1" selected>Pria</option>
                                                                        <option value="2">Wanita</option>
                                                                    @else
                                                                        <option value="1">Pria</option>
                                                                        <option value="2" selected>Wanita</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Tempat Lahir</label>
                                                            <div class="mb-1">
                                                                <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                                    class="form-control" placeholder="Masukan No Telpon"
                                                                    required="" value="{{ $data->tempat_lahir }}"
                                                                    disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Tanggal Lahir</label>
                                                            <div class="mb-1">
                                                                <input type="date" name="tanggal_lahi"
                                                                    id="tanggal_lahir" class="form-control"
                                                                    value="{{ $data->tanggal_lahir }}"
                                                                    placeholder="Tanggal lahir" required="" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">No Telpon</label>
                                                            <div class="mb-1">
                                                                <input type="text" name="no_telpon" id="no_telpon"
                                                                    class="form-control" placeholder="Masukan No Telpon"
                                                                    required="" disabled
                                                                    value="{{ $data->no_telpon }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <div class="mb-1">
                                                                <input type="email" name="email" id="email"
                                                                    class="form-control" placeholder="Masukan Email"
                                                                    required="" disabled value={{ $data->email }} />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Pilih Provinsi</label>
                                                            <div class="mb-1">
                                                                <input class="form-control" name="provinsi"
                                                                    id="provinsi"
                                                                    value="{{ $data->provinsi->nama_daerah }}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Pilih Kabupaten</label>
                                                            <div class="mb-1">
                                                                <input class="form-control" name="kabupaten"
                                                                    id="kabupaten"
                                                                    value="{{ $data->kabupaten->nama_daerah }}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Pilih Kecamatan</label>
                                                            <div class="mb-1">
                                                                <input class="form-control" name="kecamatan"
                                                                    id="kecamatan"value="{{ $data->kecamatan->nama_daerah }}"
                                                                    disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Pilih Desa/Kelurahan</label>
                                                            <div class="mb-1">
                                                                <input class="form-control" name="desa" id="desa"
                                                                    value="{{ $data->desa->nama_daerah }}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">RW</label>
                                                            <div class="mb-1">
                                                                <input type="text" name="rw" id="rw"
                                                                    class="form-control" placeholder="RW"
                                                                    required=""disabled value="{{ $data->rw }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">RT</label>
                                                            <div class="mb-1">
                                                                <input type="text" name="rt" id="rt"
                                                                    class="form-control" placeholder="RT" required=""
                                                                    disabled value="{{ $data->rt }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Alamat Lengkap</label>
                                                            <div class="mb-1">
                                                                <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan Amat Lengkap"
                                                                    cols="30" rows="10" required="" disabled>{{ $data->alamat }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button onclick="window.history.go(-1); return false;"
                                                            class="btn btn-primary" id="btn-save"
                                                            value="create">Kembali</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </section>
                                    <!--/ profile info section -->
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
    {{-- <div class="modal fade text-start" id="modal-wilayah" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label class="form-label">Pilih Kecamatan</label>
                                    <div class="mb-1">
                                        <select class="form-control select2" name="kecamatan" id="kecamatan"></select>
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
    </div> --}}
@endsection
