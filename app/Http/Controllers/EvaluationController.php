<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacion;
use App\Models\EvaluacionUsuario;
use Illuminate\Support\Facades\Auth;


class EvaluationController extends Controller
{
public function index()
{
    $usuarioId = Auth::id();

    $evaluaciones = Evaluacion::with('module')->get();

    $completadas = EvaluacionUsuario::where('user_id', $usuarioId)
                        ->pluck('evaluacion_id')
                        ->toArray();

    return view('evaluations', compact('evaluaciones', 'completadas'));
}


}