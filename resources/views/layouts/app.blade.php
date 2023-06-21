<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>DevStagram - @yield('titulo')</title>

</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="conatiner mx-auto flex justify-between items-center">

            <h1 class="text-3xl font-black">DevStagram</h1>

            <nav>
                <a class="font-bold uppercase text-gray-600 text-sm " href="#">Login</a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="#">Crear Cuenta</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
        @yield('contenido')
    </main>
    <footer>

    </footer>

</body>

</html>
