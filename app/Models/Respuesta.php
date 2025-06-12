<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_id',
        'user_id',
        'contenido',
        'parent_id', // ➕ nueva columna para respuesta a respuesta
    ];
    

    // Una respuesta pertenece a un tema del foro
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    // Una respuesta pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Subrespuestas (respuestas hijas)
    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'parent_id');
    }

    // Respuesta padre (si esta es una subrespuesta)
    public function parent()
    {
        return $this->belongsTo(Respuesta::class, 'parent_id');
    }

}
