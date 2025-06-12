@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Editar módulo: {{ $module->titulo }}</h1>

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

    <form action="{{ route('admin.modules.update', $module->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
            <input type="text" name="titulo" id="titulo"
                   value="{{ old('titulo', $module->titulo) }}"
                   class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500" required>
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4"
                      class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500">{{ old('descripcion', $module->descripcion) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
            <input type="text" name="categoria" id="categoria"
                   value="{{ old('categoria', $module->categoria) }}"
                   class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('modules.index') }}"
               class="bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded hover:bg-gray-400">
                Cancelar
            </a>

            <button type="submit"
                    class="bg-green-700 text-white font-semibold px-6 py-2 rounded hover:bg-green-800">
                Actualizar módulo
            </button>
        </div>
    </form>
</div>
@endsection
