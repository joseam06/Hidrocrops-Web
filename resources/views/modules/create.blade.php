@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Crear nuevo módulo educativo</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <strong>Errores:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.modules.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">

        @csrf

        <div class="mb-4">
            <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
            <input type="text" name="titulo" id="titulo"
                   value="{{ old('titulo') }}"
                   class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500" required>
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4"
                      class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500">{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
            <input type="text" name="categoria" id="categoria"
                   value="{{ old('categoria') }}"
                   class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500">
        </div>
        
    {{-- PODCAST (MP3) --}}
<h3 class="text-lg font-semibold mt-6 mb-2 text-green-800">Podcast (audio)</h3>
<div class="mb-4">
    <label class="block text-sm text-gray-700">Título del podcast</label>
    <input type="text" name="podcast_titulo" class="w-full border rounded px-3 py-2 mt-1" placeholder="Ej. Introducción auditiva">
</div>
<div class="mb-4">
    <label class="block text-sm text-gray-700">Descripción del podcast</label>
    <textarea name="podcast_descripcion" rows="2" class="w-full border rounded px-3 py-2 mt-1" placeholder="Descripción opcional"></textarea>
</div>
<div class="mb-6">
    <label class="block text-sm text-gray-700">Archivo de audio (.mp3)</label>
    <input type="file" name="podcast_archivo" accept=".mp3" class="mt-1">
</div>

{{-- VIDEO (MP4) --}}
<h3 class="text-lg font-semibold mt-6 mb-2 text-green-800">Video educativo</h3>
<div class="mb-4">
    <label class="block text-sm text-gray-700">Título del video</label>
    <input type="text" name="video_titulo" class="w-full border rounded px-3 py-2 mt-1">
</div>
<div class="mb-4">
    <label class="block text-sm text-gray-700">Descripción del video</label>
    <textarea name="video_descripcion" rows="2" class="w-full border rounded px-3 py-2 mt-1"></textarea>
</div>
<div class="mb-6">
    <label class="block text-sm text-gray-700">Archivo de video (.mp4, .webm)</label>
    <input type="file" name="video_archivo" accept=".mp4,.webm" class="mt-1">
</div>

{{-- PDF --}}
<h3 class="text-lg font-semibold mt-6 mb-2 text-green-800">Recurso PDF</h3>
<div class="mb-4">
    <label class="block text-sm text-gray-700">Título del recurso</label>
    <input type="text" name="pdf_titulo" class="w-full border rounded px-3 py-2 mt-1">
</div>
<div class="mb-4">
    <label class="block text-sm text-gray-700">Descripción</label>
    <textarea name="pdf_descripcion" rows="2" class="w-full border rounded px-3 py-2 mt-1"></textarea>
</div>
<div class="mb-6">
    <label class="block text-sm text-gray-700">Archivo PDF</label>
    <input type="file" name="pdf_archivo" accept=".pdf" class="mt-1">
</div>

{{-- Imagen / GIF --}}
<h3 class="text-lg font-semibold mt-6 mb-2 text-green-800">Objeto virtual (imagen o animación)</h3>
<div class="mb-4">
    <label class="block text-sm text-gray-700">Título del objeto</label>
    <input type="text" name="imagen_titulo" class="w-full border rounded px-3 py-2 mt-1">
</div>
<div class="mb-4">
    <label class="block text-sm text-gray-700">Descripción</label>
    <textarea name="imagen_descripcion" rows="2" class="w-full border rounded px-3 py-2 mt-1"></textarea>
</div>
<div class="mb-6">
    <label class="block text-sm text-gray-700">Archivo (.jpg, .png, .gif)</label>
    <input type="file" name="imagen_archivo" accept=".jpg,.jpeg,.png,.gif" class="mt-1">
</div>
    
    <div class="text-right">
            <button type="submit"
                    class="bg-green-700 text-white font-semibold px-6 py-2 rounded hover:bg-green-800">
                Guardar módulo
            </button>
        </div>

    </form>
</div>
@endsection
