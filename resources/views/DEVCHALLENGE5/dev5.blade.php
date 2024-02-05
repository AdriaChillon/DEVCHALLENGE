<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra-Papel-Tijeras-Lagarto-Spock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        @vite(['resources/js/dev5.js', 'resources/css/game.css'])
</head>
<body class="container">
    <div class="banner">
        <h1 class="text-center text-light">PIEDRA-PAPEL-TIJERAS-LAGARTO-SPOCK</h1>
    </div>
    <div id="user-name" class="text-center text-dark">{{ auth()->user()->name }}</div>
    <div class="choices-container">
        <div class="col-6 text-center">
            <button class="choice-button" data-choice="piedra"><img src="{{ asset('img/piedra.png') }}" alt="Piedra"></button>
            <button class="choice-button" data-choice="papel"><img src="{{ asset('img/papel.png') }}" alt="Papel"></button>
            <button class="choice-button" data-choice="tijeras"><img src="{{ asset('img/tijeras.png') }}" alt="Tijeras"></button>
            <button class="choice-button" data-choice="lagarto"><img src="{{ asset('img/lagarto.png') }}" alt="Lagarto"></button>
            <button class="choice-button" data-choice="spock"><img src="{{ asset('img/spok.png') }}" alt="Spock"></button>
        </div>
        <div id="message-container" class="text-center mt-4"></div>
    </div>
    <div class="results-container mt-4">
        <h2 class="text-center text-dark">Resultados</h2>
        <ul id="game-history" class="list-group"></ul>
    </div>
    <div id="game-result" class="text-center text-dark"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        var userId = @json(auth()->user()->id);
    </script>
</body>
</html>
