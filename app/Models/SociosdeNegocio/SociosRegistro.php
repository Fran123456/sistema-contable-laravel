<?php

namespace App\Models\SociosdeNegocio;

use App\Models\SociosDeNegocio\SociosContacto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SociosRegistro extends Model
{
    use HasFactory;
    protected $table = 'socios_registro_contacto';
    protected $fillable = [
        'contacto_id',
        'observacion',
        'created_at',
        'updated_at',
    ];

    public function contacto(){
        return $this->belongsTo(SociosContacto::class, 'contacto_id')->withDefault();
    }    
}
