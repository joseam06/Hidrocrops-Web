<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'titulo',
        'descripcion',
        'tipo',
        'archivo',
    ];

    public function modulo()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
