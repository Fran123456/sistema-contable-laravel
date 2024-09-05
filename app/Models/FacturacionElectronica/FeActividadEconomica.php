<?php

namespace App\Models\FacturacionElectronica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeActividadEconomica extends Model
{
    use HasFactory;

    protected $table = 'fe_actividad_economicas';

    protected $fillable = [
        'codigo',
        'valor',
    ];
}
