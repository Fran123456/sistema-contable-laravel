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
use App\Models\FacturacionElectronica\FeActividadEconomica;
use App\Help\Log;
use App\Help\Help;
use App\Imports\ClienteImport;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = SociosCliente::where('empresa_id', help::empresa())->orderBy('id', 'desc')->get();
        return view('SociosdeNegocio.Cliente.index', compact('cliente'));
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
        $actividadesEconomicas = FeActividadEconomica::orderBy('valor', 'asc')->get();
        return view('sociosdeNegocio.Cliente.create', compact('tipoCliente', 'magnitudCliente', 'paises', 'clasificacion', 'usuario_creo', 'actividadesEconomicas'));
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
    
        return view('sociosdeNegocio.Cliente.show', compact('cliente','tipoCliente', 'magnitudCliente', 'paises', 'clasificacion', 'departamento','distrito'));
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
        $actividadesEconomicas = FeActividadEconomica::orderBy('valor', 'asc')->get();
    
        return view('sociosdeNegocio.Cliente.edit', compact('cliente','tipoCliente', 'magnitudCliente', 'paises', 'clasificacion', 'departamento','distrito','actividadesEconomicas'));

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
        $mensaje ='deshabilitado';
        if($cliente->activo){
            $cliente->activo =false;
        }else{
            $cliente->activo = true;
            $mensaje ='habilitado';
        }
      

        Log::log('SociosdeNegocio', "Deshabilitar cliente",'El cliente ' .  $cliente->nombre . " ".$cliente->apellido .' ha sido deshabilitado por el usuario '. Help::usuario()->name);
        $cliente->save();
        return to_route('socios.cliente.index')->with('success','Se ha '.$mensaje.' el cliente correctamente');
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

    public function ShowExcel () {
        return view('SociosdeNegocio.Cliente.showExcel');
    }

    // funcion para descargar el documento de excel
    public function descargarExcel()
    {
        // Define la ruta completa del archivo
        $rutaArchivo = public_path('importaciones/Clientes.xlsx');

        // Verifica si el archivo existe
        if (file_exists($rutaArchivo)) {
            // Devuelve el archivo como una respuesta de descarga
            return Response::download($rutaArchivo);
        } else {
            // Maneja el error si el archivo no existe
            return redirect()->back()->with('error', 'El archivo no existe.');
        }
    }

    function importExcel(Request $request) {

        $import = new ClienteImport();
        Excel::import($import, $request->file('excel'));

        // if ($import->getErrores()) {
        //     return back()->with('errors', "{$import->getErrores()} errores");
        // }
        $errores = $import->getErrores();
        $ingresados = $import->getIngresados();
        $rows = $import->getNumeroFilas();

        return back()->with('errores',$errores)->with('ingresados', $ingresados)->with("rows", $rows);

    }
    
}
