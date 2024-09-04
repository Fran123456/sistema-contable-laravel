<?php

namespace App\Models\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeDocumentoElectronico extends Model
{
    use HasFactory;

    protected $table = 'fe_documento_electronico';

    protected $filable = [
        'codigo_generacion',
        'numero_control',
        'json',
        'sello_recibido',
        'fecha',
        'mh_response',
        'procesado',
        'tipo_documento',
        'folio',
        'documento_id',
        'empresa_id'
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(FactTipoDocumento::class, 'tipo_documento')->withDefault();
    }

}
