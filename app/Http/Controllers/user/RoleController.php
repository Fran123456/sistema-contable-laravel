<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Help\Log;
use App\Help\Help;
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
        $permissions = Permission::groupBy('opcion')->get();
        
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

            Log::log('Roles y permiso', 'crear rol', 'El usuario '. Help::usuario()->name.' ha creado el rol '. $request->role );

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
        //$permissions = Permission::all();
        $permissions = Permission::groupBy('opcion')->get();
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
        $RelPermissions = [];
        foreach ($request->permission as $key => $value) {
            $p = Permission::where('opcion', $value)->get();
            foreach ($p as $key => $per) {
               array_push($RelPermissions, $per->name);
            }
        }
       
        $permissions = $RelPermissions;

        try {
            DB::beginTransaction();
            $roleValidate = Role::where('name', $request->role)->where('id','!=', $id)->first();
            if ($roleValidate) {
                return back()->with('danger', 'Error, no se puede modificar el rol porque ya existe uno con el nombre solicitado');
            }


            $role = Role::find($id);
            $role->name = $request->role;
            $role->save();
            foreach ($permissions as $key => $value) {
                $role->givePermissionTo($value);
            }

            Log::log('Roles y permiso', 'editar rol', 'El usuario '. Help::usuario()->name.' ha editado el rol '. $request->role);
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
        $role = Role::find($id);
        if(count($role->users)> 0){
            Log::log('Roles y permiso', 'eliminar rol', 'El usuario '. Help::usuario()->name.' intento eliminar el rol '. $role->name.' , pero no se pudo borrar porque el rol esta asignado a uno o más usuarios.');
            return back()->with('danger', 'No se puede eliminar el rol porque esta siendo utilizado');
        }
        Role::destroy($id);
        Log::log('Roles y permiso', 'eliminar rol', 'El usuario '. Help::usuario()->name.' ha eliminado el rol '. $role->name);
        return back()->with('success', 'Se ha eliminado correctamente el rol');
    }

    public function destroyPermissions(Request $request, $id){
        $role = Role::find($id);
        $role->revokePermissionTo($request->permission);
        Log::log('Roles y permiso', 'eliminar permiso', 'El usuario '. Help::usuario()->name.' ha eliminado el permiso '. $request->permission.
         ' del rol ' .$role->name);
        return back()->with('success','Se ha eliminado el permiso del rol correctamente');
    }
}
