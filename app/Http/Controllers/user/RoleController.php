<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    public function createRole(Request $request){
        return view('role.create');
    }

    public function storeRole(Request $request){
        $role = Role::create(['name' => $request->role]);
        return redirect()->route('roles.roles')->with('success','Rol creado correctamente');
    }

    public function roles(){
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }
}
