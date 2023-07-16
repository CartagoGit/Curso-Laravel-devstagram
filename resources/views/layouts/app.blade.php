<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    @stack('styles')
    {{-- @stack('scripts') --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>DevStagram - @yield('titulo')</title>

</head>

<body class="bg-gray-100">
    <header class="border-b bg-white p-5 shadow">
        <div
            class="container mx-auto flex flex-col items-center justify-between md:flex-row">

            <h1 class="text-3xl font-black"> <a href="/">DevStagram </a>
            </h1>
            <nav
                class="sx:gap-5 flex w-full justify-between gap-3 pt-5 sm:gap-10 md:w-auto md:justify-end md:pt-0">
                @if (auth()->check())
                    <a
                        class="flex cursor-pointer items-center gap-2 rounded border bg-white p-2 text-sm font-bold uppercase text-gray-600 transition-all duration-300 hover:ring hover:ring-gray-500"
                        href="{{ route('posts.create') }}"
                    >
                        <svg
                            class="h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                            />
                        </svg>

                        Crear publicación
                    </a>
                    <div class="flex gap-4">

                        <a
                            class="flex items-center gap-2 rounded-lg p-3 font-bold text-gray-600 transition-all duration-300 hover:ring hover:ring-gray-500"
                            href={{ route('posts.index', auth()->user()->path) }}
                        >
                            Hola <span class="font-normal">
                                {{ auth()->user()->name }}
                            </span>
                        </a>
                        <form
                            class="flex items-center"
                            novalidate
                            action="{{ route('logout') }}"
                            method="POST"
                        >
                            @csrf
                            <button
                                class="rounded-lg p-3 text-sm font-bold uppercase text-gray-600 transition-all duration-300 hover:ring hover:ring-gray-500"
                            >
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                @else
                    <a
                        class="rounded-lg p-3 text-sm font-bold uppercase text-gray-600 transition-all duration-300 hover:ring hover:ring-gray-500"
                        href="/login"
                    >Iniciar sesión</a>
                    <a
                        class="rounded-lg p-3 text-sm font-bold uppercase text-gray-600 transition-all duration-300 hover:ring hover:ring-gray-500"
                        href="{{ route('register') }}"
                    >
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
        <h2 class="mb-10 text-center text-3xl font-black">@yield('titulo')</h2>
        @yield('contenido')
    </main>
    <footer class="mt-10 p-5 text-center font-bold uppercase text-gray-500">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>

</body>

</html>
