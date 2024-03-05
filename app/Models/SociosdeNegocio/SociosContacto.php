<?php

namespace App\Models\SociosdeNegocio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SociosdeNegocio\SociosCargo;

class SociosContacto extends Model
{
    use HasFactory;
    protected $table = "socios_contactos";
    protected $fillable = [
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

    public function usuario(){
        return $this->belongsTo(User::class, 'persona_encuentra_id')->withDefault();
    }

    public function cargo(){
        return $this->belongsTo(SociosCargo::class, 'cargo_id')->withDefault();
    }
}
