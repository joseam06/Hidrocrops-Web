@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-3xl font-bold text-green-800 mb-2">{{ $forum->titulo }}</h1>

    <p class="text-gray-600 mb-4">
        Publicado por <strong>{{ $forum->user->name }}</strong>
        el {{ $forum->created_at->format('d/m/Y') }}
    </p>

    <div class="bg-white p-5 rounded shadow mb-6">
        <p class="text-gray-800 leading-relaxed">{{ $forum->contenido }}</p>
    </div>

    {{-- Sección de respuestas --}}
    <h2 class="text-2xl font-semibold text-green-700 mb-4">
        Respuestas ({{ $forum->respuestas->count() }})
    </h2>

    @if($forum->respuestas->count())
        @foreach ($forum->respuestas->where('parent_id', null) as $respuesta)
            @include('forum.partials.respuesta', ['respuesta' => $respuesta, 'nivel' => 0])
        @endforeach
    @else
        <p class="text-gray-500 mb-6">Aún no hay respuestas. ¡Sé el primero en participar!</p>
    @endif

    {{-- Formulario para responder al tema --}}
    <div class="bg-white p-6 rounded shadow mt-8">
        <h3 class="text-xl font-semibold mb-3">Responder al tema</h3>

        <form action="{{ route('respuestas.store', $forum->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <textarea name="contenido" rows="4"
                          placeholder="Escribe tu respuesta aquí..."
                          class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:border-green-500"
                          required>{{ old('contenido') }}</textarea>
            </div>

            <div class="text-right">
                <button type="submit"
                        class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
                    Enviar respuesta
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function mostrarFormulario(id) {
        const form = document.getElementById('form-' + id);
        form.classList.toggle('hidden');
    }
</script>
@endpush
@endsection
