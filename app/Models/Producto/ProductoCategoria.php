<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    use HasFactory;
    public $table = 'pro_producto_categoria';
    protected $fillable = [
        'categoria_id',
        'producto_id',
        'created_at',
        'updated_at',
    ];
    public function categorias()
    {
        return $this->belongsTo(ProCategoria::class, 'categoria_id');
    }
    public function productos()
    {
        return $this->belongsTo(ProProducto::class, 'producto_id');
    }
}
