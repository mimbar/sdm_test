<?php

namespace Modules\Datatables\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\Permission;
use Modules\Auth\Entities\Role;

class KitchenController extends Controller
{

    public function allRoles()
    {
        $roles = Role::all();
        return datatables()->of($roles)->toJson();
    }

    public function allPermissions()
    {
        $permissions = Permission::all();
        return datatables()->of($permissions)->toJson();
    }
}
