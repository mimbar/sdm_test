<?php

namespace Modules\Auth\Entities;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    protected $fillable = [
        'name','display_name','description'
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
