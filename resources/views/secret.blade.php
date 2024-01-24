<!DOCTYPE html>
<html lang="en">
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
        <h2>Mi Portafolio</h2>
        <p>Bienvenido a mi página. Aquí encontrarás acceso a mi calendario personal y próximamente a un emocionante juego.</p>

        <div class="portfolio-links">
            <a href="/calendar" class="portfolio-link">Calendario</a>
            <a href="/sqword" class="portfolio-link">Juego (Próximamente)</a>
        </div>
    </main>
    <footer class="bg-dark text-white text-center py-2 mt-4">
        <div class="container">
            <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar Sesión</a>
        </div>
        <p>&copy; 2023 Tu Empresa</p>
    </footer>
</body>
</html>

