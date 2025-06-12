@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-green-800 mb-6">Discusión General</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Botón solo para admin --}}
    @auth
        @if(Auth::user()->role_usuario === 'admin')
            <div class="mb-6 text-right">
                <a href="{{ route('forum.create') }}"
                   class="bg-green-700 text-white px-5 py-2 rounded-lg shadow hover:bg-green-800">
                    + Crear tema
                </a>
            </div>
        @endif
    @endauth

    {{-- Lista de temas --}}
    @if($temas->count())
        <div class="space-y-4">
            @foreach($temas as $tema)
                <div class="bg-white rounded shadow p-4">
                    <h2 class="text-xl font-semibold text-green-700">{{ $tema->titulo }}</h2>
                    <p class="text-gray-700 mt-1">{{ Str::limit($tema->contenido, 100) }}</p>

                    <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                        <span>Publicado por: <strong>{{ $tema->user->name }}</strong></span>
                        <span>{{ $tema->respuestas_count }} respuesta{{ $tema->respuestas_count !== 1 ? 's' : '' }}</span>
                        <a href="{{ route('forum.show', $tema->id) }}" class="text-green-700 font-semibold hover:underline">
                            Ver discusión →
                            
                            @auth
    @if(Auth::user()->role_usuario === 'admin')
        <div class="mt-2 flex space-x-2">
            <a href="{{ route('forum.edit', $tema->id) }}"
               class="text-sm bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                Editar
            </a>

            <form action="{{ route('forum.destroy', $tema->id) }}" method="POST"
                  onsubmit="return confirm('¿Deseas eliminar este tema?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="text-sm bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                    Eliminar
                </button>
            </form>
        </div>
    @endif
@endauth

                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No hay temas en el foro todavía. ¡Sé el primero en participar!</p>
    @endif
</div>
@endsection
