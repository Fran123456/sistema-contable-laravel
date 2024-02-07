<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RRHH\RRHHPermiso;

class RRHHTipoPermiso extends Model
{
    use HasFactory;

    protected $table = "rrhh_tipo_permiso";

    protected $fillable = [
        "id",
        "tipo",
        "created_at",
        "updated_at",
    ];

    public function permisos(){
        return $this->hasMany(RRHHPermiso::class, 'tipo_permiso_id', 'id');
    }
}
