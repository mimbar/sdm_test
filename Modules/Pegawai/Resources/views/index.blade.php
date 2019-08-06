@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Pegawai</h5>
                <div class="header-elements">
                    <button class="btn bg-success" data-toggle="modal" data-target="#mUser">
                        <i class="icon-add"></i>
                        Tambah
                    </button>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-hover table-sm dtpegawai" style="width: 100%">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Unit Kerja</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Golongan - Pangkat</th>
                        <th>Masa Kerja</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div id="mUser" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="nav-item"><a href="#dataPribadi" class="nav-link active" data-toggle="tab">Data
                                Pribadi</a></li>
                        <li class="nav-item"><a href="#dataKepegawaian" class="nav-link" data-toggle="tab">Data
                                Kepegawaian</a></li>
                        <li class="nav-item"><a href="#dataKeuangan" class="nav-link" data-toggle="tab">Data
                                Keuangan</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="dataPribadi">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Gelar Depan</label>
                                        <input type="text" placeholder="Gelar Depan" name="gelar_depan"
                                               class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Nama Lengkap (Tanpa Gelar)</label>
                                        <input type="text" placeholder="Nama Lengkap" name="nama" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Gelar Belakang</label>
                                        <input type="text" placeholder="Gelar Belakang" name="gelar_belakang"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tempat Lahir</label>
                                        <input type="text" placeholder="Tempat Lahir" name="tempat_lahir"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" placeholder="Tanggal Lahir" name="tanggal_lahir"
                                               class="form-control singleDP" readonly="readonly">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Status Kawin</label>
                                        <select name="status_kawin" class="form-control">
                                            <option selected disabled>== Pilih ==</option>
                                            @foreach($statusKawin as $status)
                                                <option value="{{ $status->id }}">{{ $status->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Jumlah Tanggungan (Anak)</label>
                                        <input type="text" placeholder="Jumlah Tanggungan" name="jumlah_tanggungan"
                                               class="form-control" value="0">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="dataKeuangan">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Bank</label>
                                        <select name="bankID" class="form-control">
                                            @foreach($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Nomor Rekening</label>
                                        <input type="text" placeholder="Nomor Rekening" name="nomor_rekening"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="dataKepegawaian">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Tanggal Masuk Bekerja</label>
                                        <input type="text" name="tanggal_masuk" class="form-control singleDP" readonly="readonly">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Masa Kerja (Tahun)</label>
                                        <input type="text" name="masa_kerja" class="form-control" disabled="disabled" value="0">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Status Kepegawaian</label>
                                        <select name="status_pegawai" class="form-control">
                                            @foreach($statusPegawai as $status)
                                                <option value="{{ $status->id }}">{{ $status->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Unit</label>
                                        <select name="unitID" class="form-control">
                                            @foreach($unitkerja as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>NIK</label>
                                        <input type="text" placeholder="NIK" name="nik" class="form-control">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>NPWP</label>
                                        <input type="text" placeholder="NPWP" name="npwp"
                                               data-mask="99.999.999.9-999.999"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Golongan</label>
                                        <input type="text" placeholder="Golongan" name="golonganID"
                                               class="form-control">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Ruang</label>
                                        <input type="text" placeholder="Ruang" name="ruangID"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Struktural</label>
                                        <select name="strukturalID" class="form-control">
                                            <option>Tidak ada</option>
                                            @foreach($jabatanStruktural as $struktural)
                                                <option value="{{ $struktural->id }}">{{ $struktural->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Fungsional</label>
                                        <select name="fungstionalID" class="form-control">
                                            <option>Tidak ada</option>
                                            @foreach($jabatanFungsional as $fungsional)
                                                <option value="{{ $fungsional->id }}">{{ $fungsional->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Aktif</label>
                                        <select name="aktif" class="form-control">
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn bg-primary save">Simpan</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        let timeout = null,
            checkEmail = $('.checkEmail'),
            checkUsername = $('.checkUsername'),
            statusEmail = $('.statusEmail'),
            statusUsername = $('.statusUsername'), modal = $('#mUser');


        // modal.on('show.bs.modal', function () {
        //     checkUsername.removeClass('border-danger');
        //     checkUsername.addClass('border-success');
        //     statusUsername.addClass('d-none');
        //     checkEmail.removeClass('border-danger');
        //     checkEmail.addClass('border-success');
        //     statusEmail.addClass('d-none');
        //     $(this).find(':input').val('');
        //     $(this).find('.active').val(1);
        //     $(this).find('.rolesid').val(2);
        //     $(this).find('input[name="username"]').removeAttr('disabled');
        //     $(this).find('input[name="email"]').removeAttr('disabled');
        // });

        $('.save').on('click', function (e) {
            let modal = $('#mUser'),
                id = modal.find('input[name="id"]').val(),
                values = $(':input').serialize(), url, method;
            if ($.isNumeric(id)) {
                url = '{{ route("pegawai.pegawai.update") }}';
                method = 'PATCH';
            } else {
                url = '{{ route("pegawai.pegawai.create") }}';
                method = 'POST';
            }

            $.ajax({
                url: url,
                type: method,
                data: values,
                success: function (response) {
                    $(':input').val('');
                    if (response.code === 200) {
                        new Noty({
                            theme: ' alert bg-success text-white alert-styled-left p-0',
                            text: 'Data Berhasil disimpan.',
                            type: 'success',
                            progressBar: true,
                        }).show();
                        dtpegawai.ajax.reload();
                    } else if (response.code === 500) {
                        new Noty({
                            theme: ' alert bg-danger text-white alert-styled-left p-0',
                            text: 'Data Gagal disimpan. ' + response.message,
                            type: 'danger',
                            progressBar: true,
                        }).show();
                    } else {
                        alert('Hubungi Admin!');
                    }
                    modal.modal('toggle');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        });

        let dtpegawai = $('.dtpegawai').DataTable({
            "scrollX": true,
            "searching": false,
            "ordering": false,
            scrollY: 350,
            scrollCollapse: true,
            retrieve: true,
            stateSave: true,
            bSort: false,
            paging: false,
            info: false,
            "ajax": {
                "url": "{{ route('dt.pegawai.all') }}",
            },
            columns: [
                {
                    "className": "text-bold text-center",
                    defaultContent: '-',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": 'unit.nama',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: true
                },
                {
                    "data": 'nik',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: true
                },
                {
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: true
                },
                {
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: false
                },
                {
                    "data": 'masa_kerja',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: false
                },
                {
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: false
                }
            ],
            "rowCallback": function (row, data) {
                let active = '';
                if (data.active === 0)
                    active = '<span class="badge badge-danger">Banned</span>';


                $('td:eq(5)', row).html('<div class="btn-group">' +
                    '<button type="button" class="btn btn-sm btn-success editUsers"' +
                    ' data-id="' + data.id + '" data-name="' + data.name + '"' + '" data-username="' + data.username + '"' + '" data-email="' + data.email + '"' +
                    ' >' +
                    '<i class="fa fa-edit"></i> Sunting' +
                    '</button>' +
                    '</div>');
            },
            "drawCallback": function () {
                $('.editUsers').on('click', function (e) {
                    let data = $(this).data();
                    modal.modal('toggle');
                    $(':input').val('');
                    modal.find('input[name="id"]').val(data.id);
                    modal.find('input[name="username"]').val(data.username).attr('disabled', 'disabled');
                    modal.find('input[name="email"]').val(data.email).attr('disabled', 'disabled');
                    modal.find('input[name="name"]').val(data.name);
                    modal.find('.rolesid').val(data.roles);
                    modal.find('.active').val(data.active);
                });

                $('.deleteRole').on('click', function (e) {
                    let id = parseInt($(this).data('id'));
                    swal({
                        title: 'Akan Menghapus data?',
                        text: "Role akan dihapus. Silakan ganti user dengan role tersebut!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batalkan',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false
                    }).then(function (result) {
                        if (result.value) {
                            $.ajax({
                                url: '{!! route('kitchen.roles.delete') !!}',
                                type: "DELETE",
                                data: {
                                    id: id
                                },
                                success: function (response) {
                                    $('.form input').val('');
                                    $('.form input').attr('disabled', 'disabled');
                                    $('.form button').attr('disabled', 'disabled');
                                    $('#form').removeAttr('action');
                                    if (response.code === 200) {
                                        new Noty({
                                            theme: ' alert bg-success text-white alert-styled-left p-0',
                                            text: 'Data Berhasil dihapus.',
                                            type: 'success',
                                            progressBar: true,
                                        }).show();
                                        dtpegawai.ajax.reload();
                                    } else if (response.code === 500) {
                                        new Noty({
                                            theme: ' alert bg-danger text-white alert-styled-left p-0',
                                            text: 'Data Gagal dihapus.',
                                            type: 'danger',
                                            progressBar: true,
                                        }).show();
                                    } else {
                                        alert('Hubungi Admin!');
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel) {
                            swal(
                                'Dibatalkan!',
                                'Role tidak dihapus',
                                'error'
                            );
                        }
                    });
                });
            }
        });

    </script>
@endsection
