@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold text-green-800 mb-4">{{ $module->titulo }}</h1>

    @auth
        @if(Auth::user()->role_usuario === 'admin' && in_array($module->id, [1,2,3]))
            <div class="mb-6 flex space-x-4">
                <a href="{{ route('admin.modules.edit', $module->id) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    ✏️ Editar módulo
                </a>
                <a href="{{ route('recursos.create', $module->id) }}"
                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    📎 Agregar recurso
                </a>
            </div>
        @endif
    @endauth

    <p class="text-gray-700 mb-2"><strong>Categoría:</strong> {{ $module->categoria }}</p>
    <p class="text-gray-600 mb-6">{{ $module->descripcion }}</p>

    <hr class="my-6">

    {{-- Recursos del módulo --}}
    <h2 class="text-2xl font-semibold text-green-700 mb-4">Recursos del módulo</h2>

    @if($module->recursos && $module->recursos->count())
        <div class="space-y-6">
            @foreach($module->recursos as $recurso)
                <div class="p-4 bg-white rounded shadow">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $recurso->titulo }}</h3>
                    <p class="text-gray-600 mb-3">{{ $recurso->descripcion }}</p>

                    <span class="inline-block bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm mb-3">
                        {{ ucfirst($recurso->tipo) }}
                    </span>

                    @php $url = asset($recurso->archivo); @endphp

                    @switch($recurso->tipo)
                        @case('pdf')
                            <iframe src="{{ $url }}" width="100%" height="500px" class="rounded border"></iframe>
                            <a href="{{ $url }}" download class="mt-2 inline-block text-green-700 font-semibold hover:underline">Descargar PDF</a>
                            @break

                        @case('video')
                            <video controls class="w-full max-h-96"><source src="{{ $url }}"></video>
                            @break

                        @case('podcast')
                            <audio controls class="w-full"><source src="{{ $url }}"></audio>
                            @break

                        @case('imagen')
                            <img src="{{ $url }}" alt="{{ $recurso->titulo }}" class="rounded shadow max-h-96">
                            @break
                    @endswitch

                    @auth
                        @if(Auth::user()->role_usuario === 'admin')
                            <div class="mt-4 flex space-x-3">
                                <a href="{{ route('recursos.edit', $recurso->id) }}"
                                   class="bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600">
                                    Editar recurso
                                </a>
                                <form action="{{ route('recursos.destroy', $recurso->id) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este recurso?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">
                                        Eliminar recurso
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Este módulo aún no tiene recursos añadidos.</p>
    @endif
</div>
@if($module->evaluacion)
    <div class="mt-8 p-4 bg-green-100 rounded shadow">
        <h2 class="text-xl font-semibold text-green-800 mb-2">Evaluación disponible</h2>
        <p class="mb-4">{{ $module->evaluacion->titulo }}</p>
        <a href="#" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Realizar evaluación
        </a>
    </div>
@endif

@endsection
