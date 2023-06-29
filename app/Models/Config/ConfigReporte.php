<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Config\ConfigReporteCampo;

class ConfigReporte extends Model
{
    use HasFactory;
    protected $table = 'config_reporte';
    protected $fillable = [
        'id','reporte','icono','modulo'
    ];

    public function campos()
    {
        return $this->hasMany(ConfigReporteCampo::class, 'reporte_id');
    }
}
