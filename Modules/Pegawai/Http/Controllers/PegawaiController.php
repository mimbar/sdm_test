<?php

namespace Modules\Pegawai\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Master\Entities\Bank;
use Modules\Master\Entities\Fungsional;
use Modules\Master\Entities\Pegawai;
use Modules\Master\Entities\StatusKawin;
use Modules\Master\Entities\StatusPegawai;
use Modules\Master\Entities\Struktural;
use Modules\Master\Entities\UnitKerja;

class PegawaiController extends Controller
{
    public function index(){
        $statusKawin = StatusKawin::all();
        $statusPegawai = StatusPegawai::all();
        $unitkerja = UnitKerja::all();
        $jabatanStruktural = Struktural::all();
        $jabatanFungsional = Fungsional::all();
        $banks = Bank::all();
        return view('pegawai::index',compact('statusKawin','statusPegawai','unitkerja','jabatanFungsional','jabatanStruktural','banks'));
    }

    public function create(Request $request){
        try{
            $pegawai = new Pegawai([
                'gelar_depan' => $request->input('gelar_depan'),
                'nama' => $request->input('nama'),
                'gelar_belakang' => $request->input('gelar_belakang'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_lahir'))->format('Y-m-d'),
                'status_kawin' => $request->input('status_kawin'),
                'jumlah_tanggungan' => $request->input('jumlah_tanggungan'),
                'bankID' => $request->input('bankID'),
                'nomor_rekening' => $request->input('nomor_rekening'),
                'tanggal_masuk' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_masuk'))->format('Y-m-d'),
                'masa_kerja' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_masuk'))->age,
                'status_pegawai' => $request->input('status_pegawai'),
                'unitID' => $request->input('unitID'),
                'nik' => $request->input('nik'),
                'npwp' => $request->input('npwp'),
                'golonganID' => $request->input('golonganID'),
                'ruangID' => $request->input('ruangID'),
                'strukturalID' => $request->input('strukturalID'),
                'fungsionalID' => $request->input('fungsionalID'),
                'aktif' => $request->input('aktif'),
            ]);
            $pegawai->save();

            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function update(Request $request){
        try{
            $pegawai = Pegawai::find($request->input('id'));
            $pegawai->gelar_depan = $request->input('gelar_depan');
            $pegawai->nama = $request->input('nama');
            $pegawai->gelar_belakang = $request->input('gelar_belakang');
            $pegawai->tempat_lahir = $request->input('tempat_lahir');
            $pegawai->tanggal_lahir = Carbon::createFromFormat('d-m-Y', $request->input('tanggal_lahir'))->format('Y-m-d');
            $pegawai->status_kawin = $request->input('status_kawin');
            $pegawai->jumlah_tanggungan = $request->input('jumlah_tanggungan');
            $pegawai->bankID = $request->input('bankID');
            $pegawai->nomor_rekening = $request->input('nomor_rekening');
            $pegawai->tanggal_masuk = Carbon::createFromFormat('d-m-Y', $request->input('tanggal_masuk'))->format('Y-m-d');
            $pegawai->masa_kerja = Carbon::createFromFormat('d-m-Y', $request->input('tanggal_masuk'))->age;
            $pegawai->status_pegawai = $request->input('status_pegawai');
            $pegawai->unitID = $request->input('unitID');
            $pegawai->nik = $request->input('nik');
            $pegawai->npwp = $request->input('npwp');
            $pegawai->golonganID = $request->input('golonganID');
            $pegawai->ruangID = $request->input('ruangID');
            $pegawai->strukturalID = $request->input('strukturalID');
            $pegawai->fungsionalID = $request->input('fungsionalID');
            $pegawai->aktif = $request->input('aktif');
            $pegawai->save();

            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function kalkulasi(){
        try{
            $pegawais = Pegawai::all();

            foreach ($pegawais as $pegawai) {
                $pegawai->masa_kerja = $pegawai->tanggal_masuk->age;
                $pegawai->save();
            }

            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }
}
