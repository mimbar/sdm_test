@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Users</h5>
                <div class="header-elements">
                    <button class="btn bg-success" data-toggle="modal" data-target="#mUser">
                        <i class="icon-add"></i>
                        Tambah
                    </button>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-hover table-sm dtusers" style="width: 100%">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Role</th>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Username</label>
                                <input type="hidden" name="id">
                                <input type="text" placeholder="Username" name="username"
                                       class="form-control checkUsername">
                                <div class="statusUsername d-none">
                                    <span class="form-text text-danger">Username Sudah Terdaftar</span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label>Email</label>
                                <input type="text" placeholder="Email" name="email" class="form-control checkEmail">
                                <div class="statusEmail d-none">
                                    <span class="form-text text-danger">Email Sudah Terdaftar</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Nama</label>
                                <input type="text" placeholder="Nama" name="name" class="form-control">
                            </div>

                            <div class="col-sm-3">
                                <label>Level</label>
                                <select class="form-control rolesid" name="rolesID">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label>Keaktifan</label>
                                <select class="form-control active" name="active">
                                        <option value="1">Aktif</option>
                                        <option value="0">Ban</option>
                                </select>
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

        checkEmail.on('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                $.ajax({
                    url: "{{ route('kitchen.users.check.email') }}",
                    type: 'post',
                    data: {
                        email: checkEmail.val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data === 200) {
                            checkEmail.removeClass('border-danger');
                            checkEmail.addClass('border-success');
                            statusEmail.addClass('d-none');

                        } else {
                            checkEmail.addClass('border-danger');
                            checkEmail.removeClass('border-success');
                            statusEmail.removeClass('d-none');

                        }
                    }
                });
            }, 200);
        });

        checkUsername.on('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                $.ajax({
                    url: "{{ route('kitchen.users.check.username') }}",
                    type: 'post',
                    data: {
                        username: checkUsername.val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data === 200) {
                            checkUsername.removeClass('border-danger');
                            checkUsername.addClass('border-success');
                            statusUsername.addClass('d-none');

                        } else {
                            checkUsername.addClass('border-danger');
                            checkUsername.removeClass('border-success');
                            statusUsername.removeClass('d-none');

                        }
                    }
                });
            }, 200);
        });

        modal.on('show.bs.modal', function () {
            checkUsername.removeClass('border-danger');
            checkUsername.addClass('border-success');
            statusUsername.addClass('d-none');
            checkEmail.removeClass('border-danger');
            checkEmail.addClass('border-success');
            statusEmail.addClass('d-none');
            $(this).find(':input').val('');
            $(this).find('.active').val(1);
            $(this).find('.rolesid').val(2);
            $(this).find('input[name="username"]').removeAttr('disabled');
            $(this).find('input[name="email"]').removeAttr('disabled');
        });

        $('.save').on('click', function (e) {
            let modal = $('#mUser'),
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
                        dtusers.ajax.reload();
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

        let dtusers = $('.dtusers').DataTable({
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
                "url": "{{ route('dt.users.all') }}",
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
                    "data": 'username',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: true
                },
                {
                    "data": 'email',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: true
                },
                {
                    "data": 'name',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: true
                },
                {
                    "data": '',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: false
                },
                {
                    "data": '',
                    defaultContent: '-',
                    className: "text-center",
                    orderable: false, searchable: false
                }
            ],
            "rowCallback": function (row, data) {
                let activeClass = '';
                if(data.active === 0)
                    activeClass = 'badge-danger';
                else
                    activeClass = 'badge-success';

                $('td:eq(4)', row).html('<span class="badge '+activeClass+' ml-2 mr-1" style="width: 90px">' + data.level[0].display_name + '</span>');

                $('td:eq(5)', row).html('<div class="btn-group">' +
                    '<button type="button" class="btn btn-sm btn-success editUsers"' +
                    ' data-id="' + data.id + '" data-name="' + data.name + '"' + '" data-username="' + data.username + '"' + '" data-email="' + data.email + '"' +
                    ' data-roles="' + data.level[0].id +  '" + data-active="' + data.active +  '">' +
                    '<i class="fa fa-edit"></i> Sunting' +
                    '</button>' +
                    '<button type="button" class="btn btn-sm btn-danger" onclick="resetPass('+data.id+')" ' +
                    ' data-id="' + data.id + '">' +
                    '<i class="fa fa-trash"></i> Hapus' +
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
                                        dtusers.ajax.reload();
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

        function resetPass(id) {
            swal({
                title: 'Akan Mereset Password?',
                html: "Password default <b>siliwangi</b> akan diberikan",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Proses',
                cancelButtonText: 'Batalkan',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 2000);
                    });
                },
            }).then(function (data) {
                if (data.dismiss === 'cancel') {
                    swal(
                        'Dibatalkan!',
                        'Password tidak direset.',
                        'error'
                    );
                } else {
                    setTimeout(function () {
                        $.ajax({
                            url: "{{ route('kitchen.users.reset') }}",
                            type: 'post',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function (data) {
                                if (data) {
                                    new Noty({
                                        theme: ' alert bg-success text-white alert-styled-left p-0',
                                        text: 'Password berhasil direset.',
                                        type: 'success',
                                        progressBar: true,
                                    }).show();
                                } else {
                                    new Noty({
                                        theme: ' alert bg-danger text-white alert-styled-left p-0',
                                        text: 'Data Gagal dihapus.',
                                        type: 'danger',
                                        progressBar: true,
                                    }).show();
                                }
                                dtusers.ajax.reload();
                            }
                        });
                    }, 130);
                }
            });
        }
    </script>
@endsection
