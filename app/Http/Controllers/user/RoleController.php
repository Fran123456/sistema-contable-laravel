<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('role.edit', compact('permissions','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $roleValidate = Role::where('name', $request->role)->where('id','!=', $id)->first();
            if ($roleValidate) {
                return back()->with('danger', 'Error, no se puede modificar el rol porque ya existe uno con el nombre solicitado');
            }

            $role = Role::find($id);
            $role = $request->role;
            $role->save();
            $role->givePermissionTo($request->permission);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
        return back()->with('success', 'Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return back()->with('success', 'Se ha eliminado correctamente el rol');
    }

    public function destroyPermissions(Request $request, $id){
        $role = Role::find($id);
        $role->revokePermissionTo($request->permission);
        return back()->with('success','Se ha eliminado el permiso del rol correctamente');
    }
}
