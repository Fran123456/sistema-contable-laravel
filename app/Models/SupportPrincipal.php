<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportPrincipal extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'support_principal';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'mensaje',
        'gpt',
        'usuario_id',
        'fecha','created_at','updated_at','id'
    ];

    
}