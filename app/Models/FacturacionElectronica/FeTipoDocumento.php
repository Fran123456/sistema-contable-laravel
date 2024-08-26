<?php

namespace App\Models\FacturacionElectronica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeTipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'fe_tipo_documentos';

    protected $fillable = [
        'codigo',
        'valor',
    ];
}
