<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return view('modules.index', compact('modules'));
    }

    public function introduction()
    {
        return view('modules.introduction');  
    }
    
    public function nutrition()
    {
        return view('modules.nutrition');  
    }
    
    public function maintenance()
    {
        return view('modules.maintenance');  
    }
    

    public function show(Module $module)
{
    // Cargar el módulo con sus recursos relacionados
    $module->load('recursos'); // Esto asegura que los recursos se carguen
    $module->load('evaluacion'); // relación uno a uno
    return view('modules.show', compact('module')); // Pasamos el módulo y sus recursos a la vista
}

public function evaluacion(Module $module)
{
    $module->load('evaluacion');

    if (!$module->evaluacion) {
        abort(404, 'Este módulo no tiene evaluación.');
    }

    $preguntas = json_decode($module->evaluacion->preguntas, true);

    return view('modules.evaluacion', compact('module', 'preguntas'));
}

    public function create()
    {
        $this->authorizeAdmin(); 
        return view('modules.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'categoria' => 'nullable|string|max:100',
        'podcast_archivo' => 'nullable|mimes:mp3|max:102400',
        'video_archivo'   => 'nullable|mimes:mp4,webm|max:204800',
        'pdf_archivo'     => 'nullable|mimes:pdf|max:51200',
        'imagen_archivo'  => 'nullable|mimes:jpg,jpeg,png,gif|max:10240',
    ]);

    // Guardar el módulo primero
    $module = Module::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'categoria' => $request->categoria,
    ]);

    // Subida de PODCAST
    if ($request->hasFile('podcast_archivo')) {
        $file = $request->file('podcast_archivo');
        $nombre = Str::random(10) . '_' . $file->getClientOriginalName();
        $file->move(public_path('recursos'), $nombre);

        \App\Models\Recurso::create([
            'module_id' => $module->id,
            'titulo' => $request->podcast_titulo,
            'descripcion' => $request->podcast_descripcion,
            'tipo' => 'podcast',
            'archivo' => 'recursos/' . $nombre,
        ]);
    }

    // Subida de VIDEO
    if ($request->hasFile('video_archivo')) {
        $file = $request->file('video_archivo');
        $nombre = Str::random(10) . '_' . $file->getClientOriginalName();
        $file->move(public_path('recursos'), $nombre);

        \App\Models\Recurso::create([
            'module_id' => $module->id,
            'titulo' => $request->video_titulo,
            'descripcion' => $request->video_descripcion,
            'tipo' => 'video',
            'archivo' => 'recursos/' . $nombre,
        ]);
    }

    // SUBIDA DE PDF
    if ($request->hasFile('pdf_archivo')) {
        $archivo = $request->file('pdf_archivo');
        $nombre = Str::random(10) . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('recursos'), $nombre);

        \App\Models\Recurso::create([
            'module_id' => $module->id,
            'titulo' => $request->pdf_titulo,
            'descripcion' => $request->pdf_descripcion,
            'tipo' => 'pdf',
            'archivo' => 'recursos/' . $nombre,
        ]);
    }

    // Subida de IMAGEN
    if ($request->hasFile('imagen_archivo')) {
        $file = $request->file('imagen_archivo');
        $nombre = Str::random(10) . '_' . $file->getClientOriginalName();
        $file->move(public_path('recursos'), $nombre);

        \App\Models\Recurso::create([
            'module_id' => $module->id,
            'titulo' => $request->imagen_titulo,
            'descripcion' => $request->imagen_descripcion,
            'tipo' => 'imagen',
            'archivo' => 'recursos/' . $nombre,
        ]);
    }

    return redirect()->route('modules.index')->with('success', 'Módulo creado con sus recursos.');
}


    public function edit(Module $module)
    {
        $this->authorizeAdmin();
        return view('modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $this->authorizeAdmin();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'nullable|string|max:100',
        ]);

        $module->update($request->all());

        return redirect()->route('modules.index')->with('success', 'Módulo actualizado correctamente.');
    }

    public function destroy(Module $module)
    {
        $this->authorizeAdmin();
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Módulo eliminado.');
    }

    private function authorizeAdmin(): void
    {
        if (!Auth::check() || Auth::user()->role_usuario !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }
    }
}
