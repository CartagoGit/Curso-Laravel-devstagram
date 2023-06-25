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
        <div class="container mx-auto flex justify-between items-center">

            <h1 class="text-3xl font-black"> <a href="/">DevStagram </a> </h1>
            <nav class="flex gap-3 sx:gap-5 sm:gap-10">
                @if (auth()->check())
                    <div class="font-bold  text-gray-600">
                        Hola <span class="font-normal">
                            {{ auth()->user()->name }}
                        </span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="font-bold uppercase text-gray-600 text-sm ">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a class="font-bold uppercase text-gray-600 text-sm " href="/login">Iniciar sesión</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">
                        Crear Cuenta
                    </a>
                @endif

                {{-- * Se podria hacer asi o con la directiva auth --}}
                {{-- @auth
                    <div class="text-gray-600 text-sm">
                        Hola <span class="font-normal">
                            {{ auth()->user()->name }}
                        </span>
                    </div>
                    <a class="font-bold uppercase text-gray-600 text-sm " href="{{ auth()->logout() }}">
                        Cerrar sesión
                    </a>

                @endauth

                @guest(auth()->check())
                    <a class="font-bold uppercase text-gray-600 text-sm " href="{{ route('login') }}">
                        Iniciar sesión
                    </a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">
                        Crear Cuenta
                    </a>
                @endguest --}}
            </nav>


        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
        @yield('contenido')
    </main>
    <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-10">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>

</body>

</html>
