<?php

namespace App\Models\Facturacion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facturacion\FactFacturacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Facturacion\FactEstadoFacturacion;
use App\Models\SociosNegocio\SociosCliente;
use App\Models\Facturacion\FactTipoDocumento;
use App\Models\Facturacion\FactDocumento;
use App\Models\Producto\ProProducto;
use App\Models\Producto\Servicio;
class FactDocumentoDetalle extends Model
{
    use HasFactory;

    protected $table = 'fact_documento_detalle';

    protected $fillable = ['id',
        'documento_id','facturacion_id','cliente_id','fecha_facturacion','producto_id','servicio_id','iva',
        'iva_percibido','iva_retenido','nosujeta','exenta','empresa_id','created_at','updated_at',
        'gravada','sub_total','total','creador_id','cantidad','precio_unitario','precio_sugerido','tipo_precio_id',
        'tipo_descuento','descuento'
    ];

    public function documento()
    {
        return $this->belongsTo(FactDocumento::class, 'documento_id');
    }

    public function facturacion()
    {
        return $this->belongsTo(FactFacturacion::class, 'facturacion_id');
    }

    public function cliente()
    {
        return $this->belongsTo(SociosCliente::class, 'cliente_id');
    }

    public function producto()
    {
        return $this->belongsTo(ProProducto::class, 'producto_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
}