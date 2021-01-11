<?php

namespace Modules\Dosen\Http\Controllers;

use App\Exports\dosenExport;
use App\Imports\dosenImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Illuminate\Http\Response;
use Modules\Dosen\Entities\Dosen;
use Illuminate\Routing\Controller;
use Modules\Master\Entities\prodi;
use Illuminate\Support\Facades\Storage;
use barPDF;

class DosenController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // foreach (json_decode(Storage::disk('public')->get('dosen.json')) as  $value) {
        //     // dd($value);
        //     dosen::create([
        //         'nama' => $value->nama,
        //         'username' => $value->username,
        //         'nidn' => $value->nidn,
        //         'nip' => $value->nip,
        //         'tempat_lahir' => $value->tempat_lahir,
        //         'tanggal_lahir' => $value->tanggal_lahir,
        //         'email' => $value->email,
        //         'prodiID' => $value->prodiID,
        //         ]);
        // }
    $dosen = Dosen::all()->map(function ($data) {

    $temp = array_values(array_filter(explode('.', $data->prodiID)));
    $prodi = [];

    foreach ($temp as $v) {
        $p = prodi::where('id', $v)->first();

        if ($p) {
            $prodi[] = $p->nama;
        }
    }

    $data->prodi = implode(', ', $prodi);
    return $data;
});

        $data = [
            'dosen' => $dosen,
            'prodi' => prodi::all()
        ];

        return view('dosen::index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dosen::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'nidn' => 'required',
            'nip' => 'nullable',
            'email' => 'required',
            'prodi' => 'required',
        ]);

        $prodi = '.'.implode('.', $request->prodi).'.';
        $cek = Dosen::where('username', $request->username)->first();
        if ($cek) {
            return 'username sudah dipakai';
        }

        Dosen::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'nidn' => $request->nidn,
            'nip' => $request->email,
            'email' => $request->email,
            'prodiID' => $prodi,
        ]);

        return redirect(route('dosen.dosen.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('dosen::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dosen::edit');
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
        //
    }

    /**
     * Import dosen from file
     *
     * @param Request $request
     * @return void
     */
    public function import(Request $request, Excel $excel)
    {

        $request->validate([
            'file' => 'file|mimes:xlsx,xls|max:666'
        ]);

        $excel->import(new dosenImport, $request->file);
        return redirect(route('dosen.dosen.index'));
    }

    /**
     * Export all dosen
     *
     * @param Request $request
     * @param Excel $excel
     * @return void
     */
    public function export(Request $request, Excel $excel)
    {
        if ($request->jenis == 'excel') {
            return $excel->download(new dosenExport, 'Dosen.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        } elseif ($request->jenis == 'pdf') {
            $dosen = Dosen::all();
            $pdf = barPDF::loadView('modules.dosen.pdf', compact('dosen'));
            return $pdf->stream('Dosen');
        };
    }

}
