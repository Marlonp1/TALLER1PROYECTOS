<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionUsuario extends Model
{
    use HasFactory;

    protected $table = 'evaluacion_usuarios';
    protected $primaryKey = 'id_evaluacion_usuario';

    protected $fillable = [
        'id_usuario',
        'id_chat',
        'seleccionado',
        'marcado_en',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id_chat', 'id_chat');
    }
}
