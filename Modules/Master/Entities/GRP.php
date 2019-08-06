<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;

class GRP extends Model
{
    public $table = 'golongan_ruang_pangkat';
    protected $fillable = [
        'golongan', 'ruang','pangkat'
    ];
}
