<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEmpresa extends Model
{
    use HasFactory;
    protected $table = 'config_estados_empresas';
    protected $fillable = ['id', 'estado'];
}

