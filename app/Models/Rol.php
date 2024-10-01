<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Tabla en la base de datos
    protected $primaryKey = 'id_rol'; // Llave primaria

    // Campos asignables masivamente
    protected $fillable = ['nombre_rol'];

    // Relación con la tabla Usuarios (un rol tiene varios usuarios)
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol', 'id_rol');
    }
}
