<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos'; // Tabla en la base de datos
    protected $primaryKey = 'id_curso'; // Llave primaria

    // Campos asignables masivamente
    protected $fillable = ['nombre_curso', 'id_profesor'];

    // Relación con la tabla Usuarios (un curso pertenece a un profesor)
    public function profesor()
    {
        return $this->belongsTo(User::class, 'id_profesor', 'id_usuario');
    }
}
