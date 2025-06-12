@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Módulos disponibles</h1>
   
    @auth
    @if(Auth::user()->role_usuario === 'admin')
        <a href="{{ route('admin.modules.create') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
            Crear módulo
        </a>
    @endif
@endauth

    <div class="space-y-4 mb-6">
        <div class="border-b pb-4">
            <h3 class="font-bold text-lg">Introducción a la hidroponía</h3>
            <p class="text-gray-600">Conceptos básicos sobre hidroponía</p>
        </div>
        <div class="border-b pb-4">
            <h3 class="font-bold text-lg">Distribución y solución nutritiva</h3>
            <p class="text-gray-600">Elementos esenciales para las plantas</p>
        </div>
        <div class="border-b pb-4">
            <h3 class="font-bold text-lg">Motivo y mantenimiento</h3>
            <p class="text-gray-600">Estratégias para mantener el sistema</p>
        </div>
    </div>

    <div class="mt-8">
        <h3 class="font-bold text-xl">Diseño de sistemas hidropónicos</h3>
        <p class="text-gray-600">Evaluación y planificación de sistemas</p>
    </div>
</div>
@endsection