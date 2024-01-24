<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQWORD</title>
    @vite(['resources/css/sqword.css', 'resources/js/sqword.js'])
</head>

<body>
    <header>
        <div id="banner">
            <h1>SQWORD al Català</h1>
        </div>
        <a href="/privada" class="btn btn-secondary" id="sortir">Sortir</a>

    </header>

    <div id="letra-actual">Lletra Actual</div>
    <input type="text" id="lletra" placeholder="A">
    <div id="tablero">
        <?php
        for ($fila = 1; $fila <= 5; $fila++) {
            for ($columna = 1; $columna <= 5; $columna++) {
                echo '<div class="casella"></div>';
            }
        }
        ?>
    </div>
    <button id="instruccions" class="btn btn-secondary">Instruccions</button>

    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Com es juga?</h5>
                </div>
                <div class="modal-body">
                    <p>Col·loca les targetes amb lletres a la graella per formar tantes paraules de 3, 4 i 5 lletres com
                        puguis.
                        Les paraules es poden formar tant horitzontalment (d'esquerra a dreta) com verticalment (de dalt
                        a baix) per un màxim de 50 punts.
                        Un cop una lletra està col·locada, no es pot moure.
                        Després que s'hagi col·locat la darrera lletra, la teva graella serà puntuada.
                        Cada paraula obté puntuació segons la seva longitud (és a dir, una paraula de 4 lletres val 4
                        punts) i cada línia serà puntuada segons la paraula més llarga que contingui.
                        A gaudir del joc!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">A
                        jugar!</button>
                </div>
            </div>
        </div>
    </div>    
    <div id="resultado" class="resultado-oculto">
        <div class="resultado-header">
            <h2>Felicitats has finalitzat la teva partida!</h2>
        </div>
        <div class="resultado-body">
            <p id="puntuacion-texto">La teva puntuació ha sigut de: </p>
            <button id="reiniciar" class="btn btn-secondary">Torna a jugar!</button>
        </div>
        <div class="palabras-container">
            <h3>Paraules encertades:</h3>
            <div id="palabras-adivinadas"></div>
        </div>
        <div class="historial-puntuaciones">
            <h4>Les teves útlimes 5 puntuacions:</h4>
            <!-- Aquí puedes agregar el historial de puntuaciones -->
        </div>
    </div>
</body>
<footer>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</footer>
</html>
