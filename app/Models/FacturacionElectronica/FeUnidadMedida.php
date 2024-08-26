<?php

namespace App\Models\FacturacionElectronica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeUnidadMedida extends Model
{
    use HasFactory;

    protected $table = 'fe_unidad_medidas';

    protected $fillable = [
        'codigo',
        'valor',
    ];
}
