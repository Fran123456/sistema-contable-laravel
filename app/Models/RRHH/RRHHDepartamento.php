<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHDepartamento extends Model
{
    use HasFactory;
    protected $table = "rrhh_departamento";
    protected $filliable = [
        'departamento',
        'area_id',
        'empresa_id',
        'created_at',
        'updated_at',
    ];

    public function empresa(){
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }
    
    public function area(){
        return $this->belongsTo(RRHHArea::class, 'area_id');
    }
}
