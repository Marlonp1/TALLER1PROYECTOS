<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaFrecuente extends Model
{
    use HasFactory;

    protected $table = 'preguntas_frecuentes'; // Tabla en la base de datos
    protected $primaryKey = 'id_pregunta'; // Llave primaria

    // Campos asignables masivamente
    protected $fillable = ['pregunta', 'respuesta'];
}
