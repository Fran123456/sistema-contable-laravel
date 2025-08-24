<?php

namespace App\Http\Controllers\GestionUsuarios;

use App\Http\Controllers\Controller;
use App\Help\Help;
use App\Help\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\GestionUsuario\Usuario;
use App\Models\GestionUsuario\Rol;
use App\Models\GestionUsuario\BitacoraAcceso;
use App\Models\GestionUsuario\PermisoProceso;
use Carbon\Carbon;
use App\Models\Configuracion\GestionEmpresas;
use Exception;

class UsuariosController extends Controller
{
    /**
     * Mostrar listado de usuarios con sus roles y empresas asignadas.
     */
    public function index()
    {
        $usuarios = Usuario::with(['rol', 'empresa'])->get();
        $roles = Rol::all();
        $empresas = GestionEmpresas::all();

        return view('GestionUsuarios.index', compact('usuarios', 'roles', 'empresas'));
    }

    /**
     * Asignar usuario a empresa y rol.
     */
    public function asignarEmpresaRol(Request $request, $id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        $usuario->rol_id = $request->rol_id;
        $usuario->empresa_id = $request->empresa_id; // campo que ya tengas definido
        $usuario->save();

        return back()->with('success', 'Usuario asignado correctamente a empresa y rol');
    }

    /**
     * Activar o desactivar usuario.
     */
    public function toggleEstado($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        $usuario->estado = !$usuario->estado;
        $usuario->save();

        return back()->with('success', 'Estado del usuario actualizado');
    }

    /**
     * Registrar en bitácora cada acceso.
     */
    public function registrarBitacora($modulo)
    {
        BitacoraAcceso::create([
            'usuario_id' => Auth::id(),
            'fecha_hora' => Carbon::now(),
            'ip' => request()->ip(),
            'modulo' => $modulo
        ]);
    }

    /**
     * Bloqueo tras intentos fallidos.
     */
    public function login(Request $request)
    {
        $usuario = Usuario::where('usuario_login', $request->usuario_login)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->contrasena_hash)) {
            if ($usuario) {
                $usuario->intentos_fallidos += 1;

                if ($usuario->intentos_fallidos >= 3) {
                    $usuario->estado = false; // lo bloqueamos
                }

                $usuario->save();
            }

            return back()->withErrors(['login' => 'Usuario o contraseña incorrecta']);
        }

        if (!$usuario->estado) {
            return back()->withErrors(['login' => 'Cuenta bloqueada o inactiva']);
        }

        $usuario->intentos_fallidos = 0;
        $usuario->save();

        Auth::login($usuario);

        $this->registrarBitacora('Login');

        return redirect()->route('dashboard');
    }

    /**
     * Panel de funciones bloqueadas para usuario.
     */
    public function bloquearFunciones(Request $request, $id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);

        // Guardamos la lista de procesos bloqueados
        $usuario->permisos()->sync($request->permisos); // relación con tbl_permisos_proceso

        return back()->with('success', 'Permisos de usuario actualizados');
    }
    /**
     * Mostrar detalle de un usuario junto con su bitácora.
     */
    public function show($id_usuario)
    {
        $usuario = Usuario::with(['rol', 'empresa'])->findOrFail($id_usuario);
        $bitacora = $usuario->bitacoras()->orderBy('fecha_acceso', 'desc')->get();

        return view('GestionUsuarios.show', compact('usuario', 'bitacora'));
    }

    /**
     * Mostrar formulario para crear un nuevo usuario
     */
    public function create()
    {
        $roles = Rol::all();                 // Todos los roles disponibles
        $empresas = GestionEmpresas::all();  // Todas las empresas disponibles

        return view('GestionUsuarios.create', compact('roles', 'empresas'));
    }

    /*añadir lo creado create*/

    public function store(Request $request)
     {

        $request->validate([
            'nombre_completo'=>'required|string|max:300',
            'correo'=>'required|string|max:300',
            'usuario_login'=>'required|string',
            'contrasena_hash'=>'required',
            'fecha_creacion'=>'required',
            'creado_por'=>'required',
//            'intentos_fallidos'=>'required',
            
            'rol_id'=>'required',
        ]);

        $Usuario = new Usuario();
        $Usuario->nombre_completo = $request->nombre_completo;
        $Usuario->correo = $request->correo;
        $Usuario->usuario_login = $request->usuario_login;
        $Usuario->contrasena_hash = $request->contrasena_hash;
        $Usuario->fecha_creacion = $request->fecha_creacion;
        $Usuario->creado_por = $request->creado_por;
         
        try{
            $Usuario->save();
            return redirect()->route('GestionUsuarios.index')->with('succes','Usuario creado correctamente' . Help::Usuarios());
        } catch(Exception $e){
            Log::log('Usuarios', 'error al crear el usuario', $e);
            return back()->with('danger','Ocurrio un error al crear el usuario');

        }

    }

    /**
 * Formulario de edición de usuario
 */
public function edit($id_usuario)
{
    $usuario  = Usuario::findOrFail($id_usuario);
    $roles    = Rol::all();
    $empresas = GestionEmpresas::all(); // modelo que usas para empresas

    return view('GestionUsuarios.edit', compact('usuario','roles','empresas'));
}

/**
 * Actualizar usuario
 */
public function update(Request $request, $id_usuario)
{
    $usuario = Usuario::findOrFail($id_usuario);

    $request->validate([
        'nombre_completo' => 'required|string|max:100',
        'correo'          => 'required|email|unique:tbl_usuarios,correo,'.$usuario->id_usuario.',id_usuario',
        'usuario_login'   => 'required|string|max:50|unique:tbl_usuarios,usuario_login,'.$usuario->id_usuario.',id_usuario',
        'rol_id'          => 'required|exists:tbl_roles,id_rol',
        'empresa_id'      => 'required|exists:config_empresas,id',
        'password'        => 'nullable|string|min:6', // opcional
        'estado'          => 'nullable|boolean',
    ]);

    // Campos base
    $usuario->nombre_completo = $request->nombre_completo;
    $usuario->correo          = $request->correo;
    $usuario->usuario_login   = $request->usuario_login;
    $usuario->rol_id          = $request->rol_id;
   // $usuario->empresa_id      = $request->empresa_id;
    if ($request->filled('estado')) {
        $usuario->estado = (bool)$request->estado;
    }

    // Cambio de contraseña (opcional)
    if ($request->filled('password')) {
        $usuario->contrasena_hash = Hash::make($request->password);
        // opcional: resetear intentos al cambiar contraseña
        $usuario->intentos_fallidos = 0;
        $usuario->bloqueado_hasta   = null;
    }

    $usuario->save();

    return redirect()->route('GestionUsuarios.index')->with('success','Usuario actualizado correctamente.');
}



}
