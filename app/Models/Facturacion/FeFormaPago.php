<?php

namespace App\Models\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeFormaPago extends Model
{
    use HasFactory;

    protected $table = 'fe_forma_pago';

    protected $fillable = [
        'codigo',
        'valor',
        'activo',
        'empresa_id',
    ];
}
