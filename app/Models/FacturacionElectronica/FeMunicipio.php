<?php

namespace App\Models\FacturacionElectronica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeMunicipio extends Model
{
    use HasFactory;

     protected $table = 'fe_municipios';


     protected $fillable = [
         'codigo_m',
         'valor',
         'cod_departamento',
     ];

     public function departamento()
     {
         return $this->belongsTo(FeDepartamento::class, 'cod_departamento', 'codigo');
     }
}
