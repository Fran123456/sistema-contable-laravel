<?php

namespace App\Models\SociosdeNegocio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EntidadTerritorial\EntPais;
use App\Models\Producto\ProProducto;
use App\Models\RRHH\RRHHEmpresa;

class SociosProveedores extends Model
{
    use HasFactory;
    protected $table = 'socios_proveedores';
    protected $fillable = [
        'nombre',
        'tipo_proveedor',
        'tipo_personalidad',
        'giro',
        'forma_pago',
        'numero_registro',
        'nit',
        'dui',
        'telefono',
        'direccion',
        'celular',
        'correo',
        'pais_id',
        'activo',
        'empresa_id',
        'created_at',
        'updated_at',
    ];

    public function pais(){
        return $this->belongsTo(EntPais::class, 'pais_id')->withDefault();
    }

    public function productos(){
        return $this->belongsToMany(ProProducto::class, 'pro_producto_proveedor', 'producto_id', 'proveedor_id');
    }

    public function empresa()
    {
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }
}
