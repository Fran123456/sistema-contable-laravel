<?php

namespace App\Http\Controllers\SociosDeNegocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SociosDeNegocio\SociosContacto;
use App\Models\SociosDeNegocio\SociosCargo;
use App\Help\Log;
use Illuminate\Support\Facades\Storage;




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
        $contactos = SociosContacto::all();
        
        return view('sociosdenegocio.contacto.index', compact('contactos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $cargos = SociosCargo::all();
        return view('sociosdenegocio.contacto.create', compact('user', 'cargos'));
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
            'telefono'=> 'required|string|max:8',
            'cargo_id'=> 'required|string',
            'estado'=> 'required|string',
            'cv' => 'mimes:pdf,docx',
        ]);
        
        $contacto = (new SociosContacto)->fill( $request->all() );
        
        //Valida si el campo cv tiene un archivo, para no enviar datos null
        if($request->hasFile('cv')){
            //Guarda el archivo en la carpeta cv y con el nombre otiginal del archivo
            $contacto->cv = $request->file('cv')->storeAs('public/cv', $contacto->cv->getClientOriginalName());
        }
        try {
            $contacto->save();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
