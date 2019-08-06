<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;

class StatusPegawai extends Model
{
    protected $table = 'status_pegawai';
    protected $fillable = [
        'nama','description'
    ];
}
