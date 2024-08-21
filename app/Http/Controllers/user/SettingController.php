<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Help\Help;   
use App\Help\Log;

class SettingController extends Controller
{
    public function settings(Request $request){
        $user = auth()->user(); 
        $datatable = Config::where('category', 'datatable')
                            ->where('empresa_id', $user->empresa_id) // filtrar configuraciones por empresa_id del usuario
                            ->get();
        return view('users.settings.settings', compact('datatable'));
    }

    public function updateSetting(Request $request, $id){
        $setting =Config::find($id);
        $setting->value=$request->select;
        $setting->save();
        Log::log('Configuraciones', 'Actualizar configuración', 'El usuario '. Help::usuario()->name.' actualizo la configuración '. $setting->category.'::'.$setting->title );

        return back()->with('success', 'Configuración guardada correctamente');
    }

    public function settingsByKey($key){
        $user = auth()->user();
        $data = Config::where('category', $key)
                      ->where('empresa_id', $user->empresa_id) 
                      ->get();
        return view('users.settings.'.$key, compact('data'));
    }

    public function generalSettings(){
        $user = auth()->user();
        $logo = Config::where('category', 'general')
                      ->where('field', 'logo')
                      ->where('empresa_id', $user->empresa_id) 
                      ->first();
        return view('users.settings.general', compact('logo'));
    }

    // public function changeLogo(Request $request, $id){
    //    $img =  Help::uploadFile($request, 'assets/images/logo', '' ,'image');
    //    $config = Config::find($id);
    //    if($config->updated_at != null){
    //     Help::deleteFile( $config->value, null);
    //    }
    //    $config->update(['value'=>'assets/images/logo/'.$img]);
    //    Log::log('Configuraciones', 'Actualizar configuración', 'El usuario '. Help::usuario()->name.' actualizo la configuración '. $config->cateory.'::'.$config->title );

    //    return back()->with('success','Logo cambiado correctamente');
    // }

    public function changeLogo(Request $request, $id){
        $user = auth()->user(); 
        $empresa_id = $user->empresa_id; // Obtener el ID de la empresa del usuario
    
        // Buscar la configuración del logo para la empresa del usuario
        $config = Config::where('empresa_id', $empresa_id)
                        ->where('category', 'general')
                        ->where('field', 'logo')
                        ->firstOrFail();
    
        // Subir el nuevo logo
        $img = Help::uploadFile($request, 'assets/images/logo', '', 'image');
    
        // Eliminar el logo anterior si existe
        if ($config->value) { // Verifica si hay un valor anterior en la configuración
            Help::deleteFile($config->value, null);
        }
    
        // Actualizar la configuración con la nueva ruta del logo
        $config->update(['value' => 'assets/images/logo/' . $img]);
        Log::log('Configuraciones', 'Actualizar configuración', 'El usuario ' . $user->name . ' actualizó la configuración ' . $config->category . '::' . $config->title);
    
        return back()->with('success','Logo cambiado correctamente');
    }
}
