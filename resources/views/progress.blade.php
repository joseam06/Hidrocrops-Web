@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Progreso de tus módulos</h1>

    {{-- Barra de progreso general --}}
<div class="mb-6">
    <h2 class="text-lg font-semibold">Progreso general</h2>
    <div class="w-full bg-gray-300 rounded-full h-6 mt-2 relative">
        <div class="bg-green-500 h-6 rounded-full text-white text-sm text-center leading-6"
             style="width: {{ $porcentaje }}%;">
            {{ number_format($porcentaje, 0) }}%
        </div>
    </div>
</div>

{{-- Progreso por módulo --}}
<div class="space-y-4 mt-10">
    <h2 class="text-xl font-bold mb-4">Progreso por módulo</h2>

    @foreach($progresos as $progreso)
    <div class="mb-4">
        <h3 class="font-semibold flex items-center justify-between">
            {{ $progreso['titulo'] }}

            @if($progreso['porcentaje'] == 100)
                <span class="bg-green-600 text-white text-xs px-3 py-1 rounded-full animate-pulse ml-2">
                    ¡Completado! ✅
                </span>
            @endif
        </h3>

        <div class="w-full bg-gray-300 rounded h-4 mt-2">
            <div class="bg-green-500 h-4 rounded transition-all duration-700 ease-in-out"
                 style="width: {{ $progreso['porcentaje'] }}%;">
            </div>
        </div>

        <p class="text-sm mt-1">{{ round($progreso['porcentaje']) }}% completado</p>
    </div>
@endforeach

</div>


</div>
@endsection
