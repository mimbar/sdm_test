<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Dosen\Entities\Dosen;

class dosenImport implements ToCollection, WithHeadingRow
{
    use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $collection->each(function ($data) {
            $cek = Dosen::where('username', $data['username'])->first();
            if (!$cek) {
                try {
                    Dosen::create([
                        'nama' => $data['nama'],
                        'username' => $data['username'],
                        'nidn' => $data['nidn'],
                        'nip' => $data['nip'],
                        'tempat_lahir' => $data['tempat_lahir'],
                        'tanggal_lahir' => $data['tanggal_lahir'],
                        'email' => $data['email'],
                        'prodiID' => $data['prodiid']
                    ]);
                } catch (\Throwable $th) {
                    return [
                        'msg' => 'error',
                        'data' => $data
                    ];
                }
            } else {
                $cek->update([
                    'nama' => $data['nama'],
                    'nidn' => $data['nidn'],
                    'nip' => $data['nip'],
                    'tempat_lahir' => $data['tempat_lahir'],
                    'tanggal_lahir' => $data['tanggal_lahir'],
                    'email' => $data['email'],
                    'prodiID' => $data['prodiid']
                ]);
            }
        });
    }
}
