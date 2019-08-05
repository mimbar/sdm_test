@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Unit Kerja</h5>
                <div class="header-elements">
                    <button class="btn bg-success" data-toggle="modal" data-target="#mUnitkerja">
                        <i class="icon-add"></i>
                        Tambah
                    </button>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-hover table-sm dtunitkerja" style="width: 100%">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Singkatan</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div id="mUnitkerja" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Unit Kerja</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Singkatan</label>
                                <input type="hidden" name="id">
                                <input type="text" placeholder="Singkatan" name="singkatan"
                                       class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label>Nama</label>
                                <input type="text" placeholder="Nama" name="nama" class="form-control">
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
        let modal = $('#mUnitkerja');

        modal.on('show.bs.modal', function () {
            $(this).find(':input').val('');
        });

        $('.save').on('click', function (e) {
            let modal = $('#mUnitkerja'),
                id = modal.find('input[name="id"]').val(),
                values = $(':input').serialize(), url, method;
            if ($.isNumeric(id)) {
                url = '{{ route("kitchen.users.update") }}';
                method = 'PATCH';
            } else {
                url = '{{ route("kitchen.users.create") }}';
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
                        dtunitkerja.ajax.reload();
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

        let dtunitkerja = $('.dtunitkerja').DataTable({
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
                "url": "{{ route('dt.unitkerja.all') }}",
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
                    "data": 'singkatan',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: true
                },
                {
                    "data": 'nama',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: true
                },
                {
                    "data": '',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: false
                }
            ],
            "rowCallback": function (row, data) {
                $('td:eq(3)', row).html('<div class="btn-group">' +
                    '<button type="button" class="btn btn-sm btn-success editUnitKerja"' +
                    ' data-id="' + data.id + '" data-singkatan="' + data.singkatan + '"' +
                    '" data-nama="' + data.nama + '">' +
                    '<i class="fa fa-edit"></i> Sunting' +
                    '</button>' +
                    '</div>');
            },
            "drawCallback": function () {
                $('.editUnitKerja').on('click', function (e) {
                    let data = $(this).data();
                    modal.modal('toggle');
                    $(':input').val('');
                    modal.find('input[name="id"]').val(data.id);
                    modal.find('input[name="singkatan"]').val(data.singkatan);
                    modal.find('input[name="nama"]').val(data.nama);
                });
            }
        });
    </script>
@endsection
