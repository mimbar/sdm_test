@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Assign Permission to Roles</h5>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="font-weight-semibold">Pilih Roles</label>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <select class="form-control rolesID">
                                    <option selected disabled> == Pilih Roles ==</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                                @if(session('rolesID') == $role->id) selected @endif> {{ $role->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if(session()->has('rolesID'))
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <select multiple="multiple" class="form-control assignThePermissions" data-fouc>
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}" @if($permission->roles->count() == 1) selected @endif>{{ $permission->name.' - '.$permission->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('kitchen.assign.setroles') }}" method="POST" id="setRoles">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $('.rolesID').on('change', function (e) {
            let id = $(this).val();
            $('input[name="id"]').val(id);
            $('#setRoles').submit();
        });

        $('.assignThePermissions').bootstrapDualListbox({
            nonSelectedListLabel: 'Non-selected',
            selectedListLabel: 'Selected',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false
        }).on('change',function (e) {
            let val = $(this).val();

            $.ajax({
                url: '{{ route('kitchen.assign.setpermissions') }}',
                type: "POST",
                data: {
                    id: val
                },
                success: function (response) {
                    if (response.code === 200) {
                        new Noty({
                            theme: ' alert bg-success text-white alert-styled-left p-0',
                            text: 'Data Berhasil disimpan.',
                            type: 'success',
                            progressBar: true,
                        }).show();
                        dtpermissions.ajax.reload();
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
    </script>
@endsection
