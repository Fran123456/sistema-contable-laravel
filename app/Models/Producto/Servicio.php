<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'pro_servicios';

    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'cuenta_contable_ingreso',
        'cuenta_contable_costo',
        'cuenta_contable_ingreso_exterior',
        'cuenta_contable_costo_exterior',
        'empresa_id'
    ];

}