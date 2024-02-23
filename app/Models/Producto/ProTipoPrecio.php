<?php

namespace App\Models\Producto;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ProProducto;


class ProTipoPrecio extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pro_tipo_precio';
    protected $fillable=[
        'id',
        'tipo',
    ];

    public function productos(){
        return $this->belongsToMany(ProProducto::class, 'pro_producto_tipo_precio','tipo_precio_id','producto_id');
    }


    public function combos(){
        return $this->belongsToMany(ProProducto::class, 'pro_combo_tipo_precio','tipo_precio_id','combo_id');
    }





}
