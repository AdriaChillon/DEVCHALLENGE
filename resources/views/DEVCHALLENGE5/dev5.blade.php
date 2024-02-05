<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra-Papel-Tijeras-Lagarto-Spock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
        }

        .choice {
            margin: 10px;
        }

        #user-name {
            margin-top: 10px;
            font-size: 18px;
        }

        #game-result {
            margin-top: 20px;
            font-size: 24px;
        }

        .choices-container {
            display: flex;
            justify-content: center;
        }

        .choice-button {
            padding: 10px 20px;
            font-size: 18px;
        }

        .choice-display {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .results-container {
            max-width: 600px;
            margin: auto;
            padding-top: 20px;
        }

        .list-group-item {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            margin-bottom: 5px;
        }
    </style>
    @vite(['resources/js/dev5.js'])
</head>
<body class="container">
    <h1 class="text-center">Piedra-Papel-Tijeras-Lagarto-Spock</h1>
    <!-- Agregar un div para mostrar el nombre del usuario -->
    <div id="user-name" class="text-center">
        {{ auth()->user()->name }}
    </div>
    <div class="choices-container">
        <div class="col-6 text-center">
            <button class="choice-button" data-choice="piedra">Piedra</button>
            <button class="choice-button" data-choice="papel">Papel</button>
            <button class="choice-button" data-choice="tijeras">Tijeras</button>
            <button class="choice-button" data-choice="lagarto">Lagarto</button>
            <button class="choice-button" data-choice="spock">Spock</button>
        </div>
    </div>
    <div class="results-container mt-4">
        <h2 class="text-center">Resultados</h2>
        <ul id="game-history" class="list-group">
        </ul>
    </div>
    <!-- Cambiar el ID del resultado para que sea más específico -->
    <div id="game-result" class="text-center"></div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
<script>
    var userId = @json(auth()->user()->id);
</script>
</html>
