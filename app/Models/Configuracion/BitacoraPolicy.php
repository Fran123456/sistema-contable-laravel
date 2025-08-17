<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RRHH\RRHHEmpresa;

class BitacoraPolicy extends Model
{
    use HasFactory;
    protected $fillable = [
        'empresa_id',
        'user_id',
        'accion',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

     public function bitacoras()
    {
        return $this->hasMany(BitacoraPolicy::class);
    }

     public function empresa()
    {
        return $this->belongsTo(RRHHEmpresa::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
