<?php

namespace App\Models\Facturacion;

use App\Models\RRHH\RRHHEmpresa;
use App\Models\Facturacion\FactEstadoFacturacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SociosdeNegocio\SociosCliente;
class FactFacturacion extends Model
{
    use HasFactory;

    protected $table = 'fact_facturacion';

    protected $fillable = [
        'estado_id',
        'creado_por',
        'codigo',
        'monto_facturar',
        'monto_facturado',
        'fecha_facturacion',
        'empresa_id',
        'cliente_id',
        'tipo_factura_id',
        'anulado'
    ];

    public function estado()
    {
        return $this->belongsTo(FactEstadoFacturacion::class, 'estado_id');
    }

    public function cliente()
    {
        return $this->belongsTo(SociosCliente::class, 'cliente_id');
    }

    public function empresa()
    {
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }
    public function documentos()
    {
        return $this->hasMany(FactDocumento::class, 'facturacion_id');
    }
}
