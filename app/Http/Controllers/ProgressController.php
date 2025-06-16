<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evaluacion;
use App\Models\EvaluacionUsuario;
use App\Models\Progress;

class ProgressController extends Controller
{
   public function index()
{
    $userId = Auth::id();

    $total = Evaluacion::count();
    $completadas = EvaluacionUsuario::where('user_id', $userId)->count();
    $porcentaje = $total > 0 ? ($completadas / $total) * 100 : 0;

    $modulos = \App\Models\Module::with('evaluaciones')->get();

    $progresos = $modulos->map(function ($modulo) use ($userId) {
        $evalIds = $modulo->evaluaciones->pluck('id');
        $completadas = EvaluacionUsuario::whereIn('evaluacion_id', $evalIds)
                        ->where('user_id', $userId)
                        ->count();
        $totalEval = $evalIds->count();
        $porcentajeModulo = $totalEval > 0 ? ($completadas / $totalEval) * 100 : 0;

        return [
            'titulo' => $modulo->titulo,
            'porcentaje' => $porcentajeModulo,
        ];
    });

return view('progress', compact('completadas', 'total', 'porcentaje', 'modulos', 'progresos'));

}

}
