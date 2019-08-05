<?php

namespace Modules\Auth\Entities;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;


class User extends Authenticatable
{
    use LaratrustUserTrait, Notifiable;

    protected $guard_name = 'web';

    protected $fillable = [
        'username', 'email', 'password', 'name', 'clean', 'active'
    ];

    protected $hidden = [
        'password',
    ];

    public function level(){
        return $this->belongsToMany(Role::class);
    }

}
