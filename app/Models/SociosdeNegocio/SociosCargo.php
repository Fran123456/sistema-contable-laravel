<?php

namespace App\Models\SociosdeNegocio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SociosCargo extends Model
{
    use HasFactory;
    protected $table = "socios_cargos";
    protected $fillable = [
        'cargo',
        'descripcion',
        'created_at',
        'updated_at',
    ];
}
