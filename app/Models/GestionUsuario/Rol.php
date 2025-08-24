<?php

namespace App\Models\GestionUsuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'tbl_roles';
    protected $fillable = ['nombre_rol', 'descripcion', 'creado_por', 'fecha_creacion', 'estado' ];
    
}

