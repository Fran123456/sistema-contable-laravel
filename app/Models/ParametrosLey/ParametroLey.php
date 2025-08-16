<?php

namespace App\Models\ParametrosLey;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametroLey extends Model
{
    use HasFactory;

    protected $table = 'parametros_ley';
    protected $primaryKey = 'id_parametro';
    public $timestamps = true;

    protected $fillable = [
        'tipo', 'valor', 'empresa_id', 'fecha_inicio', 'fecha_fin', 'estado', 'creado_por'
    ];
}
