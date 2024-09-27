<?php

namespace App\Models\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\RRHH\RRHHEmpresa;

class ConfPartidasAutomaticas extends Model
{
    use HasFactory;

    protected $table = 'conf_partidas_automaticas';

    protected $fillable = [
        'cuenta_id',
        'tipo',
        'descripcion',
        'titulo',
        'empresa_id',
    ];

    public function cuentaContable()
    {
        return $this->belongsTo(ContaCuentaContable::class, 'cuenta_id');
    }

    public function empresa()
    {
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }
}
