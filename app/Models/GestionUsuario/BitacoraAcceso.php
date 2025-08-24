<?php
namespace App\Models\GestionUsuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraAcceso extends Model
{
    use HasFactory;
   protected $table = 'tbl_bitacora_accesos';
   protected $fillable = ['usuario_id', 'ip', 'modulo' , 'accion','fecha_acceso'];

    public function usuario()
    {
        // Especificamos la clave foránea local ('usuario_id') y la clave primaria
        // del modelo relacionado ('id_usuario' en la tabla 'tbl_usuario')
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

}
