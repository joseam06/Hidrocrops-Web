@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-3xl py-10">
    <h1 class="text-2xl font-bold text-green-800 mb-6">{{ $module->evaluacion->titulo }}</h1>

    <form method="POST" action="#">
        @csrf

        @foreach ($preguntas as $index => $pregunta)
            <div class="mb-6">
                <p class="font-semibold text-gray-800 mb-2">{{ $index + 1 }}. {{ $pregunta['pregunta'] }}</p>

                @foreach ($pregunta['opciones'] as $opcion)
                    <label class="block mb-1">
                        <input type="radio" name="respuestas[{{ $index }}]" value="{{ $opcion }}" class="mr-2" required>
                        {{ $opcion }}
                    </label>
                @endforeach
            </div>
        @endforeach

        <div class="text-right">
            <button type="submit"
                class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800 transition">
                Enviar evaluación
            </button>
        </div>
    </form>
</div>
@endsection
