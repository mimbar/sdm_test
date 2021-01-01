<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    public $table = 'mata_kuliah';
    protected $fillable = [
        'singkatan','nama'
    ];
}
