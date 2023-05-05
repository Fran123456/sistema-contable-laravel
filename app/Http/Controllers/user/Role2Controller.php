<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function createRole(Request $request)
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function storeRole(Request $request)
    {
        try {
            DB::beginTransaction();
            $roleValidate = Role::where('name', $request->role)->first();
            if ($roleValidate) {
                return back()->with('danger', 'Error, no se puede agregar el rol porque ya existe');
            }

            $role = Role::create(['name' => $request->role]);
            $role->syncPermissions($request->permission);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }

        return redirect()->route('roles.roles')->with('success', 'Rol creado correctamente');
    }

    public function roles()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    public function destroyRole($id)
    {
        Role::destroy($id);
        return back()->with('success', 'Se ha eliminado correctamente el rol');
    }

    public function editRole(){

    }

    public function updateRole(){

    }

    public function destroyPermissions(){

    }
}
