<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Producto\ProCategoria;
use App\Models\Producto\ProTipoPrecio;
use App\Models\SociosdeNegocio\SociosProveedores;

class ProProducto extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pro_producto';
    protected $fillable = [
        'id',
        'producto',
        'codigo',
        'imagen',
        'tipo_producto_id',
        'requiere_lote',
        'requiere_vencimiento',
        'alerta_stock',
        'descripcion',
        'activo',
        'empresa_id',
        'created_at',
        'updated_at',
    ];

    public function categorias()
    {
        return $this->belongsToMany(ProCategoria::class, 'pro_producto_categoria', 'producto_id', 'categoria_id')
        ;
    }

    public function tiposPrecios()
    {
        return $this->belongsToMany(ProTipoPrecio::class, 'pro_producto_tipo_precio', 'producto_id', 'tipo_precio_id')
            ->withPivot('estado', 'precio', 'id', 'precio');
    }

    public function combos()
    {
        return $this->hasMany(ProComboProducto::class, 'producto_id');
    }


    public function tipoProducto()
    {
        return $this->belongsTo(ProTipoProducto::class, 'tipo_producto_id')->withDefault();
    }

    public function productosPrecios()
    {
        return $this->hasMany(ProProductoTipoPrecio::class, 'producto_id');
    }

    public function proveedores()
    {
        return $this->belongsToMany(SociosProveedores::class, 'pro_producto_proveedor', 'producto_id', 'proveedor_id')
            ->withPivot(['precio_unitario', 'codigo', 'producto', 'stock', 'id']);
    }

}