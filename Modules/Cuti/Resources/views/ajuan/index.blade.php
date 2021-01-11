@extends('../layouts.body')

@section('main')
<div class="content">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Ajukan Cuti</h5>
            <div class="header-elements">
                <div class="btn-group">

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
                        <th>Nama</th>
                        <th>Awal Cuti</th>
                        <th>Akhir Cuti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @foreach ($data['cuti'] as $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item['pegawai']['nama'] }}</td>
                        <td>{{ $item['tanggal_awal'] }}</td>
                        <td>{{ $item['tanggal_akhir'] }}</td>
                        <td class="bg-{{ $item['bg'] }}">{{ $item['st'] }}</td>
                        @if ($item['status'] == 0)
                        <td>
                            <form action="{{ route('cuti.ajuan.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Batalkan</button>
                            </form>
                        </td>
                        @else
                        <td>
                            <button class="btn btn-sm btn-danger" disabled type="button">Batalkan</button>
                        </td>

                        @endif
                    </tr>
                    @php
                    $no++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<div id="mUser" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajukan Cuti</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('cuti.ajuan.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label for="pegawai">Pengaju</label>
                            <select name="pegawai" class="form-control">
                                @foreach($data['pegawai'] as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Tanggal Cuti</label>
                            <input type="text" class="form-control" id="dr" name="tanggal_cuti"
                                placeholder="Tanggal Cuti">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-primary save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const dateCuti = new Date();
    dateCuti.setDate(dateCuti.getDate() + 2);

    $('input[name="tanggal_cuti"]').daterangepicker({
        minDate: dateCuti,
        showDropdowns: true,
        "locale": {
            "format": "DD-MM-YYYY",
        }
    });

</script>
@endsection
{{-- @section('scripts')
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
$('body').LoadingOverlay("show", {
image: "",
fontawesome: "fa fa-cog fa-spin"
});
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
dtpegawai.ajax.reload(function () {
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

let dtpegawai = $('.dtpegawai').DataTable({
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
"url": "{{ route('dt.pegawai.all') }}",
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
                        ' data-id="' + data.id + '" data-nidn="' + data.nidn + '" data-nip="' + data.nip + '"
        data-nopeg="' + data.nopeg + '" data-nik="' + data.nik + '"
        data-gender="' + data.gender + '"' + '" data-gelar_depan="' + data.gelar_depan + '"' +
                        ' data-nama="' + data.nama + '" data-gelar_belakang="' + data.gelar_belakang + '"' + '"
        data-tempat_lahir="' + data.tempat_lahir + '"' + '" data-tanggal_lahir="' + data.tanggal_lahir + '"' +
                        ' data-alamat="' + data.alamat + '" data-pns_status="' + data.pns_status + '" data-unitid="' + data.unitID + '"' + '"
        data-status_kawin="' + data.status_kawin + '"' + '" data-jumlah_tanggungan="' + data.jumlah_tanggungan + '"' +
                        ' data-status_pegawai="' + data.status_pegawai + '" data-tanggal_masuk="' + data.tanggal_masuk + '"' + '"
        data-masa_kerja="' + data.masa_kerja + '"' + '" data-golonganid="' + data.golonganID + '"' +
                        ' data-ruangid="' + data.ruangID + '" data-strukturalid="' + data.strukturalID + '"' + '"
        data-fungsionalid="' + data.fungsionalID + '"' + '" data-norek_mandiri="' + data.norek_mandiri + '"' +
                        ' data-norek_bjb="' + data.norek_bjb + '" data-norek_bjbs="' + data.norek_bjbs + '" data-npwp="' + data.npwp + '"' + '"
        data-aktif="' + data.aktif + '"' +
                        '>' +
        '<i class="fa fa-edit"></i> Sunting' +
        '</button>' +
    '<a href="pegawai/'+data.id+'/depan" class="btn btn-info"' +
                        ' target="popup"' +
                        '
        onclick="window.open(\'pegawai/'+data.id+'/depan\',\'popup\',\'width=600,height=600,scrollbars=no,resizable=no\'); return false;">'
        +
        '<i class="fa fa-print"></i> Depan' +
        '</a>'+
    '<a href="pegawai/'+data.id+'/belakang" class="btn btn-primary"' +
                        ' target="popup"' +
                        '
        onclick="window.open(\'pegawai/'+data.id+'/belakang\',\'popup\',\'width=600,height=600,scrollbars=no,resizable=no\'); return false;">'
        +
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
modal.find('.status_kawin').val(data.status_kawin).trigger('change');
modal.find('select[name="pns_status"]').val(data.pns_status).trigger('change');
modal.find('input[name="jumlah_tanggungan"]').val(data.jumlah_tanggungan);
modal.find('.status_pegawai').val(data.status_pegawai).trigger('change');
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
--}}
