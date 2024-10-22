<?php

namespace App\Models\Contabilidad;

use App\Models\RRHH\RRHHEmpresa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaPartidaDetalleContableTemp extends Model
{
    use HasFactory;

   // Tabla asociada al modelo
   protected $table = 'conta_detalle_partida_contable_temporal';

   // Campos que pueden ser asignados de forma masiva
   protected $fillable = [
       'partida_id',
       'periodo_id',
       'tipo_partida_id',
       'empresa_id',
       'creador_id',
       'actualizador_id',
       'cuenta_contable_id',
       'codigo_cuenta',
       'debe',
       'haber',
       'fecha_contable',
       'concepto'
   ];



    
}
