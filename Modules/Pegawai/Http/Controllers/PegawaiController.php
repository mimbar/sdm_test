<?php

namespace Modules\Pegawai\Http\Controllers;

use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationData;
use Illuminate\Validation\Validator;
use Intervention\Image\Facades\Image;
use Modules\Master\Entities\Bank;
use Modules\Master\Entities\Fungsional;
use Modules\Master\Entities\Pegawai;
use Modules\Master\Entities\StatusKawin;
use Modules\Master\Entities\StatusPegawai;
use Modules\Master\Entities\Struktural;
use Modules\Master\Entities\UnitKerja;

class PegawaiController extends Controller
{
    public function index()
    {
        $statusKawin = StatusKawin::all();
        $statusPegawai = StatusPegawai::all();
        $unitkerja = UnitKerja::all();
        $jabatanStruktural = Struktural::all();
        $jabatanFungsional = Fungsional::all();
        $banks = Bank::all();
        return view('pegawai::index', compact('statusKawin', 'statusPegawai', 'unitkerja', 'jabatanFungsional', 'jabatanStruktural', 'banks'));
    }

    public function create(Request $request)
    {
        try {
            $pegawai = new Pegawai([
                'nidn' => $request->input('nidn'),
                'nip' => $request->input('nip'),
                'nopeg' => $request->input('nopeg'),
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
                'pns_status' => $request->input('pns_status'),
            ]);
            $pegawai->save();

            return \response()->json([
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $pegawai = Pegawai::find($request->input('id'));
            $pegawai->nidn = $request->input('nidn');
            $pegawai->nip = $request->input('nip');
            $pegawai->nopeg = $request->input('nopeg');

            $pegawai->gelar_depan = $request->input('gelar_depan');
            $pegawai->nama = $request->input('nama');
            $pegawai->gelar_belakang = $request->input('gelar_belakang');
            $pegawai->tempat_lahir = $request->input('tempat_lahir');
            $pegawai->tanggal_lahir = Carbon::createFromFormat('d-m-Y', $request->input('tanggal_lahir'))->format('Y-m-d');
            $pegawai->pns_status = $request->input('pns_status');
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
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function kalkulasi()
    {
        try {
            $pegawais = Pegawai::all();

            foreach ($pegawais as $pegawai) {
                $pegawai->masa_kerja = $pegawai->tanggal_masuk->age;
                $pegawai->save();
            }

            return \response()->json([
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function printDepan($id)
    {
        try {
            if (ob_get_length()) ob_end_clean();


            $pegawai = Pegawai::find($id);
            $gelar_depan = '';
            $gelar_belakang = '';
            if (strlen($pegawai->gelar_depan) > 0) {
                $gelar_depan = "$pegawai->gelar_depan ";
            }

            if (strlen($pegawai->gelar_belakang) > 0) {
                $gelar_belakang = ", $pegawai->gelar_belakang";
            }

            $fpdf = new Fpdf('P', 'mm', array(55, 90));
            $fpdf->addPage();
            $fpdf->AddFont('Quicksand', 'B', 'Quicksand-Bold.php');
            $y = 3.6;


            $fpdf->SetAutoPageBreak(false);
            $fpdf->setMargins('0', '0', '0');
            $fpdf->Image('assets/bg_frnt_fix.jpg', 0, 3+$y, 55, 90);
            $fpdf->SetFont('Quicksand', 'B', 9);
            $fpdf->setY(64+$y);
            $fpdf->Cell(55, 5, strtoupper($pegawai->nama), 0, 0, "C", false);
            $fpdf->Image('storage/photo/' . $pegawai->id . "_RES.jpg", 14, 22.7+$y, 27, 40);
            $fpdf->Image('assets/logo_unsil.png', 21, 1+$y, 12, 12);
            $fpdf->SetFont('Quicksand', 'B', 6);
            $fpdf->setXY(0, 10.5+$y);
//            $fpdf->Write(5, "KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN");
            $fpdf->Cell(0,10,'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN',0,0,'C');

            $fpdf->SetFont('Quicksand', 'B', 11);
            $fpdf->setXY(0,13.5+$y);
            $fpdf->Cell(0,10,'UNIVERSITAS SILIWANGI',0,0,'C');
            $fpdf->Output();
            exit;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function printBelakang($id)
    {
        try {
            if (ob_get_contents()) ob_end_clean();
            $pegawai = Pegawai::find($id);
            $gelar_depan = '';
            $gelar_belakang = '';
            if (strlen($pegawai->gelar_depan) > 0) {
                $gelar_depan = "$pegawai->gelar_depan ";
            }

            if (strlen($pegawai->gelar_belakang) > 0) {
                $gelar_belakang = ", $pegawai->gelar_belakang";
            }
            $ids = 0;
            $id = 0;

            if ($pegawai->nip != "") {
                $ids = $pegawai->nip;
                $id = 'NIP';
            } elseif ($pegawai->nidn != "") {
                $ids = $pegawai->nidn;
                $id = 'NIDN';
            } elseif ($pegawai->nopeg != "") {
                $ids = $pegawai->nopeg;
                $id = 'NIK';
            }

            $nama = $gelar_depan . ucwords(strtolower($pegawai->nama)) . $gelar_belakang;
            $fpdf = new Fpdf('P', 'mm', array(55, 90));
            $fpdf->addPage();
            $fpdf->AddFont('Quicksand', 'B', 'Quicksand-Bold.php');
            $fpdf->SetAutoPageBreak(false);
            $fpdf->setMargins('18', '0', '0');
            $fpdf->Image('assets/bg_rear.jpg', 0, 0, 55, 90);
            $fpdf->Image('assets/stamp.png', 7, 40.3, 15, 15);
            $fpdf->Image('assets/ttd_rektor.png', 17.3, 37.3, 13, 21);
            $fpdf->Image('assets/logo_unsil.png', 15, 63, 7, 7);
            $fpdf->SetFont('Quicksand', 'B', 7);

            $fpdf->setY(13.2);
            $fpdf->setX(2.3);
            $fpdf->Write(3, "Nama");

            $fpdf->setY(13.2);
            $fpdf->setX(16.3);
            $fpdf->Write(3, ":");

            $fpdf->setY(13.2);
            $fpdf->Write(3, $nama);

            $fpdf->setXY(2.3, 18.7);
            $fpdf->Write(3, $id);

            $fpdf->setY(18.7);
            $fpdf->setX(16.3);
            $fpdf->Write(3, ":");

            $fpdf->setY(17.8);
            $fpdf->Cell(67, 5, $ids, 0, 0, "L", false);

            $fpdf->setXY(2.3, 21.7);
            $fpdf->Write(3, "Unit");
            $fpdf->setY(21.7);
            $fpdf->Write(3, $pegawai->unit->nama);

            $fpdf->setY(21.7);
            $fpdf->setX(16.3);
            $fpdf->Write(3, ":");

            $fpdf->setY(40.6);
            $fpdf->setX(10);
            $fpdf->Write(3, "Rektor Universitas Siliwangi");

            $fpdf->setY(53.6);
            $fpdf->setX(10);
            $fpdf->Write(3, "Prof. Dr. Rudi. Priyadi, Ir. MS.");

            $fpdf->setY(56.6);
            $fpdf->setX(10);
            $fpdf->Write(3, "NIP. 195806271986031002");

            $fpdf->setXY(22, 63.6);
            $fpdf->Write(3, "UNIVERSITAS");
            $fpdf->setXY(22, 66.6);
            $fpdf->Write(3, "SILIWANGI");

            $fpdf->setXY(7, 82.6);
            $fpdf->setTextColor(255,255,255);
            $fpdf->Write(3, "www.unsil.ac.id | (0265) 330 634");
            $fpdf->Output();
            exit;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function upload(Request $request)
    {
        try {
//            $request->validate([
//                'file' => 'image'
//            ]);

            $pegawai = Pegawai::find($request->input('pegawaiID'));
            $file = $request->file('file');
//            $fileOrig = $file->getClientOriginalName();
            $fileName = $pegawai->id . '_ORI.' . $file->getClientOriginalExtension();
            $fileNameResize = $pegawai->id . '_RES.' . $file->getClientOriginalExtension();
            Storage::delete('public/photo/', $fileName);
            $file->storeAs(
                'public/photo/', $fileName
            );

            Image::make('storage/photo/' . $fileName)->resize(400, 600)->save('storage/photo/' . $fileNameResize);


        } catch (\Exception $exception) {
            return $return = [
                'code' => 500,
                'message' => $exception->getMessage() . ' - ' . $exception->getFile() . ' - ' . $exception->getLine(),
            ];
        }

    }


}
