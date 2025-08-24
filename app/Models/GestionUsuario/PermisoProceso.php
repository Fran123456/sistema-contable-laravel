<?php

namespace App\Models\GestionUsuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoProceso extends Model
{
    use HasFactory;
   protected $table = 'tbl_permisos_proceso';
   protected $fillable = ['rol_id', 'modulo', 'proceso' , 'subproceso','permiso_lectura','permiso_escritura', 'permiso_eliminar', 'created_at', 'updated_at'];

}

