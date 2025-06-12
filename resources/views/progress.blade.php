@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Progreso de tus módulos</h1>

    <div class="space-y-4">
        @foreach($progresos as $progreso)
            <div class="border p-4 rounded shadow">
                <h2 class="font-semibold">{{ $progreso->module->titulo }}</h2>
                <div class="mt-2">
                    @if($progreso->completado)
                        <div class="bg-green-500 text-white text-sm px-2 py-1 rounded w-fit">
                            Completado ✅
                        </div>
                    @else
                        <div class="bg-gray-300 text-gray-700 text-sm px-2 py-1 rounded w-fit">
                            No completado ⏳
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
