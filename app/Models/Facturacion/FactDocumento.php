<?php

namespace App\Models\Facturacion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facturacion\FactFacturacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Facturacion\FactEstadoFacturacion;
use App\Models\SociosNegocio\SociosCliente;
use App\Models\Facturacion\FactTipoDocumento;
class FactDocumento extends Model
{
    use HasFactory;

    protected $table = 'fact_documento';

    protected $fillable = ['id',
        'documento','facturacion_id','serial','tipo_documento_id','cliente_id','proveedor_id','monto',
        'estado_facturacion_id','posteado_id','fecha_emision','creado_por','empresa_id','created_at','updated_at'
    ];

    public function estado()
    {
        return $this->belongsTo(FactEstadoFacturacion::class, 'estado_id');
    }

    public function facturacion()
    {
        return $this->belongsTo(FactFacturacion::class, 'facturacion_id');
    }
    public function tipoDocumento()
    {
        return $this->belongsTo(FactTipoDocumento::class, 'tipo_documento_id');
    }

    public function detalles()
    {
        return $this->hasMany(FactDocumentoDetalle::class, 'documento_id');
    }
}
