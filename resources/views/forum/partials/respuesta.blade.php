@php $margen = $nivel * 6; @endphp

@php
    $esAdmin = $respuesta->user->role_usuario === 'admin';
    $bg = $esAdmin ? 'bg-yellow-100 border-green-600' : 'bg-gray-100 border-green-400';
@endphp

<div class="ml-{{ $margen }} mb-4 p-3 {{ $bg }} border-l-4 rounded shadow-sm">

    <div class="text-sm text-gray-600 mb-1">
        <strong>{{ $respuesta->user->name }}</strong> respondió el {{ $respuesta->created_at->format('d/m/Y H:i') }}
    </div>
    <p class="text-gray-800">{{ $respuesta->contenido }}</p>

    <div class="mt-2">
        <button onclick="mostrarFormulario('{{ $respuesta->id }}')"
                class="text-green-600 text-sm hover:underline">
            Responder
        </button>
    </div>

    <form id="form-{{ $respuesta->id }}"
          action="{{ route('respuestas.store', $respuesta->forum_id) }}"
          method="POST" class="mt-2 hidden">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $respuesta->id }}">
        <textarea name="contenido"
                  class="w-full border px-2 py-1 mt-1 rounded"
                  placeholder="Tu respuesta..." required></textarea>
        <button type="submit"
                class="mt-2 bg-green-700 text-white px-4 py-1 rounded hover:bg-green-800">
            Publicar
        </button>
    </form>

    {{-- Subrespuestas --}}
    @foreach ($respuesta->respuestas as $subrespuesta)
        @include('forum.partials.respuesta', ['respuesta' => $subrespuesta, 'nivel' => $nivel + 1])
    @endforeach
</div>
