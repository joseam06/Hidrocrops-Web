<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionUsuario extends Model
{
    protected $table = 'evaluacion_usuario';

    protected $fillable = [
        'user_id',
        'evaluacion_id',
        'completado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class, 'evaluacion_id');
    }
}
