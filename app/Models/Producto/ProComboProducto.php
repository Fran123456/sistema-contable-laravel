<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProComboProducto extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if the table name matches the plural form of the model name)
    protected $table = 'pro_combo_producto';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'combo_id',
        'producto_id',
        'precio',
        'precio_venta',
        'cantidad',
    ];

    // Define relationships
    public function combo()
    {
        return $this->belongsTo(ProCombo::class, 'combo_id');
    }

    public function producto()
    {
        return $this->belongsTo(ProProducto::class, 'producto_id');
    }
}
