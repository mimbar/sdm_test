<?php

namespace Modules\Users\Entities;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;


class User extends Authenticatable
{
    use LaratrustUserTrait, Notifiable;

    protected $guard_name = 'web';

    protected $fillable = [
        'username', 'email', 'sex',
        'first_degree', 'name', 'degree', 'level'
    ];

    protected $hidden = [
        'password',
    ];

}
