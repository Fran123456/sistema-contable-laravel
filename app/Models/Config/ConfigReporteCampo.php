<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigReporteCampo extends Model
{
    use HasFactory;
    protected $table = 'config_reporte_campo';
    protected $fillable = [
        'id','tipo','requerido','valor','reporte_id','modulo','label','name'
    ];
}
