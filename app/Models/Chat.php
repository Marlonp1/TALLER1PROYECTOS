<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats'; // Tabla en la base de datos
    protected $primaryKey = 'id_chat'; // Llave primaria

    // Campos asignables masivamente
    protected $fillable = ['usuario_id', 'curso_id', 'tipo_pregunta', 'estado_chat', 'fecha_inicio', 'fecha_cierre'];


    // Relación con la tabla Usuarios (un chat pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    // Relación con la tabla Interacciones (un chat tiene varias interacciones)
    public function interacciones()
    {
        return $this->hasMany(Interaccion::class, 'id_chat', 'id_chat');
    }

    // Relación con la tabla RespuestasAutomatizadas (un chat puede tener varias respuestas automatizadas)
    public function respuestasAutomatizadas()
    {
        return $this->hasMany(RespuestasAutomatizadas::class, 'id_chat', 'id_chat');
    }
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

}
