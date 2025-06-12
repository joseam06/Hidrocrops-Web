@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Editar recurso: {{ $recurso->titulo }}</h1>

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

    <form action="{{ route('recursos.update', $recurso->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="titulo" class="block text-sm font-medium text-gray-700">Título del recurso</label>
            <input type="text" name="titulo" id="titulo"
                   value="{{ old('titulo', $recurso->titulo) }}"
                   class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500" required>
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4"
                      class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500">{{ old('descripcion', $recurso->descripcion) }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Archivo actual</label>
       <button type="button" 
        onclick="window.open('{{ asset($recurso->archivo) }}', '_blank', 'width=900,height=600')" 
        class="text-blue-700 hover:underline">
    Ver archivo actual
</button>

</button>
 
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Subir un nuevo archivo (opcional)</label>
            <input type="file" name="archivo" accept=".pdf,.mp3,.mp4,.jpg,.jpeg,.png,.gif" class="mt-1">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
                Guardar cambios
            </button>
        </div>
    </form>
</div>


@endsection
