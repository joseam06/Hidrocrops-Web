@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Crear nuevo tema</h1>

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

    <form action="{{ route('forum.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="titulo" class="block text-sm font-medium text-gray-700">Título del tema</label>
            <input type="text" name="titulo" id="titulo"
                   value="{{ old('titulo') }}"
                   class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500" required>
        </div>

        <div class="mb-4">
            <label for="contenido" class="block text-sm font-medium text-gray-700">Contenido</label>
            <textarea name="contenido" id="contenido" rows="5"
                      class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500" required>{{ old('contenido') }}</textarea>
        </div>

        <div class="text-right">
            <a href="{{ route('forum.index') }}" class="text-gray-600 hover:underline mr-4">Cancelar</a>
            <button type="submit"
                    class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
                Publicar tema
            </button>
        </div>
    </form>
</div>
@endsection
