<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;

    // Tabla en la base de datos
    protected $table = 'resultados';

    // Llave primaria de la tabla
    protected $primaryKey = 'id_resultado';

    // Campos asignables masivamente
    protected $fillable = [
        'id_usuario', 
        'dificultad', 
        'puntaje',
        'duracion' // Incluye el campo duracion
    ];

    // Relación con la tabla usuarios (un resultado pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }
}
