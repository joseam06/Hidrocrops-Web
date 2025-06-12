@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-green-800 mb-6">Agregar recurso al módulo</h2>

    <form action="{{ route('recursos.store', $moduleId) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="module_id" value="{{ $moduleId }}">

        {{-- Título --}}
        <div class="mb-4">
            <label for="titulo" class="block text-sm font-medium text-gray-700">Título del recurso</label>
            <input type="text" name="titulo" id="titulo" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Descripción --}}
        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="w-full border rounded px-3 py-2" rows="3"></textarea>
        </div>

        {{-- Tipo de recurso --}}
        <div class="mb-4">
            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de recurso</label>
            <select name="tipo" id="tipo" class="w-full border rounded px-3 py-2" required onchange="mostrarCampos()">
                <option value="">Selecciona un tipo</option>
                <option value="pdf">PDF</option>
                <option value="video">Video (mp4, webm)</option>
                <option value="podcast">Audio / Podcast (mp3)</option>
                <option value="imagen">Imagen o GIF</option>
            </select>
        </div>

        {{-- Archivo --}}
        <div class="mb-6">
            <label for="archivo" class="block text-sm font-medium text-gray-700">Archivo</label>
            <input type="file" name="archivo" id="archivo" class="mt-1" required>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded">
                Guardar recurso
            </button>
        </div>
    </form>
</div>

{{-- Validación JS opcional (para ayuda visual) --}}
@push('scripts')
<script>
    function mostrarCampos() {
        const tipo = document.getElementById('tipo').value;
        const input = document.getElementById('archivo');

        let aceptado = '';
        if (tipo === 'pdf') aceptado = '.pdf';
        if (tipo === 'video') aceptado = '.mp4,.webm';
        if (tipo === 'podcast') aceptado = '.mp3';
        if (tipo === 'imagen') aceptado = '.jpg,.jpeg,.png,.gif';

        input.setAttribute('accept', aceptado);
    }
</script>
@endpush
@endsection
