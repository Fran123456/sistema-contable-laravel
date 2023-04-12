<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class SettingController extends Controller
{
    public function settings(Request $request){
        $datatable = Config::where('category', 'datatable')->get();
        return view('users.settings.settings', compact('datatable'));
    }

    public function updateSetting(Request $request, $id){
        $setting =Config::find($id);
        $setting->value=$request->select;
        $setting->save();
        return back()->with('success', 'Configuración guardada correctamente');
    }
}
