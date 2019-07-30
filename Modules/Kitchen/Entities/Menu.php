<?php

namespace Modules\Kitchen\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [];

    public function child(){
        return $this->hasMany(static::class,'parentsID');
    }
}
