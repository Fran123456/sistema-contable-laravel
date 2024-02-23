<?php

namespace App\Models\Producto;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ProTipoProducto extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pro_tipo_producto';
    protected $fillable=[
        'id',
        'tipo',
    ];

    public const PRODUCTO_VENTA=1;

}

