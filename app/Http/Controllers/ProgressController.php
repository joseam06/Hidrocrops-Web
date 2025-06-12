<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
{
    $usuarioId = Auth::id();


    $progresos = \App\Models\Progress::with('module')
        ->where('user_id', $usuarioId)
        ->get();

    return view('progress', compact('progresos'));
}

}