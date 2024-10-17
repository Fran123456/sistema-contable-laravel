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
        'estado_facturacion_id','posteado_id','fecha_emision','creado_por','empresa_id','created_at','updated_at', 'tipo_pago_id'
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
    public function formaPago()
    {
        return $this->belongsTo(FeFormaPago::class, 'tipo_pago_id');
    }
    public function detalles()
    {
        return $this->hasMany(FactDocumentoDetalle::class, 'documento_id');
    }

    public function total(){
        return $this->detalles()->sum('total');
    }

    public function iva(){
        return $this->detalles()->sum('iva');
    }

    public function subTotal(){
        return $this->detalles()->sum('sub_total');
    }

    public function ivaRetenido(){
        return $this->detalles()->sum('iva_retenido');
    }

    public function excentas(){
        return $this->detalles()->sum('exenta');
    }
    public function gravadas(){
        return $this->detalles()->sum('gravada');
    }

    public function noSujeto(){
        return $this->detalles()->sum('nosujeta');
    }
}
