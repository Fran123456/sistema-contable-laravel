<?php

namespace App\Http\Controllers\RRHH;

use App\Help\Help;
use App\Help\Log;
use App\Http\Controllers\Controller;
use App\Models\RRHH\RRHHAfp;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AfpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $afps = RRHHAfp::where('id_empresa', Help::empresa())->get();


        return view('RRHH.afp.index', compact('afps'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('RRHH.afp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();

        $validator = Validator::make($request->all(), [
            'afp' => 'required|string|max:60',
            'porciento_empleador' => 'required|numeric|min:0',
            'porciento_empleado' => 'required|numeric|min:0',
        ]);

        $validator->validate();

        $afp = RRHHAfp::where('afp', $request->afp)->first();

        if ( $afp )
            return back()->with('danger', 'Ya existe un registro el mismo nombre de AFP.');

        $afp = RRHHAfp::create([
            'afp' => trim($request->afp),
            'id_empresa' => Help::empresa(),
            'porciento_empleador' => $request->porciento_empleador,
            'porciento_empleado' => $request->porciento_empleado,
        ]);

        try {
            $afp->save();
            $log = 'afp creado con id ' . $afp->id . ' Para la empresa con id ' . Help::empresa() . ' Por el usuario con id ' . Help::usuario()->id;
            Log::log('RRHH', 'afp creado', $log);
            return redirect()->route('rrhh.afp.index')->with('success', 'El registro de la AFP se guardo con éxito.');
        } catch( Exception $e){
            Log::log('RRHH', 'error al tratar de guardar afp', $e);
            return back()->with('danger', 'Ocurrio un error al tratar de guardar el registro.');
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
        $afp = RRHHAfp::find($id);
        return view('RRHH.afp.edit', compact('afp'));
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
        $request->flash();

        $validator = Validator::make($request->all(), [
            'afp' => 'required|string|max:60',
            'porciento_empleador' => 'required|numeric|min:0',
            'porciento_empleado' => 'required|numeric|min:0',
        ]);

        $validator->validate();

        $afp = RRHHAfp::where('afp', $request->afp)->where('id', '!=', $id)->first();

        if ( $afp )
            return back()->with('danger', 'Ya existe un registro el mismo nombre de AFP.');

        $afp = RRHHAfp::find($id);

        if ( !$afp )
            return back()->with('danger', 'El registro que desea actualizar, no existe.');

        $afp->afp = trim($request->afp);
        $afp->porciento_empleador = $request->porciento_empleador;
        $afp->porciento_empleado = $request->porciento_empleado;

        try {
            $afp->save();
            $log = 'afp con id' . $afp->id . ' se actualizo, para la empresa con id ' . Help::empresa() . ' Por el usuario con id ' . Help::usuario()->id;
            Log::log('RRHH', 'afp actualizado', $log);
            return redirect()->route('rrhh.afp.index')->with('El registro de la AFP se actualizo correctamente.');
        } catch( Exception $e){
            Log::log('RRHH', 'error al tratar de actualizar afp con id ' . $afp->id, $e);
            return back()->with('danger', 'Ocurrio un error al tratar de actulizar el registro.');
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
        $afp = RRHHAfp::find($id);

        if( !$afp )
            return back()->with('danger', 'No se puede eliminar el registro porque no fue encontrado.');

        try {
            $afp->delete();
            $log = 'afp con id' . $afp->id . ' se elimino, para la empresa con id ' . Help::empresa() . ' Por el usuario con id ' . Help::usuario()->id;
            Log::log('RRHH', 'empleado creado', $log);
            return back()->with('success', 'El registro de elimino con éxito.');

        } catch(Exception $e) {
            return back()->with('danger', 'El registro no se pudo eliminar. \n' . $e);
        }

    }
}
