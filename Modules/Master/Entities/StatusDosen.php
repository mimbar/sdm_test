<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;

class StatusDosen extends Model
{
    protected $table = 'status_dosen';
    protected $fillable = [
        'nama','description'
    ];
}
