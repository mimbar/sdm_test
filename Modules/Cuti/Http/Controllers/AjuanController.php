<?php

namespace Modules\Cuti\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cuti\Entities\cuti;
use Modules\Dosen\Entities\Dosen;

class AjuanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $cuti = Cuti::all()->transform(function ($data) {
            $data->pegawai = Dosen::find($data->pegawai_id);
            $data->verifikator = Dosen::find($data->validator_id);

            switch ($data->status) {
                case 0:
                    $data->st = 'Pending';
                    $data->bg = 'warning';
                    break;
                case 1:
                    $data->st = 'Diterima';
                    $data->bg = 'success';
                    break;
                case 2:
                    $data->st = 'Ditolak';
                    $data->bg = 'danger';
                    break;
                    default:
                    $data->st = 'undefined';
                    break;
            }
            return $data;
        });

        $data = [
            'pegawai' => Dosen::all(),
            'cuti' => $cuti,
        ];

        return view('cuti::ajuan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cuti::ajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'pegawai' => 'required',
            'tanggal_cuti' => 'required'
        ]);

        $tanggal = explode(' - ', $request->tanggal_cuti);
        $data = [
            'pegawai_id' => $request->pegawai,
            'status' => 0,
            'tanggal_awal' => $tanggal[0],
            'tanggal_akhir' => $tanggal[1],
        ];

        try {
            Cuti::create($data);
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menambahkan Cuti!');
        }

        return redirect(route('cuti.ajuan.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cuti::ajuan.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cuti::ajuan.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $c = Cuti::findOrFail($id);
        $c->delete();
        return back();
    }
}
