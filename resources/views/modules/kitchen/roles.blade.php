@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Roles</h5>
                <div class="header-elements">
                    <button class="btn bg-success addRole">
                        <i class="icon-add"></i>
                        Tambah
                    </button>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-hover table-sm dtroles" style="width: 100%">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nama Tampilan</th>
                        <th>Deskripsi</th>
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
                            <input type="text" class="form-control" name="name" placeholder="Nama"
                                   disabled="disabled">
                        </th>
                        <th>
                            <input type="text" class="form-control" name="display_name" placeholder="Nama Tampilan"
                                   disabled="disabled">
                        </th>
                        <th>
                            <input type="text" class="form-control" name="description" placeholder="Description"
                                   disabled="disabled">
                        </th>
                        <th>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-success saveBtn" disabled="disabled">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                                <button class="btn btn-sm btn-danger" disabled="disabled">
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
            let dtroles = $('.dtroles').DataTable({
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
                    "url": "{{ route('dt.roles.all') }}",
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
                        "data": 'name',
                        defaultContent: '-',
                        className: "text-center",
                        orderable: false, searchable: true
                    },
                    {
                        "data": 'display_name',
                        defaultContent: '-',
                        className: "text-center",
                        orderable: false, searchable: true
                    },
                    {
                        "data": 'description',
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
                    $('td:eq(4)', row).html('<div class="btn-group">'+
                        '<button type="button" class="btn btn-sm btn-success editRole"'+
                        ' data-id="'+data.id+'" data-name="'+data.name+'"'+
                        ' data-display_name="'+data.display_name+'"'+
                        ' data-description="'+data.description+'">'+
                        '<i class="fa fa-edit"></i> Sunting'+
                        '</button>'+
                        '<button type="button" class="btn btn-sm btn-danger deleteRole"'+
                        ' data-id="'+data.id+'">'+
                        '<i class="fa fa-trash"></i> Hapus'+
                        '</button>'+
                        '</div>');
                },
                "drawCallback": function(){
                    $('.editRole').on('click', function(e){
                        let data = $(this).data();
                        $('.form input').val('');
                        $('.form input').removeAttr('disabled');
                        $('.form button').removeAttr('disabled');
                        $('input[name="id"]').val(data.id);
                        $('input[name="name"]').val(data.name).focus();
                        $('input[name="display_name"]').val(data.display_name);
                        $('input[name="description"]').val(data.description);
                    });

                    $('.deleteRole').on('click', function(e){
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
                        }).then(function(result) {
                            if(result.value) {
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
                                            dtroles.ajax.reload();
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
                            }else if(result.dismiss === swal.DismissReason.cancel) {
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

            $('input[name="name"]').on('input', function (e) {
                $('input[name="name"]').val(this.value.toLowerCase());
            });

            $('.addRole').on('click', function (e) {
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

                if ($.trim(name) === '') {
                    $('.form input').val('');
                    $('.form input').attr('disabled', 'disabled');
                    $('.form button').attr('disabled', 'disabled');
                    new Noty({
                        theme: ' alert bg-danger text-white alert-styled-left p-0',
                        text: 'Data Gagal disimpan. Field "Nama" harus diisi',
                        type: 'danger',
                        progressBar: true,
                    }).show();
                } else {
                    if ($.isNumeric(id)) {
                        url = '{{ route("kitchen.roles.update") }}';
                        method = 'PATCH';
                    } else {
                        url = '{{ route("kitchen.roles.create") }}'
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
                                dtroles.ajax.reload();
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
                }
            });
        });
    </script>
@endsection
