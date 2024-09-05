<?php

namespace App\Models\FacturacionElectronica;

use App\Models\RRHH\RRHHEmpresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeDocumentoElectronico extends Model
{
    use HasFactory;


    protected $table = 'fe_documento_electronico';

    protected $fillable = [
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
        'empresa_id',
    ];


    public function tipoDocumento()
    {
        return $this->belongsTo(FeTipoDocumento::class, 'tipo_documento', 'codigo');
    }

    public function empresa()
    {
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }
}
