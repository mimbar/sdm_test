@extends('layouts.body')

@section('main')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Periode</h5>
                <div class="header-elements">
                    <button class="btn bg-success" data-toggle="modal" data-target="#modaladdPeriode">
                        <i class="icon-add"></i>
                        Tambah
                    </button>
                </div>
            </div>


            <table class="table datatable" style="width:100%">
                <thead>
                <tr>
                    <th class="text-center">Kode Tahun</th>
                    <th class="text-center">Program Studi</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Tanggal Mulai</th>
                    <th class="text-center">Tanggal Selesai</th>
                    <th class="text-center">Aksi</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
