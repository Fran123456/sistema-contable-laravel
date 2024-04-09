<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Producto\ProProducto;
class ProProductoProveedor extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pro_producto_proveedor';
    protected $fillable=[
        'producto_id','id',
        'proveedor_id','precio_unitario','producto','codigo','created_at','updated_at'
    ];

    public function productoVenta()
    {
        return $this->belongsTo(ProProducto::class, "producto_id");
    }
    // public function proveedor()
    // {
    //     return $this->belongsTo(Supplier::class, "proveedor_id");
    // }

    // public function proveedores($productoVenta){
    //     return ProProductoProveedor::with('proveedor')->where('producto_id', $productoVenta)->get();
    // }







}
