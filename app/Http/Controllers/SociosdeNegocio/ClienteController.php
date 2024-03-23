<?php

namespace App\Http\Controllers\SociosdeNegocio;

use App\Http\Controllers\Controller;
use App\Models\SociosdeNegocio\SociosCliente;
use Illuminate\Http\Request;
use App\Help\Cliente\Cliente;
use App\Models\EntidadTerritorial\EntPais;
use App\Models\SociosdeNegocio\SociosClasificacionCliente;
use App\Models\EntidadTerritorial\EntDepartamento;
use App\Models\EntidadTerritorial\EntDistrito;
use App\Help\Log;
use App\Help\Help;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = SociosCliente::orderBy('id', 'desc')->get();
        return view('SociosdeNegocio.cliente.index', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoCliente = Cliente::tipo();
        $magnitudCliente = Cliente::magnitud();
        $paises = EntPais::all();
        $clasificacion = SociosClasificacionCliente::orderBy('tipo')->get();
        $usuario_creo = auth()->user();
        return view('SociosdeNegocio.cliente.create', compact('tipoCliente', 'magnitudCliente', 'paises', 'clasificacion', 'usuario_creo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=> 'required|string|max:200',
            'apellido'=> 'required|string|max:200',
            'nit'=> 'required|string',
            'dui'=> 'required|string',
            'correo'=> 'required|string|max:200',
            'clasificacion_cliente_id'=> 'required|integer',
            'tipo_cliente'=> 'required|string|max:200',
            'magnitud_cliente'=> 'required|string|max:200',

        ]);
        
        $cliente =SociosCliente::create($request->all());

        try {
            $cliente->save();
            return to_route('socios.cliente.index')->with('success', 'Cliente creado correctamente');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'Cliente error al crear el cliente', $e);
            return back()->with('danger', 'Error, no se puede procesar la petición');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = SociosCliente::find($id); 
        $tipoCliente = Cliente::tipo();
        $magnitudCliente = Cliente::magnitud();
        $paises = EntPais::all();
        $clasificacion = SociosClasificacionCliente::all();
        $departamento = $cliente->departamento_id;
        $distrito = $cliente->distrito_id;
    
        return view('SociosdeNegocio.cliente.show', compact('cliente','tipoCliente', 'magnitudCliente', 'paises', 'clasificacion', 'departamento','distrito'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = SociosCliente::find($id); 
        $tipoCliente = Cliente::tipo();
        $magnitudCliente = Cliente::magnitud();
        $paises = EntPais::all();
        $clasificacion = SociosClasificacionCliente::all();
        $departamento = $cliente->departamento_id;
        $distrito = $cliente->distrito_id;
    
        return view('SociosdeNegocio.cliente.edit', compact('cliente','tipoCliente', 'magnitudCliente', 'paises', 'clasificacion', 'departamento','distrito'));

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
        $request->validate([
            'nombre'=> 'required|string|max:200',
            'apellido'=> 'required|string|max:200',
            'nit'=> 'required|string',
            'dui'=> 'required|string',
            'correo'=> 'required|string|max:200',
            'clasificacion_cliente_id'=> 'required|integer',
            'tipo_cliente'=> 'required|string|max:200',
            'magnitud_cliente'=> 'required|string|max:200',

        ]);

        $cliente = SociosCliente::find($id);
        $cliente->update($request->all());

        try {
            $cliente->save();
            Log::log('SociosdeNegocio', "Editar cliente",'El cliente ' .  $cliente->nombre . " ".' ha sido actualizado por el usuario '. Help::usuario()->name);
            return to_route('socios.cliente.index')->with('success', 'Cliente actualizado correctamente');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'Cliente error al actualizar el cliente', $e);
            return back()->with('danger', 'Error, no se puede procesar la petición');
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
        $cliente = SociosCliente::find($id);

        Log::log('SociosdeNegocio', "Eliminar cliente",'El cliente ' .  $cliente->nombre . " ".$cliente->apellido .' ha sido eliminado por el usuario '. Help::usuario()->name);
        $cliente->delete();
        return to_route('socios.cliente.index')->with('success','Se ha eliminado el cliente correctamente');


    }
    
    public function deshabilitarCliente($id){
        $cliente = SociosCliente::find($id);
        $cliente->activo = false;

        Log::log('SociosdeNegocio', "Deshabilitar cliente",'El cliente ' .  $cliente->nombre . " ".$cliente->apellido .' ha sido deshabilitado por el usuario '. Help::usuario()->name);
        $cliente->save();
        return to_route('socios.cliente.index')->with('success','Se ha deshabilitado el cliente correctamente');
    }

    public function habilitarCliente($id){
        $cliente = SociosCliente::find($id);
        $cliente->activo = true;

        Log::log('SociosdeNegocio', "Habilitar cliente",'El cliente ' .  $cliente->nombre . " ".$cliente->apellido .' ha sido habilitado por el usuario '. Help::usuario()->name);
        $cliente->save();
        return to_route('socios.cliente.index')->with('success','Se ha habilitado el cliente correctamente');
    }

    public function obtenerDepartamentos($paisId)
    {
        $departamentos = EntDepartamento::where('pais_id', $paisId)->get();
        return response()->json($departamentos);
    }

    public function obtenerDistritos($departamentoId)
    {
        $distritos = EntDistrito::where('departamento_id', $departamentoId)->orderBy('distrito')->get();
        return response()->json($distritos);
    }
}
