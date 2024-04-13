<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaBalanceConf extends Model
{
    use HasFactory;
    protected $table = 'conta_balance_conf';
    protected $fillable = [
        'id',
        'cuenta_id',
        'codigo',
        'nombre_cuenta',
        'balance',
        'grupo',
        'mayor',
        'orden',
        'anexo',
        'cantidad',
        'underline',
        'created_at',
        'updated_at',
        'espacio',
        'bold',
        'empresa_id',
        'editar',
        // 'categoria',
        // 'titulo',
        // 'descripcion',
        // 'campo',
        // 'valor',
        // 'tipo',
    ];

    public function cuenta(){
        return $this->belongsTo(ContaCuentaContable::class, 'cuenta_id');
    }
}
