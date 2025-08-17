<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvisionMensual extends Model
{
	use HasFactory;

	protected $table = 'provisiones_mensuales';

	protected $fillable = [
		'empresa_id',
		'empleado_id',
		'tipo_provision',
		'monto',
		'mes',
	];

	public function empresa()
	{
		return $this->belongsTo(\App\Models\RRHH\RRHHEmpresa::class, 'empresa_id');
	}

	public function empleado()
	{
		return $this->belongsTo(\App\Models\RRHH\RRHHEmpleado::class, 'empleado_id');
	}
}
