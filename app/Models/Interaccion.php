<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    use HasFactory;

    protected $table = 'interacciones'; // Tabla en la base de datos
    protected $primaryKey = 'id_interaccion'; // Llave primaria

    // Campos asignables masivamente
    protected $fillable = ['id_chat', 'mensaje', 'fecha_envio', 'remitente'];

    // Relación con la tabla Chats (una interacción pertenece a un chat)
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id_chat', 'id_chat');
    }
}
