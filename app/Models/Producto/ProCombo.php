<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProCombo extends Model
{
    use HasFactory; //

    // Define the table associated with the model (optional if the table name matches the plural form of the model name)
    protected $table = 'pro_combo';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'combo',
        'precio',
        'estado',
        'codigo',
    ];

    // Optionally, you can define the attributes that should be cast to native types
    protected $casts = [
        'precio' => 'decimal:2',
        'estado' => 'boolean',
    ];
    public function productos()
    {
        return $this->hasMany(ProComboProducto::class, 'combo_id');
    }
    public function comboTiposPrecios()
    {
        return $this->hasMany(ProComboTipoPrecio::class, 'combo_id');
    }

}
