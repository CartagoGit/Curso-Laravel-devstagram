<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DevStagram - @yield('titulo')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
    </style>
</head>

<body>
    <nav>
        <a href="/">Principal</a>
        <a href="/nosotros">Nosotros</a>
        <a href="/tienda">Tienda</a>
    </nav>
    <h1>@yield('titulo')</h1>
    <hr>
    @yield('contenido')

</body>

</html>
