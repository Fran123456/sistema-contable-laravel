<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
class UserController extends Controller 
{
  

    public function updatePassword(Request $request, $id){
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('users.edit', $id)->with('success', 'Contraseña reseteada correctamente');
    }

    public function disableUser(Request $request, $id){
        $user = User::find($id);
        $user->disabled = $user->disabled == 0 ?1: 0;
        $user->save();
        return back()->with('success', 'Usuario modificado correctamente');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|',
        ]);
        if ($v->fails()) return redirect()->route('users.create')->withErrors($v->errors());


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        $team = DB::table('teams')->insertGetId([
            'user_id'=> $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
            'created_at'=>$user->created_at,
            'updated_at'=> $user->updated_at
        ]);

        DB::table('team_user')->insert([
            'user_id'=> $user->id,
            'team_id'=> $team,
            'role'=> 'admin',
            'created_at'=>$user->created_at,
            'updated_at'=> $user->updated_at
        ]);
        $user->current_team_id = $team;
        $user->save();
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
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
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->save();
        return redirect()->route('users.edit', $id)->with('success', 'Usuario editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //User::destroy($id);
        //return back()->with('success', 'Usuario eliminado correctamente');
    }


}
