<?php

namespace App\Models\Cuentasporcobrar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CxcEstado extends Model
{
    use HasFactory;

    protected $table='cxc_estado';
    protected $fillable=[
            'estado',
                 
    ] ;

    public function transaciones(){

        return $this->belongsTo(CxcTransacciones::class,'estado_id');
}
}  