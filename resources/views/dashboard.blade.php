@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">




    <!-- Sección principal -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-6">¡Bienvenido a nuestra herramienta web!</h2>
        

        <!-- Tarjetas de secciones principales -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Tarjeta Módulos -->
            <a href="{{ route('modules.index') }}" class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto text-green-800 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-lg font-medium">Módulos de aprendizaje</h3>
                </div>
            </a>

            <!-- Tarjeta Evaluaciones -->
            <a href="{{ route('evaluations.index') }}" class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto text-green-800 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium">Evaluaciones</h3>
                </div>
            </a>

            <!-- Tarjeta Foro -->
            <a href="{{ route('forum.index') }}" class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto text-green-800 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="text-lg font-medium">Foro</h3>
                </div>
            </a>
        </div>

        <!-- Sección Progreso -->
        <div class="border border-gray-200 rounded-lg p-6 mb-8 hover:shadow-md transition-shadow">
            <a href="{{ route('progress.index') }}" class="block">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-green-800 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium">Progreso del usuario</h3>
                </div>
            </a>
        </div>

        <!-- Imagen y botón Explorar Hidroponía -->
        <div class="text-center">
            <img src="{{ asset('images/hidroponia.jpg') }}" alt="Hidroponía" class="mx-auto mb-4 rounded-lg shadow-md max-h-64">
            <a href="{{ route('modules.index') }}" class="inline-block bg-green-800 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                Explorar Hidroponía
            </a>
        </div>
    </div>
</div>

<footer class="bg-white p-4 text-center text-sm text-gray-500">
        © 2025 Hidrocrops Web. Todos los derechos reservados.
    </footer>
@endsection