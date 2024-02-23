<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto\ProProducto;
use Illuminate\Support\Facades\DB;
class ProCombo extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pro_combo';
    protected $fillable=[
        'id',
        'combo',
        'codigo',
        'estado',
        'precio','precio_fijo'
    ];


    public function productos(){
        return $this->belongsToMany(ProProducto::class, 'pro_combo_producto','combo_id','producto_id')
        ->withPivot('estado','tipo_precio_producto_id','id', 'precio','precio_venta','cantidad');
    }



    public function tiposPrecios(){
        return $this->belongsToMany(ProTipoPrecio::class, 'pro_combo_tipo_precio','combo_id','tipo_precio_id')
        ->withPivot('estado','id','precio');
    }





}
