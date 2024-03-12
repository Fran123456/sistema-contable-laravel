<?php

namespace App\Models\EntidadTerritorial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntPais extends Model
{
    use HasFactory;
    protected $table = 'ent_pais';
    protected $fillable = [
        'pais'
    ];
}
