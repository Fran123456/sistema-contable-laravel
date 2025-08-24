<?php

namespace App\Models\GestionUsuario;

use App\Models\Configuracion\GestionEmpresas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;

   protected $table = 'tbl_usuarios';
   protected $fillable = ['nombre_comleto', 'correo', 'usuario_login',
    'contrasena_hash', 'rol_id', 'estado', 'fecha_creacion', 'creado_por', 'intentos_fallidos'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_usuario'; // ¡Esta es la línea crucial!

    // 🔗 Relación con Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'id_rol');
    }

    // 🔗 Relación con Empresa
     public function empresa()
    {
        return $this->belongsTo(GestionEmpresas::class, 'empresa_id', 'id');
    }

    public function bitacoras()
    {
        // Especificamos la clave foránea ('usuario_id') porque la clave primaria local
        // no se llama 'id'. Si no, Eloquent buscaría 'usuario_id' -> 'id'
        return $this->hasMany(BitacoraAcceso::class, 'usuario_id', 'id_usuario');
    }

}

