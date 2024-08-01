<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProComboTipoPrecio extends Model
{
    use HasFactory;

    protected $table = 'pro_combo_tipo_precio';

    protected $fillable = [
        'combo_id',
        'tipo_precio_id',
        'precio',
        'precio_venta',
        'estado',
    ];

    public function combo()
    {
        return $this->belongsTo(ProCombo::class, 'combo_id');
    }

    public function tipoPrecio()
    {
        return $this->belongsTo(ProTipoPrecio::class, 'tipo_precio_id');
    }
}
