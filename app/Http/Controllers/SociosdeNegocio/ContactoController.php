<?php

namespace App\Http\Controllers\SociosdeNegocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SociosdeNegocio\SociosContacto;
use App\Models\SociosdeNegocio\SociosCargo;
use App\Models\SociosdeNegocio\SociosRegistro;
use App\Help\Log;
use App\Help\Help;
use App\Models\EntidadTerritorial\EntPais;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contactos = SociosContacto::orderBy('id', 'desc')->get();

        return view('sociosdeNegocio.Contacto.index', compact('contactos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = auth()->user();
        $cargos = SociosCargo::all();
        $paises = EntPais::all();
        return view('sociosdeNegocio.Contacto.create', compact('usuario', 'cargos','paises'));
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
            'telefono'=> 'required|string|max:16',
            'cargo_id'=> 'required|string',
            'pais_id'=> 'required|string',
            'estado'=> 'required|string',
            'cv' => 'mimes:pdf,docx',
            'portafolio' => 'nullable|string',
        ]);
        
        $contacto = (new SociosContacto)->fill($request->all());

        //Valida si el campo cv tiene un archivo, para no enviar datos null
        if ($request->hasFile('cv')) {
            //Guarda el archivo en la carpeta cv y con el nombre otiginal del archivo
            //  $contacto->cv = $request->file('cv')->storeAs('public/cv', $contacto->cv->getClientOriginalName());
            $contacto->cv = Help::uploadFile($request, 'cv', '', 'cv', $ramdonName = true);
        }
        try {
            $contacto->portafolio = $request->portafolio;
            $contacto->save();
            $registro = SociosRegistro::create([
                'observacion' => "Se acaba de crear el contacto con estado " . $request->estado,
                'contacto_id' => $contacto->id,
            ]);
            return to_route('socios.contacto.index')->with('success', 'Contacto creado correctamente ');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'contacto error al crear el contacto', $e);
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
        $contacto = SociosContacto::find($id);
        $cargos = SociosCargo::all();
        $paises = EntPais::all();
        return view('sociosdeNegocio.Contacto.show', compact('contacto','cargos','paises'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = auth()->user();
        $contacto = SociosContacto::find($id);
        $cargos = SociosCargo::all();
        $paises = EntPais::all();
        return view('sociosdeNegocio.Contacto.edit', compact('contacto', 'usuario', 'cargos','paises'));
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
            'telefono'=> 'required|string|max:8',
            'cargo_id'=> 'required|string',
            'pais_id'=> 'required|string',
            'estado'=> 'required|string',
            'cv' => 'mimes:pdf,docx',
            'portafolio' => 'nullable|string',
        ]);

        $contacto = SociosContacto::find($id);
        $estadoAnterior = $contacto->estado;
        $url_cv = $contacto->cv;
        if ($request->hasFile('cv')) {

            $cv = $request->file('cv');
            $nombreCv = $cv->getClientOriginalName();
            $url_cv = 'public/cv/' . $nombreCv;
            ///Verificar si el archivo existe antes de eliminarlo
            $eliminar = 'cv/' . $contacto->cv;
            if (Storage::exists($eliminar)) {
                Storage::delete($eliminar);
            }

            // $cv->storeAs('public/cv/' , $nombreCv);
            $contacto->cv = Help::uploadFile($request, 'cv', '', 'cv', $ramdonName = true);

        }

        if ($estadoAnterior != $request->estado) {
            $registro = SociosRegistro::create([
                'observacion' => "Se ha cambiado del estado " . $estadoAnterior . " al estado " . $request->estado,
                'contacto_id' => $contacto->id,
            ]);
        }

        $contacto->nombre = $request->nombre;
        $contacto->apellido = $request->apellido;
        $contacto->correo = $request->correo;
        $contacto->telefono = $request->telefono;
        $contacto->contactado_en = $request->contactado_en;
        $contacto->persona_encuentra_id = $request->persona_encuentra_id;
        $contacto->tipo_contrato = $request->tipo_contrato;
        $contacto->estado = $request->estado;
        //  $contacto->cv = $url_cv;
        $contacto->cargo_id = $request->cargo_id;
        $contacto->pais_id = $request->pais_id;
        $contacto->anexo = $request->anexo;
        $contacto->portafolio = $request->portafolio;

        try {
            $contacto->save();
            Log::log('SociosdeNegocio', "Editar contacto", 'El contacto ' . $contacto->nombre . " " . $contacto->apellido . ' ha sido actualizado por el usuario ' . Help::usuario()->name);
            return to_route('socios.contacto.index')->with('success', 'Contacto actualizado correctamente');

        } catch (Exception $e) {
            Log::log('SociosdeNegocio', 'contacto error al actualizar el contacto', $e);
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
        $contacto = SociosContacto::find($id);
        $url =  $contacto->cv;
        
        $contacto->registro()->delete();

        if (Storage::exists($url)) {
            Storage::delete($url);
        }

        Log::log('SociosdeNegocio', "Eliminar contacto", 'El contacto ' . $contacto->nombre . " " . $contacto->apellido . ' ha sido eliminado por el usuario ' . Help::usuario()->name);
        SociosContacto::destroy($id);
        return to_route('socios.contacto.index')->with('success', 'Se ha eliminado el contacto correctamente');


    }

    public function showSelectedIds(Request $request)
    {
        $ids = explode(',', $request->selected_ids);
        $contactosSeleccionados = SociosContacto::whereIn('id', $ids)->get();
        return view('sociosdeNegocio.Contacto.showIds', compact('contactosSeleccionados'));

    }
}