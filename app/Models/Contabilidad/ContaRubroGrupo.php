<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaRubroGrupo extends Model
{
    use HasFactory;

    protected $table = 'conta_rubro_grupo_rpt';

    protected $fillable = [
        'grupo',
        'rubro_id',
        'signo',
        'saldo',
        'empresa_id'
    ];

    public function rubro()
    {
        return $this->belongsTo(ContaRubroGeneral::class, 'rubro_id');
    }
}
