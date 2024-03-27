<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ProProducto;

class ProCategoria extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pro_categoria';
    protected $fillable = [
        'id',
        'categoria',
        'empresa_id',
     
    ];


    public function productos()
    {
        return $this->belongsToMany(ProProducto::class, 'pro_producto_categoria', 'categoria_id', 'producto_id');
    }

}
