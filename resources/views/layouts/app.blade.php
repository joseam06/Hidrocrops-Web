<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidrocrops Web</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-green-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Agrupar logo y nombre en un contenedor flex -->
        <div class="flex items-center space-x-2">
        <img src="{{ asset('images/icon.jpg') }}" alt="Hidrocrops Logo" class="w-10 h-10 rounded-full shadow">

        <h1 class="text-xl font-bold">HIDROCROPS WEB</h1>
        </div>
                <div class="space-x-4">
                    
                @auth
    @if(Auth::user()->role_usuario === 'admin')
    
        <a href="{{ url('/admin') }}" class="ml-2 bg-green-700 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Admin Panel
        </a>

        <a href="{{ route('admin.modules.create') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Crear módulo
        </a>
    @endif
@endauth

                    <a href="{{ route('dashboard') }}" class="hover: font-bold underline">Inicio</a>
                    <a href="{{ route('modules.index') }}" class="hover: font-bold underline">Módulos</a>
                    <a href="{{ route('evaluations.index') }}" class=" font-bold hover: underline">Evaluaciones</a>
                    <a href="{{ route('forum.index') }}" class="hover: font-bold underline">Foro</a>

                </div>
                
                <!-- Menú de usuario -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <span>Hola, {{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Menú desplegable -->
                    <div x-show="open" @click.away="open = false" 
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-800 hover:bg-green-50">
                            Mi Perfil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-green-50">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="container mx-auto p-4">
            @yield('content')
        </main>
    </div>
    
    <!-- AlpineJS para el menú desplegable -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>