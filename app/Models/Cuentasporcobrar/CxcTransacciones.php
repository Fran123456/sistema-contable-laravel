<?php

namespace App\Models\Cuentasporcobrar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CxcTransacciones extends Model
{
    use HasFactory;

    protected $table='cxc_transacciones';
    protected $fillable=[
            'documento_id',
            'monto',
            'fecha',
            'estado_id',
            'cliente_id',
           'referencia',
            'anulada'
            
    ] ;

    public function estado(){

        return $this->hasMany(CxcEstado::class,'estado_id');
    
}
}