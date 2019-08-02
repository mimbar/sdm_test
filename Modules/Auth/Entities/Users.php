<?php

namespace Modules\Users\Entities;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Modules\Auth\Entities\Role;


class User extends Authenticatable
{
    use LaratrustUserTrait, Notifiable;

    protected $guard_name = 'web';

    protected $fillable = [
        'username', 'email', 'password', 'name',
    ];

    protected $hidden = [
        'password',
    ];

    public function level(){
        return $this->belongsToMany(Role::class);
    }

}
