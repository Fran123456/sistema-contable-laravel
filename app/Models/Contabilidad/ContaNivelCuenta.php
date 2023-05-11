<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaNivelCuenta extends Model
{
    use HasFactory;
    protected $table = 'conta_nivel_cuenta_contable';
    protected $fillable = [
        'nivel','created_at','updated_at'
    ];

}
