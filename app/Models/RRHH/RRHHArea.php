<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHArea extends Model
{
    use HasFactory;
    protected $table = "rrhh_area";
    protected $fillable = [
        'area',
        'empresa_id',
        'activo',
        'created_at',
        'updated_at',
    ];

    
    public function empresa(){
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }

}
