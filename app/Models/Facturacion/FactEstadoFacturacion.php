<?php

namespace App\Models\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactEstadoFacturacion extends Model
{
    use HasFactory;

    protected $table = 'fact_estado_facturacion';

    protected $fillable = [
        'estado',
    ];

    public function facturaciones()
    {
        return $this->hasMany(FactFacturacion::class, 'estado_id');
    }
}
