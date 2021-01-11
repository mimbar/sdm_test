@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Golongan - Ruang - Pangkat</h5>
                <div class="header-elements">
                    <button class="btn bg-success addGrp">
                        <i class="icon-add"></i>
                        Tambah
                    </button>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-hover table-sm dtgrp" style="width: 100%">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Golongan</th>
                        <th>Ruang</th>
                        <th>Pangkat</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr class="text-center form">
                        <th>#</th>
                        <th>
                            <input type="hidden" name="id">
                            <input type="text" class="form-control" name="golongan" placeholder="Golongan"
                                   disabled="disabled">
                        </th>
                        <th>
                            <input type="text" class="form-control" name="ruang" placeholder="Ruang"
                                   disabled="disabled">
                        </th>
                        <th>
                            <input type="text" class="form-control" name="pangkat" placeholder="Pangkat"
                                   disabled="disabled">
                        </th>
                        <th>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-success saveBtn" disabled="disabled">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                                <button class="btn btn-sm btn-danger resetBtn" disabled="disabled">
                                    <i class="fa fa-recycle"></i> Reset
                                </button>
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            let dtgrp = $('.dtgrp').DataTable({
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
                    "url": "{{ route('dt.grp.all') }}",
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
                        "data": 'golongan',
                        defaultContent: '-',
                        className: "text-center",
                        orderable: false, searchable: true
                    },
                    {
                        "data": 'ruang',
                        defaultContent: '-',
                        className: "text-center",
                        orderable: false, searchable: true
                    },
                    {
                        "data": 'pangkat',
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
                    $('td:eq(4)', row).html('<div class="btn-group">' +
                        '<button type="button" class="btn btn-sm btn-success editRole"' +
                        ' data-id="' + data.id + '" data-golongan="' + data.golongan + '"' +
                        ' data-ruang="' + data.ruang + '"' +
                        ' data-pangkat="' + data.pangkat + '">' +
                        '<i class="fa fa-edit"></i> Sunting' +
                        '</button>' +
                        '</div>');
                },
                "drawCallback": function () {
                    $('.editRole').on('click', function (e) {
                        let data = $(this).data();
                        $('.form input').val('');
                        $('.form input').removeAttr('disabled');
                        $('.form button').removeAttr('disabled');
                        $('input[name="id"]').val(data.id);
                        $('input[name="golongan"]').val(data.golongan).focus();
                        $('input[name="ruang"]').val(data.ruang);
                        $('input[name="pangkat"]').val(data.pangkat);
                    });
                }
            });

            $('input[name="name"]').on('input', function (e) {
                $('input[name="name"]').val(this.value.toLowerCase());
            });

            $('.addGrp').on('click', function (e) {
                e.preventDefault();
                $('.form input').val('');
                $('.form input').removeAttr('disabled');
                $('.form button').removeAttr('disabled');
                $('input[name="name"]').focus();
            });

            $('.saveBtn').on('click', function (e) {
                let id = parseInt($('input[name="id"]').val()),
                    name = $('input[name="name"]').val(),
                    values = $(':input').serialize(), url, method;
                if ($.isNumeric(id)) {
                    url = '{{ route("master.grp.update") }}';
                    method = 'PATCH';
                } else {
                    url = '{{ route("master.grp.create") }}'
                    method = 'POST'
                }
                $.ajax({
                    url: url,
                    type: method,
                    data: values,
                    success: function (response) {
                        $('.form input').val('');
                        $('.form input').attr('disabled', 'disabled');
                        $('.form button').attr('disabled', 'disabled');
                        $('#form').removeAttr('action');
                        if (response.code === 200) {
                            new Noty({
                                theme: ' alert bg-success text-white alert-styled-left p-0',
                                text: 'Data Berhasil disimpan.',
                                type: 'success',
                                progressBar: true,
                            }).show();
                            dtgrp.ajax.reload();
                        } else if (response.code === 500) {
                            new Noty({
                                theme: ' alert bg-danger text-white alert-styled-left p-0',
                                text: 'Data Gagal disimpan.',
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
            });
        });
    </script>
@endsection
