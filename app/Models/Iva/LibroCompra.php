<?php

namespace App\Models\Iva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SociosdeNegocio\SociosProveedores;
use App\Models\Contabilidad\ContaDetallePartida;
use App\Models\Contabilidad\ContaPartidaContable;
use App\Models\Facturacion\FactFacturacion;
use App\Models\RRHH\RRHHEmpresa;

class LibroCompra extends Model
{
    use HasFactory;
    protected $table = 'libro_compras';
    protected $fillable = [
        'fecha_emision',
        'fecha_emision_en_pdf',
        'documento',
        'nit',
        'dui',
        'nrc',
        'proveedor_id',
        'excentas_internas',
        'excentas_importaciones',
        'gravadas_internas',
        'gravadas_importaciones',
        'gravada_iva',
        'contribucion_especial',
        'anticipo_iva_retenido',
        'anticipo_iva_recibido',
        'total_compra',
        'compras_excluidas',
        'documento_id',
        'mostrar',
        'detalle_partida_id',
        'partida_id',
        'empresa_id',
        'created_at',
        'updated_at'
    ];

    public function proveedor()
    {
        return $this->belongsTo(SociosProveedores::class, 'proveedor_id');
    }

    public function factura()
    {
        return $this->belongsTo(FactFacturacion::class, 'documento_id');
    }

    public function detallePartida()
    {
        return $this->belongsTo(ContaDetallePartida::class, 'detalle_partida_id');
    }

    public function partida()
    {
        return $this->belongsTo(ContaPartidaContable::class, 'partida_id');
    }

    public function empresa()
    {
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }
}
