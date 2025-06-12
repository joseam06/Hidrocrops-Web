@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Evaluaciones</h1>
    
    <div class="space-y-4">
        <div class="border-b pb-4">
            <div class="flex items-center">
                <input type="checkbox" class="mr-2" disabled>
                <h3 class="font-bold">Introducción a la hidroponía</h3>
            </div>
            <p class="text-gray-600 ml-6">Completada</p>
        </div>
        <div class="border-b pb-4">
            <div class="flex items-center">
                <input type="checkbox" class="mr-2" disabled>
                <h3 class="font-bold">Soluciones nutritivas</h3>
            </div>
            <p class="text-gray-600 ml-6">No completada</p>
        </div>
        <div class="border-b pb-4">
            <div class="flex items-center">
                <input type="checkbox" class="mr-2" disabled>
                <h3 class="font-bold">Clima e iluminación</h3>
            </div>
            <p class="text-gray-600 ml-6">No completada</p>
        </div>
    </div>
</div>
@endsection