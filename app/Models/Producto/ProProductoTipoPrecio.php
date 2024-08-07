<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProProductoTipoPrecio extends Model
{
    use HasFactory;

    protected $table = 'pro_producto_tipo_precio';

    protected $fillable = [
        'producto_id',
        'tipo_precio_id',
        'estado',
        'precio',
    ];

    
    public function producto()
    {
        return $this->belongsTo(ProProducto::class, 'producto_id');
    }

    
    public function tipoPrecio()
    {
        return $this->belongsTo(ProTipoPrecio::class, 'tipo_precio_id');
    }
}
