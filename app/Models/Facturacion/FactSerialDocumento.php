<?php

namespace App\Models\Facturacion;

use App\Models\RRHH\RRHHEmpresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactSerialDocumento extends Model
{
    use HasFactory;
    protected $table = 'fact_serial_documento';
    protected $fillable = [
        'tipo_documento_id',
        'serial',
        'correlativo_inicial',
        'correlativo_actual',
        'ultimo_correlativo',
        'empresa_id',
        'activo',
        'created_at',
        'updated_at'
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(FactTipoDocumento::class, 'tipo_documento_id');
    }

    public function empresa()
    {
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }
}
