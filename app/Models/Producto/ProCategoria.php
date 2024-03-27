<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Producto\ProProducto;

class ProCategoria extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pro_categoria';
    protected $fillable = [
        'id',
        'categoria',
        'sub',
        'pro_categoria_id',
    ];


    public function productos()
    {
        return $this->belongsToMany(ProProducto::class, 'pro_producto_categoria', 'categoria_id', 'producto_id');
    }
    public function categoriaPadre()
    {
        return $this->belongsTo(ProCategoria::class, 'pro_categoria_id', 'id');
    }
    // public function atributoCategoria()
    // {
    //     return $this->hasMany(AtributosCategoria::class, 'pro_categoria_id');
    // }
    
}
