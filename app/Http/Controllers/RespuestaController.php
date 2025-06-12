<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RespuestaController extends Controller
{
    public function store(Request $request, Forum $forum)
{
    $request->validate([
        'contenido' => 'required|string|max:3000',
        'parent_id' => 'nullable|exists:respuestas,id',
    ]);

    Respuesta::create([
        'forum_id' => $forum->id,
        'user_id' => Auth::id(),
        'contenido' => $request->contenido,
        'parent_id' => $request->parent_id,
    ]);

    return redirect()->route('forum.show', $forum->id)->with('success', 'Tu respuesta ha sido publicada.');
}


}
