<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use App\Help\Help;
use App\Models\Contabilidad\ContaNivelCuenta;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Imports\ContaCuentaContableImport;
use Maatwebsite\Excel\Facades\Excel;

class CuentaContableController extends Controller
{


    public function __construct()
    {
        
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $cuentas = ContaCuentaContable::where('empresa_id',Help::empresa())->get();
       return view('contabilidad.cuenta_contable.index',compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentas = ContaCuentaContable::where('activo',true)->where('empresa_id',Help::empresa())->get();
        $niveles = ContaNivelCuenta::where('empresa_id',Help::empresa())->get();
        $clasificacion = ContaClasificacionCuenta::where('empresa_id',Help::empresa())->get();
        return view('contabilidad.cuenta_contable.create',compact('cuentas','niveles','clasificacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ContaCuentaContable::create([
            'codigo'=>$request->codigo,
            'nombre_cuenta'=>$request->nombre,
            'padre_id'=>$request->padre,
            'hijos'=>0,
            'nivel_id'=>$request->nivel,
            'clasificacion_id'=>$request->clasificacion,
            'saldo'=> 0,
            'activo'=>$request->activo,
            'empresa_id'=>Help::empresa()
        ]);
        return back()->with('success','Cuenta creada correctamente');
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
        $cuentas = ContaCuentaContable::where('activo',true)->where('empresa_id',Help::empresa())->get();
        $niveles = ContaNivelCuenta::where('empresa_id',Help::empresa())->get();
        $clasificacion = ContaClasificacionCuenta::where('empresa_id',Help::empresa())->get();
        $cuenta = ContaCuentaContable::find($id);
        return view('contabilidad.cuenta_contable.edit',compact('cuentas','niveles','clasificacion','cuenta'));
    }

    public function importarCuentasExcel(Request $request){

       //$help = Help::uploadFile($request, 'import-excel-cuentas', '', 'excel', false);

        $import = new ContaCuentaContableImport(Help::empresa());
        Excel::import($import, request()->file('excel'));
        $rows        = $import->getNumeroFilas();
        $errores  = $import->getErrores();
        $ingresados = $import->getIngresados();
  
        return view('contabilidad.cuenta_contable.importar_excel_resumen', compact('rows','errores','ingresados'));
       
    }

    public function importarCuentasExcelView(Request $request){
        $niveles = ContaNivelCuenta::where('empresa_id',Help::empresa())->get();
        $clasificacion = ContaClasificacionCuenta::where('empresa_id',Help::empresa())->get();
       return view('contabilidad.cuenta_contable.importar_excel', compact('niveles','clasificacion'));
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
        $cuenta = ContaCuentaContable::find($id);
        if($request->solo_activo){
            $cuenta->activo =$cuenta->activo?false:true;
        }else{
            $cuenta->update([
                'codigo'=>$request->codigo,
                'nombre_cuenta'=>$request->nombre,
                'padre_id'=>$request->padre,
                'hijos'=>0,
                'nivel_id'=>$request->nivel,
                'clasificacion_id'=>$request->clasificacion,
                'saldo'=> 0,
                'activo'=>$request->activo
            ]);

            $this->validarHijo($request->padre, $id);
            
        }
        $cuenta->save();
        return redirect()->route('contabilidad.cuentas-contables.index')->with('success','Se ha modificado la cuenta contable correctamente');
    }

    public function validarHijo($padre, $hijo){
        //quitamos el hijo al padre
        $h = ContaCuentaContable::find($hijo);
        if($h->padre_id != null){
            $p = ContaCuentaContable::find($h->padre_id);
            if($p->hijos>0) $p->hijos = $p->hijos -1;
            $p->save();
        }

        //agregamos el nuevo hijo al nuevo padre
        if($padre != null){
            $p = ContaCuentaContable::find($padre);
            $p->hijos = $p->hijos +1;
            $p->save();
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContaCuentaContable::destroy($id);
        return back()->with('success','Se ha eliminado la cuenta contable correctamente');
    }
}
