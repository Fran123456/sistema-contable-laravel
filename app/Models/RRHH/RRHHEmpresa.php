<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHEmpresa extends Model
{
    use HasFactory;
    protected $table = 'rrhh_empresa';
    protected $fillable = [
        'actualizada','created_at','updated_at','empresa'
    ];

   

}
