<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RRHH\RRHHArea;
use App\Models\RRHH\RRHHEmpresa;
use App\Models\RRHH\RRHHDepartamento;

class RRHHPuesto extends Model
{
    use HasFactory;
    protected $table = "rrhh_puesto";
    protected $filliable = [
        'puesto',
        'empresa_id',
        'area_id',
        'departamento_id',
        'activo',
        'created_at',
        'updated_at',
    ];

    public function empresa(){
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }
    
    public function area(){
        return $this->belongsTo(RRHHArea::class, 'area_id');
    }

    public function departamento(){
        return $this->belongsTo(RRHHDepartamento::class, 'departamento_id');
    }
}
