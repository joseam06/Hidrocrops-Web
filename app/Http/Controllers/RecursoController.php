<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class RecursoController extends Controller
{
    public function create($moduleId)
{
    return view('recursos.create', compact('moduleId'));
}
public function store(Request $request, $moduleId)
{
    $request->validate([
        'titulo' => 'required|string|max:300',
        'descripcion' => 'nullable|string',
        'tipo' => 'required|in:pdf,video,podcast,imagen',
        'archivo' => 'required|file|mimes:pdf,mp3,mp4,webm,jpg,jpeg,png,gif|max:204800',
    ]);

    // Generar nombre único y mover archivo
    $archivo = $request->file('archivo');
    $nombre = Str::random(10) . '_' . $archivo->getClientOriginalName();
    $archivo->move(public_path('recursos'), $nombre);

    // Crear recurso
    \App\Models\Recurso::create([
        'module_id' => $moduleId,
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'tipo' => $request->tipo,
        'archivo' => 'recursos/' . $nombre, // ruta para asset()
    ]);

    return redirect()->route('modules.show', $moduleId)->with('success', 'Recurso agregado correctamente.');
}

    // Mostrar formulario de edición
    public function edit(Recurso $recurso)
    {
        return view('recursos.edit', compact('recurso'));
    }

    // Actualizar recurso
    public function update(Request $request, Recurso $recurso)
    {
        // Validación
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|mimes:pdf,mp3,mp4,jpg,jpeg,png,gif|max:204800',
        ]);

        // Subir nuevo archivo si se proporciona
        if ($request->hasFile('archivo')) {
            // Eliminar el archivo anterior
            Storage::delete($recurso->archivo);

            // Subir el nuevo archivo
            $path = $request->file('archivo')->store('public/recursos');
            $recurso->archivo = $path; // Actualizar la ruta del archivo
        }

        // Actualizar los demás campos
        $recurso->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('modules.show', $recurso->module_id)->with('success', 'Recurso actualizado.');
    }

    // Eliminar recurso
    public function destroy(Recurso $recurso)
    {
        // Eliminar archivo de almacenamiento
        Storage::delete($recurso->archivo);

        // Eliminar el recurso de la base de datos
        $recurso->delete();

        return redirect()->route('modules.show', $recurso->module_id)->with('success', 'Recurso eliminado.');
    }
}
