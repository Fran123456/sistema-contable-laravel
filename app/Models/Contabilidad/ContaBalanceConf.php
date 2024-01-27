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
        'empresa_id',
        'categoria',
        'titulo',
        'descripcion',
        'campo',
        'valor',
        'tipo',
        'created_at',
        'updated_at',
    ];

    public function cuenta(){
        return $this->belongsTo(ContaCuentaContable::class, 'cuenta_id');
    }
}
