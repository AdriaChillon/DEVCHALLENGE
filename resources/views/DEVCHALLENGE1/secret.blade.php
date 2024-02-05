<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pàgina d'Usuari</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <h1>Benvingut a la teva pàgina d'usuari</h1>
        @auth
            <h2>{{ Auth::user()->name }}</h2>
        @endauth
    </header>
    <main>
        <p>Benvingut a la teva pàgina. Aquí trobaràs accés al teu calendari personal, al teu joc SQWORD al català i el Pedra-Paper-Tisores.</p>

        <div class="portfolio-links">
            <a href="{{ route('calendar') }}" class="portfolio-link">Calendari</a>
            <a href="{{ route('sqword') }}" class="portfolio-link">SQWORD CATALÀ</a>
            <a href="{{ route('game') }}" class="portfolio-link">PEDRA PAPER</a>
        </div>
    </main>
    <footer class="bg-dark text-white text-center py-2 mt-4">
        <div class="container">
            <a href="{{ route('logout') }}" class="btn btn-danger">Tancar Sessió</a>
        </div>
        <p>&copy; 2023 La teva pàgina web personal</p>
    </footer>
</body>
</html>