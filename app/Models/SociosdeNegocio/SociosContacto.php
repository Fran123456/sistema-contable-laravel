<?php

namespace App\Models\SociosdeNegocio;

use App\Models\EntidadTerritorial\EntPais;
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
        'pais_id' ,
        'created_at',
        'updated_at',
        'anexo',
        'empresa_id'
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'persona_encuentra_id')->withDefault();
    }

    public function cargo(){
        return $this->belongsTo(SociosCargo::class, 'cargo_id')->withDefault();
    }

    public function pais(){
        return $this->belongsTo(EntPais::class, 'pais_id')->withDefault();
    }
    public function registro(){
        return $this->hasMany(SociosRegistro::class, 'contacto_id');
    }
}
