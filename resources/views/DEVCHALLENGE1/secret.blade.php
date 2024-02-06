<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/css/app.css'])
</head>
<body>
    <header class="text-center text-white bg-dark py-4">
        <h1>Bienvenido a tu página de usuario</h1>
        @auth
        <h2>{{ Auth::user()->name }}</h2>
        @endauth
    </header>
    <main class="container mt-4">
        <p>Bienvenido a tu página. Aquí encontrarás acceso a tu calendario personal, a tu juego SQWORD en catalán y a Piedra-Papel-Tijeras-Lagarto-Spock.</p>
        <div class="d-flex flex-wrap justify-content-around">
            <div class="p-2">
                <img src="{{ asset('img/calendario.png') }}" alt="Calendario" class="img-fluid">
                <a href="{{ route('calendar') }}" class="portfolio-link d-block mt-2">Calendario</a>
            </div>
            <div class="p-2">
                <img src="{{ asset('img/sqword.png') }}" alt="SQWORD" class="img-fluid">
                <a href="{{ route('sqword') }}" class="portfolio-link d-block mt-2">SQWORD CATALÀ</a>
            </div>
            <div class="p-2">
                <img src="{{ asset('img/game.jpg') }}" alt="GAME" class="img-fluid">
                <a href="{{ route('game') }}" class="portfolio-link d-block mt-2">PIEDRA PAPEL TIJERAS LAGARTO SPOCK</a>
            </div>
        </div>
    </main>
    <footer class="bg-dark text-white text-center py-2 mt-4 fixed-bottom">
        <div class="container">
            <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar Sesión</a>
        </div>
        <p>&copy; 2023 Tu página web personal</p>
    </footer>
</body>
</html>
