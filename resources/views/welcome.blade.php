<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hidrocrops Web - Aprende hidroponía fácil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-green-50 text-gray-800 font-sans">

    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-green-800">HIDROCROPS WEB</h1>
        <nav>
            <a href="#como-funciona" class="text-green-800 font-semibold hover:text-green-700 px-3">¿Cómo funciona?</a>
            <a href="#beneficios" class="text-green-800 font-semibold hover:text-green-700 px-3">Beneficios</a>
            <a href="{{ route('register') }}" class="bg-green-600 text-white font-semibold px-6 py-3 rounded text-lg hover:bg-green-800">Registrarse</a>
            <a href="{{ route('login') }}" class="bg-green-600 text-white font-semibold px-6 py-3 rounded text-lg hover:bg-green-800">Iniciar sesión</a>
            
        </nav>
    </header>

    <main class="p-8 text-center">
        <section class="my-16">
            <h2 class="text-4xl font-bold text-green-800">Cultiva sin necesidad de tierra</h2>
            <h2 class="text-4xl font-semibold text-green-600">Aprende el metodo de cultivacion hidroponico desde cero.</h2>
            <p class="mt-4 text-lg font-bold">Con nuestra plataforma educativa, aprenderás paso a paso a crear y manejar tu propio cultivo hidropónico.</p>
        <div class="mt-8 flex justify-center gap-6 flex-wrap">
            <img src="{{ asset('images/hidroponia2.jpg') }}" alt="Cultivo Hidropónico 2" class="w-80 h-auto rounded-lg shadow-md">
            <img src="{{ asset('images/hidroponia3.jpg') }}" alt="Cultivo Hidropónico 2" class="w-80 h-auto rounded-lg shadow-md">
        </div>

        </section>

        <section id="como-funciona" class="my-16">
            <h3 class="text-4xl font-bold text-green-800">¿Cómo funciona Hidrocrops Web?</h3>
            <p class="mt-2 max-w-2xl font-semibold mx-auto">Ofrecemos módulos interactivos, asesoría virtual para que aprendas desde casa, además de foros para que puedas resolver todas tus dudas con otros usuarios o directamente con el administrador.</p>
        <div class="mt-8 flex justify-center gap-6 flex-wrap">
            <img src="{{ asset('images/sishidro.jpg') }}" alt="Cultivo Hidropónico 2" class="w-80 h-auto rounded-lg shadow-md">
        </div>
        </section>

        <section id="beneficios" class="my-16">
            <h3 class="text-2xl font-bold text-green-800">Beneficios</h3>
            <ul class="mt-4 space-y-2 max-w-md mx-auto text-left list-disc list-inside">
                <li>Acceso 24/7 desde cualquier lugar</li>
                <li>Contenidos visuales y prácticos</li>
                <li>Diseñado para principiantes y expertos</li>
            </ul>
        </section>
    </main>

    <footer class="bg-white p-4 text-center text-sm text-gray-500">
        © 2025 Hidrocrops Web. Todos los derechos reservados.
    </footer>

</body>
</html>