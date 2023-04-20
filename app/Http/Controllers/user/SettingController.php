<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Help\Help;   

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

    public function settingsByKey($key){
        $data = Config::where('category', $key)->get();
        return view('users.settings.'.$key, compact('data'));
    }

    public function generalSettings(){
        $logo = Help::getConfigByKey('general','logo');
        return view('users.settings.general', compact('logo'));
    }

    public function changeLogo(Request $request, $id){
       $img =  Help::uploadFile($request, 'assets/images/logo', '' ,'image');
       $config = Config::find($id);
       if($config->updated_at != null){
        Help::deleteFile( $config->value, null);
       }
       $config->update(['value'=>'assets/images/logo/'.$img]);

       return back()->with('success','Logo cambiado correctamente');
    }
}
