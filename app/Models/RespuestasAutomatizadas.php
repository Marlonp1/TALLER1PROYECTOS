<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestasAutomatizadas extends Model
{
    use HasFactory;

    protected $table = 'respuestas_automatizadas'; // Tabla en la base de datos
    protected $primaryKey = 'id_respuesta'; // Llave primaria

    // Campos asignables masivamente
    protected $fillable = ['id_chat', 'respuesta', 'fecha_respuesta'];

    // Relación con la tabla Chats (una respuesta automatizada pertenece a un chat)
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id_chat', 'id_chat');
    }
}
