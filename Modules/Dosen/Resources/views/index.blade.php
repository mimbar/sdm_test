@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Data Dosen</h5>
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
                <table class="table table-hover table-sm dtdosen" style="width: 100%">
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
                    <h5 class="modal-title">Data Dosen</h5>
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
                        <li class="nav-item"><a href="#datauploadfoto" class="nav-link" data-toggle="tab">Upload Foto</a></li>
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
                                    <div class="col-sm-4">
                                        <label>Nomor Rekening Mandiri</label>
                                        <input name="norek_mandiri" type="text" placeholder="Nomor Rekening Mandiri"
                                               class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Nomor Rekening BJB</label>
                                        <input name="norek_bjb" type="text" placeholder="Nomor Rekening BJB"
                                               class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Nomor Rekening BJBS</label>
                                        <input name="norek_bjbs" type="text" placeholder="Nomor Rekening BJBS"
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
                                    <div class="col-sm-4">
                                        <label>Status Dosen</label>
                                        <select name="status_dosen" class="form-control status_dosen">
                                            @foreach($statusDosen as $status)
                                                <option value="{{ $status->id }}">{{ $status->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Unit</label>
                                        <select name="unitID" class="form-control unitID">
                                            @foreach($unitkerja as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Mata Kuliah</label>
                                        <select name="matkulID" class="form-control matkulID">
                                            @foreach($mata_kuliah as $matkul)
                                                <option value="{{ $matkul->id }}">{{ $matkul->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>NIDN</label>
                                        <input type="text" placeholder="Nomor Induk Dosen Nasional" name="nidn" class="form-control">
                                    </div>

                                    <div class="col-sm-4">
                                        <label>NIP</label>
                                        <input type="text" placeholder="Nomor Induk Pegawai" name="nip" class="form-control">
                                    </div>

                                    <div class="col-sm-4">
                                        <label>NIK</label>
                                        <input type="text" placeholder="Nomor Induk Karyawan" name="nopeg"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Nomor Induk Kependudukan</label>
                                        <input type="text" placeholder="NIK" name="nik" class="form-control">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>NPWP</label>
                                        <input type="text" placeholder="NPWP" name="npwp"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Golongan</label>
                                        <select name="golonganID" class="form-control golonganID">
                                            <option value="-">-</option>
                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Ruang</label>
                                        <select name="ruangID" class="form-control ruangID">
                                            <option value="-">-</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select>
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
                                    <div class="col-md-6">
                                        <label>Status PNS Pegawai</label>
                                        <select name="pns_status" class="form-control">
                                            <option value="0">Non-PNS</option>
                                            <option value="1">PNS</option>
                                            <option value="2">Tenaga Harian Lepas</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Aktif</label>
                                        <select name="aktif" class="form-control aktif">
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="datauploadfoto">
                            <form action="dosen/upload" class="dropzone" id="my-awesome-dropzone"
                                  enctype="multipart/form-data"></form>
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
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone('.dropzone', {
            paramName: "file",
            dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
            maxFilesize: 200,
            acceptedFiles: ".jpg, .jpeg, .png, .JPG, .JPEG",
            dictInvalidFileType: "Jenis File tidak diizinkan",
            addRemoveLinks: false,
            success: function (file, response) {
                if (response.code === 200) {
                    file.previewElement.classList.add("dz-success");
                    theFiles[file.name] = {"file_name" : response.file_name };
                } else if (response.code === 500) {
                    file.previewElement.classList.add("dz-error");
                }
            },
            removedfile: function (file) {
                $.post(
                    "rab/kaktor/delete",
                    {
                        file_name: theFiles[file.name].file_name
                    }
                );
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });

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
            $('.dtdosen').LoadingOverlay("show", {
                image: "",
                fontawesome: "fa fa-cog fa-spin"
            });

            $.ajax({
                url: '{{ route('dosen.dosen.kalkulasi') }}',
                type: 'PATCH',
                success: function (response) {
                    if (response.code === 200) {
                        new Noty({
                            theme: ' alert bg-success text-white alert-styled-left p-0',
                            text: 'Data Berhasil disimpan.',
                            type: 'success',
                            progressBar: true,
                        }).show();
                        dtdosen.ajax.reload();
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
                    dtdosen.ajax.reload();
                    $('.dtdosen').LoadingOverlay("hide");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });


        });


        $('.save').on('click', function (e) {
            $('body').LoadingOverlay("show", {
                image: "",
                fontawesome: "fa fa-cog fa-spin"
            });
            let modal = $('#mUser'),
                id = modal.find('input[name="id"]').val(),
                values = $(':input').serialize(), url, method;
            if ($.isNumeric(id)) {
                url = '{{ route("dosen.dosen.update") }}';
                method = 'PATCH';
            } else {
                url = '{{ route("dosen.dosen.create") }}';
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
                        var scrollPos = $(".dataTables_scrollBody").scrollTop();

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
                    dtdosens.ajax.reload(function () {
                        $(".dataTables_scrollBody").scrollTop(scrollPos);
                        $('body').LoadingOverlay("hide", true);
                    }, false);
                    modal.modal('toggle');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        });

        let dtdosen = $('.dtdosen').DataTable({
            "scrollX": true,
            "ordering": false,
            scrollY: 350,
            scrollCollapse: true,
            retrieve: true,
            stateSave: true,
            bSort: false,
            paging: false,
            searching:false,
            info: false,
            "ajax": {
                "url": "{{ route('dt.dosen.all') }}",
            },
            columns: [
                {
                    "className": "text-bold text-center",
                    defaultContent: '-',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    searchable: true
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
            "initComplete": function (settings, json) {
                $('body').LoadingOverlay("hide", true);
            },
            "preDrawCallback": function () {
                $('body').LoadingOverlay("show", {
                    image: "",
                    fontawesome: "fa fa-cog fa-spin"
                });
            },
            "rowCallback": function (row, data) {
                let active = '', gelar_depan = '', nama = '', gelar_belakang = '';
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
                    ' data-id="' + data.id + '" data-nidn="' + data.nidn + '" data-nip="' + data.nip + '"  data-nopeg="' + data.nopeg + '"  data-nik="' + data.nik + '" data-gender="' + data.gender + '"' + '" data-gelar_depan="' + data.gelar_depan + '"' +
                    ' data-nama="' + data.nama + '" data-gelar_belakang="' + data.gelar_belakang + '"' + '" data-tempat_lahir="' + data.tempat_lahir + '"' + '" data-tanggal_lahir="' + data.tanggal_lahir + '"' +
                    ' data-alamat="' + data.alamat + '" data-pns_status="' + data.pns_status + '" data-unitid="' + data.unitID + '"' + '" data-status_kawin="' + data.status_kawin + '"' + '" data-jumlah_tanggungan="' + data.jumlah_tanggungan + '"' +
                    ' data-status_dosen="' + data.status_dosen + '" data-tanggal_masuk="' + data.tanggal_masuk + '"' + '" data-masa_kerja="' + data.masa_kerja + '"' + '" data-golonganid="' + data.golonganID + '"' +
                    ' data-ruangid="' + data.ruangID + '" data-strukturalid="' + data.strukturalID + '"' + '" data-fungsionalid="' + data.fungsionalID + '"' + '" data-norek_mandiri="' + data.norek_mandiri + '"' +
                    ' data-norek_bjb="' + data.norek_bjb + '" data-norek_bjbs="' + data.norek_bjbs + '" data-npwp="' + data.npwp + '"' + '" data-aktif="' + data.aktif + '"' + '" data-matkulid="' + data.matkulID + '"' +
                    ' >' +
                    '<i class="fa fa-edit"></i> Sunting' +
                    '</button>' +
                    '<a href="pegawai/'+data.id+'/depan" class="btn btn-info"' +
                    '  target="popup"' +
                    '  onclick="window.open(\'pegawai/'+data.id+'/depan\',\'popup\',\'width=600,height=600,scrollbars=no,resizable=no\'); return false;">' +
                    '<i class="fa fa-print"></i> Depan' +
                    '</a>'+
                    '<a href="pegawai/'+data.id+'/belakang" class="btn btn-primary"' +
                    '  target="popup"' +
                    '  onclick="window.open(\'pegawai/'+data.id+'/belakang\',\'popup\',\'width=600,height=600,scrollbars=no,resizable=no\'); return false;">' +
                    '<i class="fa fa-print"></i> Belakang' +
                    '</a>'+
                    '</div>');
            },
            "drawCallback": function () {
                $('.editUsers').on('click', function (e) {
                    let data = $(this).data();
                    modal.modal('toggle');
                    modal.find(':input').val('');
                    modal.find('input[name="strukturalID"]').val(null);
                    modal.find('input[name="fungsionalID"]').val(null);
                    modal.find('input[name="id"]').val(data.id);
                    modal.find('input[name="nidn"]').val(data.nidn);
                    modal.find('input[name="nip"]').val(data.nip);
                    modal.find('input[name="nopeg"]').val(data.nopeg);
                    modal.find('input[name="nik"]').val(data.nik);
                    modal.find('input[name="gender"]').val(data.gender);
                    modal.find('input[name="gelar_depan"]').val(data.gelar_depan);
                    modal.find('input[name="nama"]').val(data.nama);
                    modal.find('input[name="gelar_belakang"]').val(data.gelar_belakang);
                    modal.find('input[name="tempat_lahir"]').val(data.tempat_lahir);
                    modal.find('input[name="tanggal_lahir"]').val(data.tanggal_lahir);
                    modal.find('input[name="alamat"]').val(data.alamat);
                    modal.find('.unitID').val(data.unitid).trigger('change');
                    modal.find('.matkulID').val(data.matkulid).trigger('change');
                    modal.find('.status_kawin').val(data.status_kawin).trigger('change');
                    modal.find('select[name="pns_status"]').val(data.pns_status).trigger('change');
                    modal.find('input[name="jumlah_tanggungan"]').val(data.jumlah_tanggungan);
                    modal.find('.status_dosen').val(data.status_dosen).trigger('change');
                    modal.find('input[name="tanggal_masuk"]').val(data.tanggal_masuk);
                    modal.find('input[name="masa_kerja"]').val(data.masa_kerja);
                    modal.find('.golonganID').val(data.golonganid);
                    modal.find('.ruangID').val(data.ruangid);
                    modal.find('.strukturalID').val(data.strukturalid).trigger('change');
                    modal.find('.fungsionalID').val(data.fungsionalid).trigger('change');
                    modal.find('input[name="norek_mandiri"]').val(data.norek_mandiri);
                    modal.find('input[name="norek_bjb"]').val(data.norek_bjb);
                    modal.find('input[name="norek_bjbs"]').val(data.norek_bjbs);
                    modal.find('input[name="npwp"]').val(data.npwp);
                    modal.find('.aktif').val(data.aktif);
                    myDropzone.on("sending", function(file, xhr, formData) {
                        formData.append("pegawaiID", data.id);
                        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    });
                });
            }
        });

        modal.on('bs.modal.show', function(){
            modal.find(':input').val('');
        });

        $('#mUser').on('hide.bs.modal', function (e) {
            $(".dz-preview").remove();
        });

    </script>
@endsection
