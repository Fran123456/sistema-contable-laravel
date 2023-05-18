<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RRHH\RRHHEmpresa;
use App\Help\Help;
use App\Models\Contabilidad\ContaTipoPartida;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use App\Models\Contabilidad\ContaNivelCuenta;

class ConfiguracionController extends Controller
{
    //vista para copiar la configuracion contable de una empresa a otra
    public function indexCopiarInformacionContable()
    {
        $empresas = Help::usuario()->empresas;
        return view('contabilidad.configuracion.copiar_informacion_contable', compact('empresas'));
    }

    public function copiarInformacionContable(Request $request){
       
        $anexo= null;
        if($request->emp_de_copiar==null){
            return back()->with('danger','No se ha seleccionado empresa base para copiar información');
        }
        $empresaDeCopiar = RRHHEmpresa::find($request->emp_de_copiar);
        $empresaApasar = RRHHEmpresa::find($request->emp_a_pasar);

        if($request->op=='tipo'){
           $tiposAcopiar = ContaTipoPartida::where('empresa_id',$request->emp_de_copiar)->get();
           if(count($tiposAcopiar)== 0){
             return back()->with('danger','No existen tipos de partidas para la empresa: ' . $empresaDeCopiar->empresa);
           }
           foreach ($tiposAcopiar as $key => $value) {
            ContaTipoPartida::create([
                'tipo'=> $value->tipo,
                'descripcion'=> $value->descripcion,
                'empresa_id'=>$empresaApasar->id,
                'activo'=> true
            ]);
           }
           $anexo="de los tipos de partida";
        }


        if($request->op=='clasificacion'){
            $acopiar = ContaClasificacionCuenta::where('empresa_id',$request->emp_de_copiar)->get();
            if(count($acopiar)== 0){
              return back()->with('danger','No existen clasificaciones de cuentas contables para la empresa: ' . $empresaDeCopiar->empresa);
            }
            foreach ($acopiar as $key => $value) {
                ContaClasificacionCuenta::create([
                 'clasificacion'=> $value->clasificacion,
                 'empresa_id'=>$empresaApasar->id,
             ]);
            }
            $anexo="de las clasificaciones de cuentas contables";
         }


         if($request->op=='nivel'){
            $acopiar = ContaNivelCuenta::where('empresa_id',$request->emp_de_copiar)->get();
            if(count($acopiar)== 0){
              return back()->with('danger','No existen niveles de cuentas contables para la empresa: ' . $empresaDeCopiar->empresa);
            }
            foreach ($acopiar as $key => $value) {
                ContaNivelCuenta::create([
                 'nivel'=> $value->nivel,
                 'empresa_id'=>$empresaApasar->id,
             ]);
            }
            $anexo="de los niveles de cuentas contables";
         }

        return back()->with('success','La información '.$anexo.' se han copiado 
        correctamente de la empresa <trong>'.$empresaDeCopiar->empresa.'</trong> a la empresa 
        <strong>'.$empresaApasar->empresa.'</strong>' );
    }
}
