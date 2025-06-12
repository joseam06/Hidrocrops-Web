@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Módulos Disponibles</h1>

    {{-- Botón solo para admin --}}
    @auth
        @if(Auth::user()->role_usuario === 'admin')
            <div class="text-right mb-6">
                <a href="{{ route('admin.modules.create') }}"
                   class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                    + Crear módulo
                </a>
            </div>
        @endif
    @endauth

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Tarjeta 1: Introducción --}}
        <a href="{{ route('modules.show', 1) }}" class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="text-center">
                <svg class="w-12 h-12 mx-auto text-green-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Introducción a la hidroponía</h3>
                <p class="text-gray-600">Conceptos básicos sobre hidroponía</p>
            </div>
        </a>

        {{-- Tarjeta 2: Nutrición --}}
        <a href="{{ route('modules.show', 2) }}" class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="text-center">
                <svg class="w-12 h-12 mx-auto text-green-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Nutrición de plantas</h3>
                <p class="text-gray-600">Solución nutritiva y distribución</p>
            </div>
        </a>

        {{-- Tarjeta 3: Mantenimiento --}}
        <a href="{{ route('modules.show', 3) }}" class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="text-center">
                <svg class="w-12 h-12 mx-auto text-green-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 
                        3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 
                        3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 
                        2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 
                        0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 
                        1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 
                        1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 
                        2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Mantenimiento</h3>
                <p class="text-gray-600">Estrategias para mantener el sistema</p>
            </div>
        </a>
    </div>

   {{-- Módulos dinámicos creados por el admin --}}
@if($modules->count())
    <h2 class="text-2xl font-semibold mt-10 mb-4">Otros módulos</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($modules as $module)
            @if (!in_array($module->id, [1, 2, 3]))
                <div class="border border-gray-200 rounded-lg p-5 shadow hover:shadow-md transition">
                    <h3 class="text-lg font-bold text-green-700">{{ $module->titulo }}</h3>
                    <p class="text-gray-600 mt-2">{{ $module->descripcion }}</p>
                    <p class="text-sm text-gray-500 mt-1">Categoría: {{ $module->categoria }}</p>
                    <a href="{{ route('modules.show', $module->id) }}"
                       class="inline-block mt-4 text-green-700 font-semibold hover:underline">
                        Ver contenido
                    </a>

                    {{-- CRUD: solo admin --}}
                    @auth
                        @if(Auth::user()->role_usuario === 'admin')
                            <div class="mt-3 flex space-x-2">
                                <a href="{{ route('admin.modules.edit', $module->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    Editar
                                </a>

                                <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST"
                                      onsubmit="return confirm('¿Deseas eliminar este módulo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                       Eliminar
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection