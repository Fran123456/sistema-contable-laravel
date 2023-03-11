<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class MeController extends Controller
{
    public function me(){
        return view('me.me');
    }

    public function updateMe(Request $request){
        $user = auth()->user();
        $user->name = $request->name;
        $user->save();
        return back()->with('success','Usuario modificado correctamente');
    }
}
