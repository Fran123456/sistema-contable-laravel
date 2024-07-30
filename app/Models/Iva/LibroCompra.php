<?php

namespace App\Models\Iva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'empresa_id'
    ];

     // Definición de relaciones
    public function proveedor()
    {
        return $this->belongsTo('App\Models\SociosdeNegocio\SociosProveedores', 'proveedor_id');
    }

    public function detallePartida()
    {
        return $this->belongsTo('App\Models\Contabilidad\ContaDetallePartida', 'detalle_partida_id');
    }

    public function partida()
    {
        return $this->belongsTo('App\Models\Contabilidad\ContaPartidaContable', 'partida_id');
    }
}
