@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Foro</h1>
    
    <div>

        <div class="border-b pb-4">
        <h2 class="text-xl font-bold mb-4"> Temas de Discusión</h2>
        <p class="text-gray-600">15 respuestas</p>
        </div>
      
            <div class="border-b pb-4">
                <h3 class="font-semibold text-lg">Problema con la bomba de agua</h3>
                <p class="text-gray-600">5 respuestas</p>
            </div>
            <div class="border-b pb-4">
                <h3 class="font-semibold text-lg">Consejos sobre iluminación</h3>
                <p class="text-gray-600">2 respuestas</p>
            </div>
        </div>
    </div>
</div>
@endsection