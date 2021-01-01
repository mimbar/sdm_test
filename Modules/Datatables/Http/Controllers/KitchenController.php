<?php

namespace Modules\Datatables\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\Permission;
use Modules\Auth\Entities\Role;
use Modules\Auth\Entities\User;
use Modules\Master\Entities\GRP;
use Modules\Master\Entities\Pegawai;
use Modules\Master\Entities\Dosen;
use Modules\Master\Entities\StatusPegawai;
use Modules\Master\Entities\StatusDosen;
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

    public function allGrp()
    {
        $grp = GRP::all();
        return datatables()->of($grp)->toJson();
    }

    public function allStatusPegawai()
    {
        $statuspegawai = StatusPegawai::all();
        return datatables()->of($statuspegawai)->toJson();
    }

    public function allPegawai()
    {
        $pegawai = Pegawai::with('unit')->get();
        return datatables()->of($pegawai)->toJson();
    }

    public function allDosen()
    {
        $dosen = Dosen::with('unit')->get();
        return datatables()->of($dosen)->toJson();
    }
}
