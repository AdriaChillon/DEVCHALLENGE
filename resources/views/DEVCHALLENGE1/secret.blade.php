<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Usuario</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <h1>Bienvenido a tu página de usuario</h1>
        @auth
            <h2>{{ Auth::user()->name }}</h2>
        @endauth
    </header>
    <main>
        <p>Bienvenido a tu página. Aquí encontrarás acceso a tu calendario personal, a tu juego SQWORD en catalán y a Piedra-Papel-Tijeras.</p>

        <div class="portfolio-links">
            <a href="{{ route('calendar') }}" class="portfolio-link">Calendario</a>
            <a href="{{ route('sqword') }}" class="portfolio-link">SQWORD CATALÀ</a>
            <a href="{{ route('game') }}" class="portfolio-link">PIEDRA PAPEL</a>
        </div>
    </main>
    <footer class="bg-dark text-white text-center py-2 mt-4">
        <div class="container">
            <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar Sesión</a>
        </div>
        <p>&copy; 2023 Tu página web personal</p>
    </footer>
</body>
</html>
