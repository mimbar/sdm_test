@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Permissions Manager</h5>
                        <div class="header-elements">
                            <button class="btn btn-sm bg-success" data-toggle="modal" data-target="#modaladdPermission">
                                <i class="icon-add"></i>
                                Tambah
                            </button>
                        </div>
                    </div>


                    <table class="table dtPermission" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Display</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-md-5 col-sm-6">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Roles Manager</h5>
                        <div class="header-elements">
                            <button class="btn btn-sm bg-success" data-toggle="modal" data-target="#modaladdRole">
                                <i class="icon-add"></i>
                                Tambah
                            </button>
                        </div>
                    </div>


                    <table class="table dtRole" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Display</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="col-md-2 col-sm-6">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Assign Permissions to Role</h6>
                        <div class="header-elements">
                            <button class="btn btn-sm bg-success saveAssign d-none">
                                <i class="icon-add"></i>
                                Simpan
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label>Permission</label>
                            <select multiple="multiple" class="form-control select select-permission" data-fouc>
                                <optgroup label="Permissions System">
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            <input type="hidden" name="idRole" class="idRole">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="modaladdPermission" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('auth.manager.permission.create') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Name</label>
                                    <input type="text" placeholder="Name (ex: module.name.action)" name="name"
                                           class="form-control">
                                </div>

                                <div class="col-sm-6">
                                    <label>Display Name</label>
                                    <input type="text" placeholder="Display Name" name="display_name"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn bg-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modaleditPermission" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('auth.manager.permission.update') }}" method="post">
                    {{ csrf_field() }}
                    @method('patch')
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Name</label>
                                    <input type="text" placeholder="Name (ex: module.name.action)" name="name"
                                           class="form-control">
                                    <input type="hidden" name="id" class="id">
                                </div>

                                <div class="col-sm-6">
                                    <label>Display Name</label>
                                    <input type="text" placeholder="Display Name" name="display_name"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn bg-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modaladdRole" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('auth.manager.role.create') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Name</label>
                                    <input type="text" placeholder="Name (ex: student/bakpk_staff)" name="name"
                                           class="form-control">
                                </div>

                                <div class="col-sm-6">
                                    <label>Display Name</label>
                                    <input type="text" placeholder="Display Name" name="display_name"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn bg-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modaleditRole" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('auth.manager.role.update') }}" method="post">
                    {{ csrf_field() }}
                    @method('patch')
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Name</label>
                                    <input type="text" placeholder="Name (ex: student/bakpk_staff)" name="name"
                                           class="form-control">
                                    <input type="hidden" name="id" class="id">
                                </div>

                                <div class="col-sm-6">
                                    <label>Display Name</label>
                                    <input type="text" placeholder="Display Name" name="display_name"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn bg-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });

        $('.dtRole').on('click', '.getPermission', function () {
            var data = $(this);
            $('.saveAssign').removeClass('d-none');
            $('.idRole').val(data.data('id'));
            $('.select-permission').val(data.data('permission')).trigger('change');
        });

        $('.saveAssign').on('click', function () {
            $.ajax({
                url: "{{ route('auth.manager.role.assign') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    id: $('.idRole').val(),
                    permission: $('.select-permission').val(),
                }
            }).done(function (data) {
                if (data.code === 200) {
                    new Noty({
                        theme: ' alert bg-success text-white alert-styled-left p-0',
                        text: 'Data Berhasil disunting.',
                        type: 'success',
                        progressBar: true,
                    }).show();
                } else if (data.code === 500) {
                    new Noty({
                        theme: ' alert bg-danger text-white alert-styled-left p-0',
                        text: data.message,
                        type: 'danger',
                        progressBar: true,
                    }).show();
                }
            });
        });

        $('#modaleditPermission').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var display_name = button.data('display_name');
            var description = button.data('description');
            var modal = $(this);
            modal.find("[name='id']").val(id);
            modal.find("[name='name']").val(name);
            modal.find("[name='display_name']").val(display_name);
            modal.find("[name='description']").val(description);
        });

        $('#modaleditRole').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var display_name = button.data('display_name');
            var description = button.data('description');
            var modal = $(this);
            modal.find("[name='id']").val(id);
            modal.find("[name='name']").val(name);
            modal.find("[name='display_name']").val(display_name);
            modal.find("[name='description']").val(description);
        });

        $('.dtPermission').DataTable({
            "ajax": {
                "url": "{{ route('dt.auth.permission') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "type": "POST"
            },
            columns: [
                {
                    "data": 'name',
                    "className": "text-bold text-center",
                    defaultContent: '-'
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
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: false
                },
            ],
            'columnDefs': [
                {
                    render: function (data, type, full, meta) {
                        if (!data) {
                            data = ' - '
                        }
                        return "<div class='text-wrap width-50'>" + data + "</div>";
                    },
                    targets: [1, 2, 3]
                }
            ],
            "createdRow": function (row, data) {
                $('td:eq(3)', row).html("<div class='btn-group'>" +
                    "<button class='btn bg-success btn-sm' data-toggle='modal' " +
                    "data-id='" + data.id + "' data-name='" + data.name + "' data-display_name='" + data.display_name + "' data-description='" + data.description + "' data-target='#modaleditPermission'>" +
                    "<i class='fa fa-edit'></i> Edit" +
                    "</button>");
            },
        });

        $('.dtRole').DataTable({
            "ajax": {
                "url": "{{ route('dt.auth.role') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "type": "POST"
            },
            columns: [
                {
                    "data": 'name',
                    "className": "text-bold text-center",
                    defaultContent: '-'
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
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: false
                },
            ],
            'columnDefs': [
                {
                    render: function (data, type, full, meta) {
                        if (!data) {
                            data = ' - '
                        }
                        return "<div class='text-wrap width-50'>" + data + "</div>";
                    },
                    targets: [1, 2, 3]
                }
            ],
            "createdRow": function (row, data) {
                $('td:eq(3)', row).html("<div class='btn-group'>" +
                    "<button class='btn bg-success btn-sm' data-toggle='modal' " +
                    "data-id='" + data.id + "' data-name='" + data.name + "' data-display_name='" + data.display_name + "' " +
                    "data-description='" + data.description + "' data-target='#modaleditRole'>" +
                    "<i class='fa fa-edit'></i> Edit" +
                    "</button>" +
                    "<button class='btn bg-warning btn-sm getPermission' data-id='" + data.id + "' data-permission='[" + data.permission + "]'>Set <i class='icon-arrow-right7'></i></button>" +
                    "</div>");
            }
        });
    </script>
@endsection