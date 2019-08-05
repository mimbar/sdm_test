<?php

namespace Modules\Datatables\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\Permission;
use Modules\Auth\Entities\Role;
use Modules\Auth\Entities\User;
use Modules\Master\Entities\UnitKerja;

class KitchenController extends Controller
{
    public function allUsers(){
        $users = User::with('level')->get();
        return datatables()->of($users)->toJson();
    }

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

    public function allUnitKerja()
    {
        $permissions = UnitKerja::all();
        return datatables()->of($permissions)->toJson();
    }
}
