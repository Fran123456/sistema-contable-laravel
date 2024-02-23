<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProComboProducto extends Model
{
    use HasFactory;
    public $table = 'pro_combo_producto';
    protected $fillable = [
        'combo_id',
        'producto_id',
        'tipo_precio_producto_id',
        'precio',
        'precio_venta',
        'estado',
        'cantidad',
        'created_at',
        'updated_at',
    ];

}
