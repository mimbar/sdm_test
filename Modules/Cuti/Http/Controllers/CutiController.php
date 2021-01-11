<?php

namespace Modules\Cuti\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Cuti\Entities\Cuti;
use Modules\Dosen\Entities\Dosen;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Modules\Cuti\Emails\CutiMail;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (! auth()->user()->hasRole('cuti')) {
            abort(403);
        }

        $cuti = Cuti::all()->transform(function ($data) {
            $data->pegawai = Dosen::find($data->pegawai_id);

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
            'cuti' => $cuti,
        ];
        return view('cuti::index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cuti::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cuti::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cuti::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'status' => ['required', Rule::in(['1', '2'])]
        ]);

        if ($v->fails()) {
            return back();
        }

        $c = Cuti::findOrFail($id);
        $c->update(['status' => $request->status]);

        $st = '';
        switch ($request->status) {
            case 0:
                $st = 'Pending';
                break;
            case 1:
                $st = 'Diterima';
                break;
            case 2:
                $st = 'Ditolak';
                break;
                default:
                $st = 'undefined';
                break;
        }

        $dosen = Dosen::findOrFail($c->pegawai_id);
        $data = [
            'nama' => $dosen->nama,
            'awal' => $c->tanggal_awal,
            'akhir' => $c->tanggal_akhir,
            'st' => $st
        ];

        Mail::to($dosen->email)->send(new CutiMail($data));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
