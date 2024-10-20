<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaRubroCuentas extends Model
{
    use HasFactory;

    protected $table = 'conta_rubro_cuentas_rpt';


    protected $fillable = [
        'numero_cuenta',
        'cuenta_id',
        'rubro',
        'signo',
        'saldo',
        'grupo_id',
        'empresa_id'
    ];

    public function cuenta()
    {
        return $this->belongsTo(ContaCuentaContable::class, 'cuenta_id');
    }
}
