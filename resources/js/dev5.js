var conn;
document.addEventListener('DOMContentLoaded', function() {
    
    const rulesDescription = {
        'tijeras cortan papel': ['tijeras', 'papel'],
        'papel cubre piedra': ['papel', 'piedra'],
        'piedra aplasta lagarto': ['piedra', 'lagarto'],
        'lagarto envenena Spock': ['lagarto', 'spock'],
        'Spock destruye tijeras': ['spock', 'tijeras'],
        'tijeras decapitan lagarto': ['tijeras', 'lagarto'],
        'lagarto come papel': ['lagarto', 'papel'],
        'papel desaprueba Spock': ['papel', 'spock'],
        'Spock vaporiza piedra': ['spock', 'piedra'],
        'piedra aplasta tijeras': ['piedra', 'tijeras']
    };
    
    

    function connectWebSocket() {
        conn = new WebSocket('ws://217.160.248.11:8080');

        conn.onopen = function(e) {
            console.log("Conexión establecida!");
        };

        conn.onerror = function(err) {
            console.log("Error en la conexión: ", err);
        };

        conn.onclose = function(e) {
            console.log("Conexión perdida, intentando reconectar...");
            setTimeout(connectWebSocket, 1000); // Intenta reconectar después de 1 segundo
        };

        conn.onmessage = function(e) {
            var data = JSON.parse(e.data);
            console.log(data);
            switch (data.action) {
                case 'wait':
                    displayWaitMessage(data.message);
                    break;
                case 'result':
                    displayResult(data);
                    // Considera reactivar los botones aquí si se espera que el usuario pueda continuar
                    enableChoices();
                    break;
                case 'continue':
                    // Manejo específico para cuando se debe continuar después de un empate
                    enableChoices(); // Asegúrate de que esta función reactiva los botones adecuadamente
                    displayContinueMessage(data.message); // Muestra un mensaje indicando que se puede continuar
                    break;
            }
        };
    }

    function sendMessage(message) {
        if (conn.readyState === WebSocket.OPEN) {
            conn.send(JSON.stringify(message));
        } else {
            console.log("La conexión no está lista.");
        }
    }

    function displayWaitMessage(message) {
        var messageContainer = document.getElementById('message-container');
        messageContainer.innerHTML = message;
    }

    function displayResult(data) {
        const resultElement = document.getElementById('game-result');
        let message;
    
        // Comprobar si hay un empate
        if (data.userPlay === data.opponentPlay) {
            message = `Ambos hais elegido ${capitalize(data.userPlay)} -> EMPATE`;
        } else {
            // Utiliza la función getMessageForPlays para obtener el mensaje específico de la jugada
            let playMessage = getMessageForPlays(data.userPlay, data.opponentPlay);
            message = `${playMessage} - ${data.winnerName} -> GANA`;
        }
    
        resultElement.innerHTML = message;
        updateGameHistory(message); // Asume que esta función ya existe y maneja la actualización del historial de juegos
    }
    
    function getMessageForPlays(userPlay, opponentPlay) {    
        let message = "";
        // Si no es un empate, buscar la descripción de la jugada ganadora
        Object.keys(rulesDescription).forEach((key) => {
            const plays = rulesDescription[key];
            if (plays.includes(userPlay) && plays.includes(opponentPlay)) {
                message = key; // Encuentra y asigna el mensaje basado en la regla correspondiente
            }
        });
        return message;
    }
    
    function capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }
    
    

    function displayContinueMessage(message) {
        var messageContainer = document.getElementById('message-container');
        messageContainer.innerHTML = message;
    }

    function enableChoices() {
        var choices = document.querySelectorAll('.choice-button');
        choices.forEach(function(choice) {
            choice.disabled = false; // Reactiva los botones para permitir nuevas elecciones
        });
    }
    

    function updateGameHistory(result) {
        var gameHistory = document.getElementById('game-history');
        var newResultItem = document.createElement('li');
        newResultItem.classList.add('list-group-item');
        newResultItem.textContent = result;
        gameHistory.appendChild(newResultItem);
    }

    var choices = document.querySelectorAll('.choice-button');
    choices.forEach(function(choice) {
        choice.addEventListener('click', function() {
            var play = this.getAttribute('data-choice');
            var userName = document.getElementById('user-name').textContent;
            sendMessage({
                action: 'play',
                play: play,
                userId: userId,
                userName: userName
            });
            disableChoices();
        });
    });

    function disableChoices() {
        choices.forEach(function(choice) {
            choice.disabled = true;
        });
    }

    // Inicializar la conexión WebSocket al cargar la página
    connectWebSocket();
});
