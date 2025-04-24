<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'score'];

    // Relación con el modelo User, usando el campo 'user_name' para vincularlo
    public function user()
    {
        return $this->belongsTo(User::class, 'user_name', 'nombre');
    }
}
