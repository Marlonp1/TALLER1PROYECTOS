<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios'; // Tabla en la base de datos
    protected $primaryKey = 'id_usuario'; // Llave primaria

    // Campos asignables masivamente
    protected $fillable = ['nombre', 'correo', 'contraseña', 'id_rol', 'estado'];
    
    // Método para definir la columna de identificación para la autenticación
    public function getAuthIdentifierName()
    {
        return 'correo'; // Cambia esto a 'correo'
    }

    // Relación con la tabla Roles (un usuario tiene un rol)
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    // Relación con la tabla Chats (un usuario puede iniciar varios chats)
    public function chats()
    {
        return $this->hasMany(Chat::class, 'id_usuario', 'id_usuario');
    }

    // Relación con la tabla Cursos (un usuario puede ser profesor de varios cursos)
    public function cursos()
    {
        return $this->hasMany(Curso::class, 'id_profesor', 'id_usuario');
    }
    public function getFullNameAttribute()
    {
        return $this->nombre; // Suponiendo que solo necesitas el nombre, si tienes más campos como apellido, agrégalo aquí
    }

}
