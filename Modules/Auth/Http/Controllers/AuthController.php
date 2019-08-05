<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Auth\Entities\Permission;
use Modules\Auth\Entities\Role;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::user()) {
            return redirect()->route('home.index');
        } else {
            return view('layouts.login');
        }
    }

    public function fresh()
    {
        if (Auth::user()) {
            $user = Auth::user();
            return view('layouts.fresh', compact('user'));
        } else {
            return redirect()->route('auth.login');
        }
    }

    public function locked()
    {
        if (Auth::user()) {
            $user = Auth::user();
            return view('layouts.locked', compact('user'));
        } else {
            return redirect()->route('auth.login');
        }
    }

    public function freshSetPassword(Request $request)
    {
        try {
            if (strlen($request->input('password1')) <= 5 or strlen($request->input('password2')) <= 5) {
                $redirect = redirect()->back()->with('updateStatus', [
                    'code' => 500,
                    'message' => "Password harus lebih dari 5 karakter"
                ]);
            } elseif ($request->input('password1') != $request->input('password2')) {
                $redirect = redirect()->back()->with('updateStatus', [
                    'code' => 500,
                    'message' => "Password tidak sama"
                ]);
            } elseif ($request->input('password1') == 'siliwangi' or $request->input('password2') == 'siliwangi') {
                $redirect = redirect()->back()->with('updateStatus', [
                    'code' => 500,
                    'message' => "Password tidak diizinkan menggunakan password <i>default</i>"
                ]);
            } elseif ($request->input('password1') == $request->input('password2')) {
                $user = Auth::user();
                $user->password = Hash::make($request->input('password1'));
                $user->clean = 1;
                $user->save();

                $redirect = redirect()->route('home.index');
            } else {
                $redirect = redirect()->back()->with('updateStatus', [
                    'code' => 500,
                    'message' => "Password tidak sama dan jangan gunakan password default <i>siliwangi</i>"
                ]);
            }
            return $redirect;
        } catch (\Exception $exception) {
            return redirect()->back()->with('updateStatus', [
                'code' => 500,
                'message' => env('ENVIRONMENT') === 'local' ? $exception->getMessage() : "Terjadi Kesalahan"
            ]);
        }
    }

    public function loginPost(Request $request)
    {
        try {
            $username = $request->input('username');
            $password = $request->input('password');

            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                Auth::attempt(['email' => $username, 'password' => $password]);
            } else {
                Auth::attempt(['username' => $username, 'password' => $password]);
            }

            if (Auth::check()) {
                if (Auth::user()->active == 0)
                    return redirect()->route('auth.locked');
                elseif (Auth::user()->clean == 0)
                    return redirect()->route('auth.fresh');
                else
                    return redirect()->route('home.index');
            }

            return redirect()->route('auth.view')->with('loginStatus', [
                'code' => 404,
            ]);

        } catch (\Exception $exception) {
            if (env('ENVIRONMENT') === 'dev')
                $return = redirect()->back()->with('loginStatus', [
                    'code' => 500,
                    'message' => $exception->getMessage()
                ]);
            else
                $return = redirect()->back()->with('loginStatus', [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan"
                ]);
            return $return;
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            session()->flush();
            return redirect()->route('auth.login');
        } catch (\Exception $exception) {
            return $exception;
        }
    }


    public function permission()
    {
        $permissions = Permission::all();
        return view('auth::management.permission.index', compact('permissions'));

    }

    public function storePermission(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required'
            ]);

            $permission = new Permission();
            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');
            $permission->save();

            DB::commit();
            $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                'code' => 200
            ]);

            return $return;
        } catch (ValidationException $exception) {
            $arrError = $exception->errors();
            foreach ($arrError as $key => $value) {
                $arrImplode[] = implode(', ', $value);
            }
            $report = '<br><ul>';
            foreach ($arrImplode as $data) {
                $report .= "<li>$data</li>";
            }
            $report .= '</ul>';

            DB::rollBack();
            if (env('ENVIRONMENT') === 'dev')
                $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                    'code' => 500,
                    'message' => $report
                ]);
            else
                $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan"
                ]);
            return $return;
        } catch (\Exception $exception) {
            DB::rollBack();
            if (env('ENVIRONMENT') === 'dev')
                $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                    'code' => 500,
                    'message' => $exception->getMessage()
                ]);
            else
                $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan"
                ]);
            return $return;
        }
    }

    public function updatePermission(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required'
            ]);

            $permission = Permission::find($request->input('id'));
            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');
            $permission->save();

            DB::commit();
            $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                'code' => 200
            ]);

            return $return;
        } catch (ValidationException $exception) {
            $arrError = $exception->errors();
            foreach ($arrError as $key => $value) {
                $arrImplode[] = implode(', ', $value);
            }
            $report = '<br><ul>';
            foreach ($arrImplode as $data) {
                $report .= "<li>$data</li>";
            }
            $report .= '</ul>';

            DB::rollBack();
            if (env('ENVIRONMENT') === 'dev')
                $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                    'code' => 500,
                    'message' => $report
                ]);
            else
                $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan"
                ]);
            return $return;
        } catch (\Exception $exception) {
            DB::rollBack();
            if (env('ENVIRONMENT') === 'dev')
                $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                    'code' => 500,
                    'message' => $exception->getMessage()
                ]);
            else
                $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan"
                ]);
            return $return;
        }
    }

    public function storeRole(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required'
            ]);

            $permission = new Role();
            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');
            $permission->save();

            DB::commit();
            $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                'code' => 200
            ]);

            return $return;
        } catch (ValidationException $exception) {
            $arrError = $exception->errors();
            foreach ($arrError as $key => $value) {
                $arrImplode[] = implode(', ', $value);
            }
            $report = '<br><ul>';
            foreach ($arrImplode as $data) {
                $report .= "<li>$data</li>";
            }
            $report .= '</ul>';

            DB::rollBack();
            if (env('ENVIRONMENT') === 'dev')
                $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                    'code' => 500,
                    'message' => $report
                ]);
            else
                $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan"
                ]);
            return $return;
        } catch (\Exception $exception) {
            DB::rollBack();
            if (env('ENVIRONMENT') === 'dev')
                $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                    'code' => 500,
                    'message' => $exception->getMessage()
                ]);
            else
                $return = redirect()->route('auth.manager.permission.read')->with('createStatus', [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan"
                ]);
            return $return;
        }
    }

    public function updateRole(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required'
            ]);

            $permission = Role::find($request->input('id'));
            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');
            $permission->save();

            DB::commit();
            $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                'code' => 200
            ]);

            return $return;
        } catch (ValidationException $exception) {
            $arrError = $exception->errors();
            foreach ($arrError as $key => $value) {
                $arrImplode[] = implode(', ', $value);
            }
            $report = '<br><ul>';
            foreach ($arrImplode as $data) {
                $report .= "<li>$data</li>";
            }
            $report .= '</ul>';

            DB::rollBack();
            if (env('ENVIRONMENT') === 'dev')
                $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                    'code' => 500,
                    'message' => $report
                ]);
            else
                $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan"
                ]);
            return $return;
        } catch (\Exception $exception) {
            DB::rollBack();
            if (env('ENVIRONMENT') === 'dev')
                $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                    'code' => 500,
                    'message' => $exception->getMessage()
                ]);
            else
                $return = redirect()->route('auth.manager.permission.read')->with('updateStatus', [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan"
                ]);
            return $return;
        }
    }

    public function assignRoleToPermission(Request $request)
    {
        try {
            $role = Role::find($request->input('id'));
            $role->syncPermissions($request->input('permission'));
            $return = [
                'code' => 200
            ];
            return response()->json($return);
        } catch (\Exception $exception) {
            if (env('ENVIRONMENT') === 'dev')
                $return = [
                    'code' => 500,
                    'message' => $exception->getMessage()
                ];
            else
                $return = [
                    'code' => 500,
                    'message' => 'Terjadi Kesalahan'
                ];

            return $return;
        }
    }
}
