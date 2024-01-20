<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaBalanceConf extends Model
{
    use HasFactory;
    protected $table = 'conta_balance_conf';
    protected $fillable = [
        'cuenta_id','created_at','updated_at','codigo','nombre_cuenta','balance','grupo','mayor','orden','anexo','cantidad',
        'underline','espacio','bold','empresa_id'
    ];

    public function cuenta(){
        return $this->belongsTo(ContaCuentaContable::class, 'cuenta_id');
    }
}
