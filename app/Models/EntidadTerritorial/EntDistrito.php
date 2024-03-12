<?php

namespace App\Models\EntidadTerritorial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntDistrito extends Model
{
    use HasFactory;
    protected $table = 'ent_distrito';
    protected $fillable = [
        'id',
        'distrito',
        'departamento_id',
    ];
    
    public function departamento(){
        return $this->belongsTo(EntDepartamento::class, 'departamento_id')->withDefault();
    }
}
