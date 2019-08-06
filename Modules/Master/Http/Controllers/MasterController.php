<?php

namespace Modules\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Master\Entities\GRP;
use Modules\Master\Entities\StatusPegawai;
use Modules\Master\Entities\UnitKerja;

class MasterController extends Controller
{
    public function unitkerjaIndex(){
        return view('master::unitkerja');
    }

    public function unitkerjaCreate(Request $request){
        try{
            DB::beginTransaction();
            $request->validate([
                'singkatan' => 'required',
                'nama' => 'required',
            ]);

            $unitkerja = new UnitKerja([
                'singkatan' => $request->input('singkatan'),
                'nama' => $request->input('nama'),
            ]);
            $unitkerja->save();
            DB::commit();
            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function unitkerjaUpdate(Request $request){
        try{
            DB::beginTransaction();
            $request->validate([
                'singkatan' => 'required',
                'nama' => 'required',
            ]);

            $unitkerja = UnitKerja::find($request->input('id'));
            $unitkerja->singkatan = $request->input('singkatan');
            $unitkerja->nama = $request->input('nama');
            $unitkerja->save();
            DB::commit();
            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }


    public function grpIndex(){
        return view('master::grp');
    }

    public function grpCreate(Request $request){
        try{
            DB::beginTransaction();
            $request->validate([
                'golongan' => 'required',
                'ruang' => 'required',
                'pangkat' => 'required',
            ]);

            $grp = new GRP([
                'golongan' => $request->input('golongan'),
                'ruang' => $request->input('ruang'),
                'pangkat' => $request->input('pangkat'),
            ]);
            $grp->save();
            DB::commit();
            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function grpUpdate(Request $request){
        try{
            DB::beginTransaction();
            $request->validate([
                'golongan' => 'required',
                'ruang' => 'required',
                'pangkat' => 'required',
            ]);


            $grp = GRP::find($request->input('id'));
            $grp->golongan = $request->input('golongan');
            $grp->ruang = $request->input('ruang');
            $grp->pangkat = $request->input('pangkat');
            $grp->save();
            DB::commit();
            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function statuspegawaiIndex(){
        return view('master::statuspegawai');
    }

    public function statuspegawaiCreate(Request $request){
        try{
            DB::beginTransaction();
            $request->validate([
                'nama' => 'required',
                'description' => 'required',
            ]);
            $statuspegawai = new StatusPegawai([
                'nama' => $request->input('nama'),
                'description' => $request->input('description'),
            ]);
            $statuspegawai->save();
            DB::commit();
            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function statuspegawaiUpdate(Request $request){
        try{
            DB::beginTransaction();
            $request->validate([
                'nama' => 'required',
                'description' => 'required',
            ]);
            $statuspegawai = StatusPegawai::find($request->input('id'));
            $statuspegawai->nama = $request->input('nama');
            $statuspegawai->description = $request->input('description');
            $statuspegawai->save();
            DB::commit();
            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }
}
