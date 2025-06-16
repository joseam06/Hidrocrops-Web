<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria',
    ];

    // Relación con los recursos (archivos multimedia)
    public function recursos()
    {
        return $this->hasMany(Recurso::class);
    }

    public function evaluacion()
    {
        return $this->hasOne(Evaluacion::class);
    }
    public function evaluaciones()
{
    return $this->hasMany(Evaluacion::class);
}


}
