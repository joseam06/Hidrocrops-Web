<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionUsuario;
use App\Models\Evaluacion;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluacionUsuarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'evaluacion_id' => 'required|exists:evaluacions,id',
        ]);

        $usuarioId = Auth::id();  // ← ¡Asegúrate de definirlo antes de usarlo!

        // Obtener el módulo asociado a la evaluación
        $moduloId = Evaluacion::find($request->evaluacion_id)->module_id;

        // Verificar o crear progreso para este módulo y usuario
        $progreso = Progress::firstOrCreate([
            'user_id' => $usuarioId,
            'module_id' => $moduloId,
        ]);

        // Marcar como completado si no lo estaba
        $progreso->update(['completado' => true]);

        // Verificar si ya existe registro en EvaluacionUsuario
        $yaExiste = EvaluacionUsuario::where('evaluacion_id', $request->evaluacion_id)
            ->where('user_id', $usuarioId)
            ->exists();

        if (!$yaExiste) {
            EvaluacionUsuario::create([
                'evaluacion_id' => $request->evaluacion_id,
                'user_id' => $usuarioId,
                'completado' => true,
            ]);
        }

        return redirect()->route('evaluations.index')->with('success', '¡Evaluación registrada correctamente!');
    }
}
