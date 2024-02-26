<?php

namespace App\Models;

use App\Models\RRHH\RRHHIngreso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHTipoIngreso extends Model
{
    use HasFactory;

    protected $table = 'rrhh_tipo_ingreso';

    protected $fillable = [
        'id',
        'tipo'
    ];

/**
     * Get all of the comments for the RRHHTipoIngreso
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(RRHHIngreso::class, 'id_tipo_ingreso', 'id');
    }
}
