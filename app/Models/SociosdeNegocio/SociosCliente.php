<?php

namespace App\Models\SociosdeNegocio;

use App\Models\EntidadTerritorial\EntDepartamento;
use App\Models\EntidadTerritorial\EntDistrito;
use App\Models\EntidadTerritorial\EntPais;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class SociosCliente extends Model
{
    use HasFactory;
    protected $table = 'socios_cliente';
    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'dui',
        'nit',
        'clasificacion_cliente_id',
        'tipo_cliente',
        'magnitud_cliente',
        'usuario_creo_id',
        'correo',
        'direccion',
        'giro_negocio',
        'nrc',
        'activo',
        'pais_id',
        'departamento_id',
        'distrito_id',
        'telefono',
        'celular',
        'observaciones',
        'created_at',
        'updated_at',
    ];

    public function clasificacion(){
        return $this->belongsTo(SociosClasificacionCliente::class, 'clasificacion_cliente_id');
    }

    public function pais(){
        return $this->belongsTo(EntPais::class, 'pais_id')->withDefault();
    }

    public function departamento(){
        return $this->belongsTo(EntDepartamento::class, 'departamento_id')->withDefault();
    }
    
    public function distrito(){
        return $this->belongsTo(EntDistrito::class, 'distrito_id')->withDefault();
    }
    
}
