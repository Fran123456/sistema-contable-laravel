<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaTipoPartida extends Model
{
    use HasFactory;
    protected $table = 'conta_tipo_partida';
    protected $fillable = [
        'activo','tipo','created_at','updated_at','descripcion'
    ];

}
