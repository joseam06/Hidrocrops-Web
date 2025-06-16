@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Evaluaciones</h1>

    @forelse($evaluaciones as $eval)
        <div class="border-b pb-4 mb-4">
            <div class="flex items-center">
                <input type="checkbox" class="mr-2" disabled {{ in_array($eval->id, $completadas) ? 'checked' : '' }}>
                <a href="{{ route('modules.evaluacion', $eval->module->id) }}" class="text-green-700 font-bold hover:underline">
                    {{ $eval->titulo }}
                </a>

            </div>
            <p class="text-gray-600 ml-6">
                Módulo: <span class="font-medium">{{ $eval->module->titulo ?? 'Sin módulo' }}</span>
            </p>
            <p class="text-sm ml-6 mt-1 text-gray-500">
                {{ in_array($eval->id, $completadas) ? 'Completada' : 'No completada' }}
            </p>
        </div>
    @empty
        <p class="text-gray-500">Aún no hay evaluaciones disponibles.</p>
    @endforelse
</div>
@endsection
