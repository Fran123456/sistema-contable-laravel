<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuracion\GestionEmpresas;
use App\Models\Configuracion\EstadoEmpresa;
use App\Help\Log;
use App\Help\Help;
use Exception;

class GestionEmpresasController extends Controller
{
    //muestra la principal
    public function index(){
        $empresas = GestionEmpresas::all();
        return view('Configuracion.gestionempresas.index', compact('empresas'));
        
    }

    //abrir formulario de añadir
    public function create(){
        $estados = EstadoEmpresa::all();
        return view('Configuracion.gestionempresas.create', compact('estados'));
    }

    //funcion de añadir
    public function store(Request $request){
        $request->validate([
            'nombre_empresa'=>'required|string|max:300',
            'nit'=>'required|string|max:300',
            'nrc'=>'required|string',
            'direccion'=>'required',
            'email'=>'required',
            'telefono_empresa'=>'required',
            'representante_legal'=>'required',
            'telefono_repre_legal'=>'required',
            'responsable_contrato'=>'required',
            'fecha_contrato'=>'required',
            'estado_id'=>'required',
        ]);

        $GestionEmpresa = new GestionEmpresas();
        $GestionEmpresa->nombre_empresa = $request->nombre_empresa;
        $GestionEmpresa->nit = $request->nit;
        $GestionEmpresa->nrc = $request->nrc;
        $GestionEmpresa->direccion = $request->direccion;
        $GestionEmpresa->email = $request->email;
        $GestionEmpresa->telefono_empresa = $request->telefono_empresa;
        $GestionEmpresa->representante_legal = $request->representante_legal;
        $GestionEmpresa->telefono_repre_legal = $request->telefono_repre_legal;
        $GestionEmpresa->responsable_contrato = $request->responsable_contrato;
        $GestionEmpresa->fecha_contrato = $request->fecha_contrato;
        $GestionEmpresa->estado_id = $request->estado_id;

        
        try {

            $GestionEmpresa->save();
            

            return redirect()->route('configuracion.gestionempresas.index')->with('success', 'Empresa creada correctamente ' . Help::empresa());

        } catch (Exception $e) {
            Log::log('Empresas', 'error al crear empresa', $e);
            return back()->with('danger', 'Ocurrio un error al crear la empresa');
        }
    }

    //abrir el formulario para editar
    public function edit(GestionEmpresas $empresa){
        $estados = EstadoEmpresa::all();
        return view('Configuracion.gestionempresas.edit', compact('empresa', 'estados'));
    }

    //actualizar
    public function update(Request $request, GestionEmpresas $empresa) {
        $validacion = $request->validate([
            'nombre_empresa'=>'required|string|max:300',
            'nit'=>'required|string|max:300',
            'nrc'=>'required|string',
            'direccion'=>'required',
            'email'=>'required',
            'telefono_empresa'=>'required',
            'representante_legal'=>'required',
            'telefono_repre_legal'=>'required',
            'responsable_contrato'=>'required',
            'fecha_contrato'=>'required',
            'estado_id'=>'required',
        ]);
        

        try {

            $empresa->update($validacion);
            

            return redirect()->route('configuracion.gestionempresas.index')->with('success', 'Empresa actualizada correctamente ' . Help::empresa());

        } catch (Exception $e) {
            Log::log('Empresas', 'error al actualizar empresa', $e);
            return back()->with('danger', 'Ocurrio un error al actualizar la empresa');
        }

    }

    //eliminar
    public function destroy($empresa)
    {
        $empresa = GestionEmpresas::find($empresa);
        if (!$empresa)
            return back()->with('error', 'Ocurrio un error al eliminar la empresa');
    try {
        $empresa->delete();
        return redirect()->route('configuracion.gestionempresas.index')
            ->with('success', 'Empresa eliminada correctamente');
    } catch (\Exception $e) {
        return back()->with('danger', 'No se pudo eliminar la empresa: ' . $e->getMessage());
    }
    }
    
}
