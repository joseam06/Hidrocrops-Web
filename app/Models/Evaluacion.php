<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Evaluacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'titulo',
        'preguntas',
    ];
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
