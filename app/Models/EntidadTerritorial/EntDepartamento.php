<?php

namespace App\Models\EntidadTerritorial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntDepartamento extends Model
{
    use HasFactory;
    protected $table = 'ent_departamento';
    protected $fillable = [
        'departamento',
        'pais_id',
    ];
    
    public function pais(){
        return $this->belongsTo(EntPais::class, 'pais_id')->withDefault();
    }
}
