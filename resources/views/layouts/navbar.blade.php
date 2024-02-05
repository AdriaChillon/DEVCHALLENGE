<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite(['resources/css/portfoli.css'])
</head>
<body>
    <div id="app">
        <nav>
            <ul>
                <li><a href="{{route('portfolio')}}" class="menu">Información Personal</a></li>
                <li><a href="{{route('habilitats')}}" class="menu">Habilidades/Aficiones</a></li>
                <li><a href="{{route('projectes')}}" class="menu">Proyectos</a></li>
            </ul>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>