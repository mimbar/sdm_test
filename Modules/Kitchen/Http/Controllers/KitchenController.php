<?php

namespace Modules\Kitchen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Auth\Entities\Permission;
use Modules\Auth\Entities\Role;
use Modules\Users\Entities\User;

class KitchenController extends Controller
{

    public function usersIndex()
    {
        $roles = Role::all();
        return view('kitchen::users', compact('roles'));
    }

    public function usersCreate(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
            ]);

            $user = new User([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make('siliwangi'),
            ]);
            $user->save();
            $user->syncRoles([$request->input('rolesID')]);
            DB::commit();
            return \response()->json([
                'code' => 200
            ]);
        } catch (ValidationException $exception){
            $arrError = $exception->errors();
            $arrImplode = [];
            foreach ($arrError as $key=>$value ) {
                $arrImplode[] = implode( ', ', $value );
            }
            $report = '<br><ul>';
            foreach ($arrImplode as $data){
                $report .= "<li>$data</li>";
            }
            $report .= '</ul>';

            DB::rollBack();
            return \response()->json([
                'code' => 500,
                'message' => $report
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }

    }

    public function usersUpdate(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required'
            ]);

            $user = User::find($request->input('id'));
            $user->name = $request->input('name');
            $user->active = $request->input('active');
            $user->save();
            $user->syncRoles([$request->input('rolesID')]);
            DB::commit();
            return \response()->json([
                'code' => 200
            ]);
        } catch (ValidationException $exception){
            $arrError = $exception->errors();
            $arrImplode = [];
            foreach ($arrError as $key=>$value ) {
                $arrImplode[] = implode( ', ', $value );
            }
            $report = '<br><ul>';
            foreach ($arrImplode as $data){
                $report .= "<li>$data</li>";
            }
            $report .= '</ul>';

            DB::rollBack();
            return \response()->json([
                'code' => 500,
                'message' => $report
            ]);
        } catch (\Exception $exception) {
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
    }

    public function usersCheckUsername(Request $request){
        try{
            $user = User::where('username','=',$request->post('username'));
            if ($user->exists())
                $return = 409;
            else
                $return = 200;

            return response()->json($return);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }

    public function usersCheckEmail(Request $request){
        try{
            $user = User::where('email','=',$request->post('email'));
            if ($user->exists())
                $return = 409;
            else
                $return = 200;

            return response()->json($return);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }

    public function usersReset(Request $request){
        try{
            $user = User::find($request->input('id'));
            $user->password = Hash::make('siliwangi');
            $user->clean = 0;
            $user->save();

            return \response()->json([
                'code' => 200
            ]);
        }catch (\Exception $exception){
            return \response()->json([
                'code' => 500,
                'message' => getenv('APP_ENV') == 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal Input data"
            ]);
        }
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
           $roles = Role::find(session('rolesID'));
           $roles->syncPermissions($request->input('id') ?? []);
           return \response()->json([
               'code' => 200
           ]);
       }catch (\Exception $exception){
           return \response()->json([
               'code' => 500,
               'message' => getenv('APP_ENV') > 'local' ? $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine() : "Gagal menyunting data"
           ]);
       }
    }


}
