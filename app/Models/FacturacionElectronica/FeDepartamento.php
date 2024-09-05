<?php

namespace App\Models\FacturacionElectronica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeDepartamento extends Model
{
    use HasFactory;

    protected $table = 'fe_departamentos';

    protected $fillable = [
        'codigo',
        'valor',
    ];
}
