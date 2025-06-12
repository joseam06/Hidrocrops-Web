<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'contenido',
    ];

    // Un foro pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un foro puede tener muchas respuestas
    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
