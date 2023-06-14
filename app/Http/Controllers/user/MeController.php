<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Help\Log;
use App\Help\Help;
class MeController extends Controller
{
    public function me(){
        return view('me.me');
    }

    public function updateMe(Request $request){
        $user = auth()->user();
        $user->name = $request->name;
        $user->save();
        Log::log('Perfil', 'Actualizar perfil', 'El usuario '. Help::usuario()->name.' actualizo su perfil ' );

        return back()->with('success','Usuario modificado correctamente');
    }
}
