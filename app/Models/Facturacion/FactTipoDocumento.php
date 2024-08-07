<?php

namespace App\Models\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactTipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'fact_tipo_documento';

    protected $fillable = [
        'tipo',
    ];
}
