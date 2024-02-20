<?php

namespace App\Models\SociosDeNegocio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SociosContacto extends Model
{
    use HasFactory;
    protected $table = "socios_contactos";
    protected $filliable = [
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'contactado_en',
        'persona_encuentra_id',
        'tipo_contrato',
        'estado',
        'cv',
        'cargo_id' ,
        'registro_id',
        'created_at',
        'updated_at',
    ];

    public function persona_encuentra_id(){
        return $this->belongsTo(User::class, 'persona_encuentra_id')->withDefault();
    }

}
