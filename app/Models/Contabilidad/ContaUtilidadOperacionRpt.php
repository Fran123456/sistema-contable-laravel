<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaUtilidadOperacionRpt extends Model
{
    use HasFactory;

    protected $table = "conta_utilidad_operacion_rpt";

    protected $fillable = [
        'signo',
        'utilidad_id',
        'utilidad_operacion_id',
    ];

    public function utilidad(){
        return $this->belongsTo(ContaUtilidadRpt::class, 'utilidad_id')->withDefault();
    }
}
