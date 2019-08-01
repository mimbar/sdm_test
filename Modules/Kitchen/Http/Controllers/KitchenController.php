<?php

namespace Modules\Kitchen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\Permission;
use Modules\Auth\Entities\Role;

class KitchenController extends Controller
{

    public function usersIndex()
    {
        return view('kitchen::users');
    }

    public function usersCreate()
    {
    }

    public function usersUpdate()
    {
    }

    public function usersDelete()
    {
    }

    public function rolesIndex()
    {
        $roles = Role::all();
        return view('kitchen::roles', compact('roles'));
    }

    public function rolesCreate(Request $request)
    {
        try {
            $roles = new Role([
                'name' => $request->input('name'),
                'display_name' => $request->input('display_name'),
                'description' => $request->input('description'),
            ]);
            $roles->save();

            return \response()->json([
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function rolesUpdate(Request $request)
    {
        try {
            $roles = Role::find($request->input('id'));
            $roles->name = $request->input('name');
            $roles->display_name = $request->input('display_name');
            $roles->description = $request->input('description');

            $roles->save();

            return \response()->json([
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') > 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal menyunting data"
            ]);
        }
    }

    public function rolesDelete(Request $request)
    {
        try {
            $roles = Role::find($request->input('id'));
            $roles->delete();

            return \response()->json([
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') > 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal menghapus data"
            ]);
        }
    }


    public function permissionsIndex()
    {
        $permissions = Permission::all();
        return view('kitchen::permissions', compact('permissions'));
    }

    public function permissionsCreate(Request $request)
    {
        try {
            $permissions = new Permission([
                'name' => $request->input('name'),
                'display_name' => $request->input('display_name'),
                'description' => $request->input('description'),
            ]);
            $permissions->save();

            return \response()->json([
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function permissionsUpdate(Request $request)
    {
        try {
            $permissions = Permission::find($request->input('id'));
            $permissions->name = $request->input('name');
            $permissions->display_name = $request->input('display_name');
            $permissions->description = $request->input('description');

            $permissions->save();

            return \response()->json([
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') > 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal menyunting data"
            ]);
        }
    }

    public function permissionsDelete(Request $request)
    {
        try {
            $permissions = Permission::find($request->input('id'));
            $permissions->delete();

            return \response()->json([
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') > 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal menghapus data"
            ]);
        }
    }

    public function assignIndex(){
        $roles = Role::all();
        $permissions = Permission::with(['roles' => function($q){
            $q->where('id','=',session('rolesID'));
        }])->get();
        return view('kitchen::assign', compact('roles','permissions'));
    }

    public function assignSetRoles(Request $request){
        session([
            'rolesID' => $request->input('id')
        ]);
        return redirect()->back();
    }

    public function assignSetPermissions(Request $request){
       try{
           dd($request->all());
       }catch (\Exception $exception){

       }
    }


}
