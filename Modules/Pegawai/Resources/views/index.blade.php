@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Pegawai</h5>
                <div class="header-elements">
                    <div class="btn-group">
                        <button class="btn bg-warning kalkulasi">
                            <i class="icon-reset"></i>
                            Kalkulasi Masa Kerja
                        </button>

                        <button class="btn bg-success" data-toggle="modal" data-target="#mUser">
                            <i class="icon-add"></i>
                            Tambah
                        </button>
                    </div>
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
                                        <input type="hidden" name="id">
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
                                        <select name="status_kawin" class="form-control status_kawin">
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
                                        <select name="bankID" class="form-control bankID">
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
                                        <select name="status_pegawai" class="form-control status_pegawai">
                                            @foreach($statusPegawai as $status)
                                                <option value="{{ $status->id }}">{{ $status->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Unit</label>
                                        <select name="unitID" class="form-control unitID">
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
                                        <select name="strukturalID" class="form-control strukturalID">
                                            <option selected value>Tidak ada</option>
                                            @foreach($jabatanStruktural as $struktural)
                                                <option value="{{ $struktural->id }}">{{ $struktural->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Fungsional</label>
                                        <select name="fungsionalID" class="form-control fungsionalID">
                                            <option selected value>Tidak ada</option>
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
                                        <select name="aktif" class="form-control aktif">
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

        $('.kalkulasi').on('click',function () {
            new Noty({
                theme: ' alert bg-success text-white alert-styled-left p-0',
                text: 'Sedang Mengkalkulasi, mohon menunggu.',
                type: 'success',
                progressBar: true,
            }).show();
            $('.dtpegawai').LoadingOverlay("show", {
                image: "",
                fontawesome: "fa fa-cog fa-spin"
            });

            $.ajax({
                url: '{{ route('pegawai.pegawai.kalkulasi') }}',
                type: 'PATCH',
                success: function (response) {
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
                    dtpegawai.ajax.reload();
                    $('.dtpegawai').LoadingOverlay("hide");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });


        });


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
                let active = '', gelar_depan = '', nama = '', gelar_belakang = '';
                if (data.active === 0)
                    active = '<span class="badge badge-danger">Banned</span>';

                if (data.gelar_depan){
                    gelar_depan = data.gelar_depan;
                }

                if (data.gelar_belakang){
                    gelar_belakang = ", "+data.gelar_belakang;
                }

                nama = data.nama;

                $('td:eq(3)', row).html(gelar_depan+' '+nama+gelar_belakang);
                $('td:eq(4)', row).html(data.golonganID+''+data.ruangID);
                $('td:eq(5)', row).html(data.masa_kerja+' Tahun');

                $('td:eq(6)', row).html('<div class="btn-group">' +
                    '<button type="button" class="btn btn-sm btn-success editUsers"' +
                    ' data-id="' + data.id + '" data-nik="' + data.nik + '"' + '" data-gender="' + data.gender + '"' + '" data-gelar_depan="' + data.gelar_depan + '"' +
                    ' data-nama="' + data.nama + '" data-gelar_belakang="' + data.gelar_belakang + '"' + '" data-tempat_lahir="' + data.tempat_lahir + '"' + '" data-tanggal_lahir="' + data.tanggal_lahir + '"' +
                    ' data-alamat="' + data.alamat + '" data-unitid="' + data.unitID + '"' + '" data-status_kawin="' + data.status_kawin + '"' + '" data-jumlah_tanggungan="' + data.jumlah_tanggungan + '"' +
                    ' data-status_pegawai="' + data.status_pegawai + '" data-tanggal_masuk="' + data.tanggal_masuk + '"' + '" data-masa_kerja="' + data.masa_kerja + '"' + '" data-golonganid="' + data.golonganID + '"' +
                    ' data-ruangid="' + data.ruangID + '" data-strukturalid="' + data.strukturalID + '"' + '" data-fungsionalid="' + data.fungsionalID + '"' + '" data-bankid="' + data.bankID + '"' +
                    ' data-nomor_rekening="' + data.nomor_rekening + '" data-npwp="' + data.npwp + '"' + '" data-aktif="' + data.aktif + '"' +
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
                    modal.find('input[name="strukturalID"]').val(null);
                    modal.find('input[name="fungsionalID"]').val(null);
                    modal.find('input[name="id"]').val(data.id);
                    modal.find('input[name="nik"]').val(data.nik);
                    modal.find('input[name="gender"]').val(data.gender);
                    modal.find('input[name="gelar_depan"]').val(data.gelar_depan);
                    modal.find('input[name="nama"]').val(data.nama);
                    modal.find('input[name="gelar_belakang"]').val(data.gelar_belakang);
                    modal.find('input[name="tempat_lahir"]').val(data.tempat_lahir);
                    modal.find('input[name="tanggal_lahir"]').val(data.tanggal_lahir);
                    modal.find('input[name="alamat"]').val(data.alamat);
                    modal.find('.unitID').val(data.unitid).trigger('change');
                    modal.find('.status_kawin').val(data.status_kawin).trigger('change');
                    modal.find('input[name="jumlah_tanggungan"]').val(data.jumlah_tanggungan);
                    modal.find('.status_pegawai').val(data.status_pegawai).trigger('change');
                    modal.find('input[name="tanggal_masuk"]').val(data.tanggal_masuk);
                    modal.find('input[name="masa_kerja"]').val(data.masa_kerja);
                    modal.find('input[name="golonganID"]').val(data.golonganid);
                    modal.find('input[name="ruangID"]').val(data.ruangid);
                    modal.find('.strukturalID').val(data.strukturalid).trigger('change');
                    modal.find('.fungsionalID').val(data.fungsionalid).trigger('change');
                    modal.find('.bankID').val(data.bankid).trigger('change');
                    modal.find('input[name="nomor_rekening"]').val(data.nomor_rekening);
                    modal.find('input[name="npwp"]').val(data.npwp);
                    modal.find('.aktif').val(data.aktif);
                });
            }
        });

    </script>
@endsection
