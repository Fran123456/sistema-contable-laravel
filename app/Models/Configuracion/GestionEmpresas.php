<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestionEmpresas extends Model
{
    use HasFactory;
    protected $table = 'config_empresas';
    protected $fillable = ['nombre_empresa', 'nit', 'nrc', 'direccion', 'email', 'telefono_empresa',
        'representante_legal', 'telefono_repre_legal', 'responsable_contrato', 'fecha_contrato', 'estado_id'];
}
