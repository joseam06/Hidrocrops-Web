<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ModuleController,
    EvaluationController,
    ForumController,
    ProgressController,
    ExploreController,
    ProfileController,
    RecursoController,
    RespuestaController,
    EvaluacionUsuarioController
};



// Ruta pública de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas de autenticación (Jetstream/Breeze)
require __DIR__.'/auth.php';

// Rutas protegidas (usuarios autenticados)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Perfil
        Route::prefix('perfil')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/editar', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    });

   // Sección Módulos (todos los usuarios pueden ver)
    Route::prefix('modulos')->group(function () {
    Route::get('/', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('/{module}', [ModuleController::class, 'show'])->name('modules.show');
   
    Route::get('/{module}/evaluacion', [ModuleController::class, 'evaluacion'])
    ->name('modules.evaluacion');
Route::post('/evaluaciones/completar', [EvaluacionUsuarioController::class, 'store'])->name('evaluaciones.completar');

});
  // Redirecciones amigables para los módulos especiales
    Route::redirect('/modulos/introduccion', '/modulos/1')->name('modules.introduction.redirect');
    Route::redirect('/modulos/nutricion', '/modulos/2')->name('modules.nutrition.redirect');
    Route::redirect('/modulos/mantenimiento', '/modulos/3')->name('modules.maintenance.redirect');

// Recursos de módulos especiales (crear y editar solamente)
    Route::prefix('recursos')->group(function () {
    Route::get('/crear/{module}', [RecursoController::class, 'create'])->name('recursos.create');
    Route::post('/{module}', [RecursoController::class, 'store'])->name('recursos.store');
    Route::post('/{module}', [RecursoController::class, 'store'])->name('recursos.store');
    Route::get('/{recurso}/editar', [RecursoController::class, 'edit'])->name('recursos.edit');
    Route::put('/{recurso}', [RecursoController::class, 'update'])->name('recursos.update');
});

    // CRUD de Módulos (solo visible para el admin, controlado desde el controlador)
    
        Route::prefix('admin/modulos')->group(function () {
        Route::get('/crear', [ModuleController::class, 'create'])->name('admin.modules.create');
        Route::post('/', [ModuleController::class, 'store'])->name('admin.modules.store');
        Route::get('/{module}/editar', [ModuleController::class, 'edit'])->name('admin.modules.edit');
        Route::put('/{module}', [ModuleController::class, 'update'])->name('admin.modules.update');
        Route::delete('/{module}', [ModuleController::class, 'destroy'])->name('admin.modules.destroy');
    });

    // Rutas CRUD para Recursos de los Módulos (solo para admin)
        Route::prefix('admin/recursos')->group(function () {
        Route::get('/{recurso}/editar', [RecursoController::class, 'edit'])->name('recursos.edit');      // Editar recurso
        Route::put('/{recurso}', [RecursoController::class, 'update'])->name('recursos.update');          // Actualizar recurso
        Route::delete('/{recurso}', [RecursoController::class, 'destroy'])->name('recursos.destroy');     // Eliminar recurso
    });

    // CRUD de foro (solo visible para el admin, controlado desde el controlador)
    Route::prefix('foro')->group(function () {
        Route::get('/', [ForumController::class, 'index'])->name('forum.index');                 // Ver temas
        Route::get('/crear', [ForumController::class, 'create'])->name('forum.create');          // Crear tema (admin)
        Route::post('/', [ForumController::class, 'store'])->name('forum.store');                // Guardar tema
        Route::get('/{forum}', [ForumController::class, 'show'])->name('forum.show');            // Ver detalle
        Route::get('/{forum}/editar', [ForumController::class, 'edit'])->name('forum.edit');      // Editar tema
        Route::put('/{forum}', [ForumController::class, 'update'])->name('forum.update');         // Actualizar tema
        Route::delete('/{forum}', [ForumController::class, 'destroy'])->name('forum.destroy');   // Eliminar tema (admin)
    
        // Respuestas al foro (todos los usuarios pueden responder)
        Route::post('/{forum}/responder', [RespuestaController::class, 'store'])->name('respuestas.store');
    });

    // Evaluaciones, progreso, explorar
    Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('/progress', [ProgressController::class, 'index'])
    ->name('progress.index');

    Route::get('/explorar', [ExploreController::class, 'index'])->name('explore');
});
