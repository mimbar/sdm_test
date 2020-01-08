<?php

namespace Modules\Pegawai\Http\Controllers;

use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
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
                'norek_mandiri' => $request->input('norek_mandiri'),
                'norek_bjb' => $request->input('norek_bjb'),
                'norek_bjbs' => $request->input('norek_bjbs'),
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
            $pegawai->norek_mandiri = $request->input('norek_mandiri');
            $pegawai->norek_bjb = $request->input('norek_bjb');
            $pegawai->norek_bjbs = $request->input('norek_bjbs');
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

    public function printDepan($id){
        try{
            ob_end_clean();
            $pegawai = Pegawai::find($id);
            $gelar_depan = '';
            $gelar_belakang = '';
            if (strlen($pegawai->gelar_depan) > 0){
                $gelar_depan = "$pegawai->gelar_depan ";
            }

            if (strlen($pegawai->gelar_belakang) > 0){
                $gelar_belakang = ", $pegawai->gelar_belakang";
            }

            $nama = $gelar_depan.$pegawai->nama.$gelar_belakang;
            $fpdf = new Fpdf('P','mm',array(55,90));
            $fpdf->addPage();
            $fpdf->SetAutoPageBreak(false);
            $fpdf->setMargins('0','0','0');
            $fpdf->Image('assets/bg_kartu_nama.jpg', -20, -31, 165, 153);
            $fpdf->SetFont('Courier', 'B', 9);
            $fpdf->setY(68);
            $fpdf->Cell(55,5,$pegawai->nama,0,0,"C",false);
            $fpdf->Output();
            exit;
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }

    public function printBelakang($id){
        try{
            ob_end_clean();
            $pegawai = Pegawai::find($id);
            $gelar_depan = '';
            $gelar_belakang = '';
            if (strlen($pegawai->gelar_depan) > 0){
                $gelar_depan = "$pegawai->gelar_depan ";
            }

            if (strlen($pegawai->gelar_belakang) > 0){
                $gelar_belakang = ", $pegawai->gelar_belakang";
            }

            $nama = $gelar_depan.$pegawai->nama.$gelar_belakang;
            $fpdf = new Fpdf('P','mm',array(55,90));
            $fpdf->addPage();
            $fpdf->SetAutoPageBreak(false);
            $fpdf->setMargins('19','0','0');
            $fpdf->Image('assets/bg_kartu_nama.jpg', -85, -32, 165, 155);
            $fpdf->SetFont('Courier', 'B', 8);
            $fpdf->setY(9);
            $fpdf->Write(3,$nama);
            $fpdf->setY(14);
            $fpdf->Cell(67,5,$pegawai->nik,0,0,"L",false);
            $fpdf->setY(21);
            $fpdf->Write(3,$pegawai->unit->nama);
            $fpdf->Output();
            exit;
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }

}
