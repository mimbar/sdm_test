<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $fillable = [
        'gelar_depan',
        'nama',
        'gelar_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'status_kawin',
        'jumlah_tanggungan',
        'bankID',
        'nomor_rekening',
        'tanggal_masuk',
        'masa_kerja',
        'status_pegawai',
        'unitID',
        'nik',
        'npwp',
        'golonganID',
        'ruangID',
        'strukturalID',
        'fungstionalID',
        'aktif',
    ];

    public function unit(){
        return $this->belongsTo(UnitKerja::class,'unitID');
    }
}