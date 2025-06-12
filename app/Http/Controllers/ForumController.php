<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    // Mostrar todos los temas del foro
    public function index()
    {
        $temas = Forum::withCount('respuestas')->latest()->get();
        return view('forum.index', compact('temas'));
    }

    // Mostrar formulario para crear un tema (solo admin)
    public function create()
    {
        if (!Auth::check() || Auth::user()->role_usuario !== 'admin') {
            abort(403);
        }

        return view('forum.create');
    }
    public function edit(Forum $forum)
{
    if (Auth::user()->role_usuario !== 'admin') {
        abort(403);
    }

    return view('forum.edit', compact('forum'));
}

    public function update(Request $request, Forum $forum)
{
    if (Auth::user()->role_usuario !== 'admin') {
        abort(403);
    }

    $request->validate([
        'titulo' => 'required|max:255',
        'contenido' => 'required',
    ]);

    $forum->update([
        'titulo' => $request->titulo,
        'contenido' => $request->contenido,
    ]);

    return redirect()->route('forum.index')->with('success', 'Tema actualizado correctamente.');
}


    // Guardar tema en base de datos
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
        ]);

        Forum::create([
            'user_id' => Auth::id(),
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
        ]);

        return redirect()->route('forum.index')->with('success', 'Tema creado correctamente.');
    }

    // Ver un tema y sus respuestas
    public function show(Forum $forum)
    {
        $forum->load(['user', 'respuestas.user']);
        return view('forum.show', compact('forum'));
    }

    // Eliminar tema (solo admin)
    public function destroy(Forum $forum)
{
    if (Auth::user()->role_usuario !== 'admin') {
        abort(403);
    }

    $forum->delete();
    return redirect()->route('forum.index')->with('success', 'Tema eliminado.');
}

}
