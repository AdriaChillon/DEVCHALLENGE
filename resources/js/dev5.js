document.addEventListener('DOMContentLoaded', function() {
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        console.log("Conexión establecida!");
    };

    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);
        if (data.action === 'confirmation') {
            console.log(data.message);
        } else if (data.action === 'result') {
            displayResult(data.result, data.userName); // Usar data.userName en lugar de obtenerlo del DOM
        }
    };

    var choices = document.querySelectorAll('.choice-button');
    choices.forEach(function(choice) {
        choice.addEventListener('click', function() {
            var play = this.getAttribute('data-choice');
            var userName = document.getElementById('user-name').textContent;
            console.log("Nombre de usuario obtenido:", userName);
            sendMessage({action: 'play', play: play, userId: userId, userName: userName}); // Pasar el nombre de usuario
            console.log("Enviando elección:", play);
            disableChoices();
        });
    });

    function sendMessage(message) {
        console.log("Intentando enviar mensaje:", message);
        if (conn.readyState === WebSocket.OPEN) {
            conn.send(JSON.stringify(message));
        } else {
            console.log("La conexión no está lista");
        }
    }

    function displayResult(result, userName) {
        console.log(userName + "<br>" + result);
        var resultElement = document.getElementById('game-result');
        resultElement.innerHTML = userName + ' ' + result;
        updateGameHistory(userName + ' ' + result);
    }

    function updateGameHistory(result) {
        var gameHistory = document.getElementById('game-history');
        var newResultItem = document.createElement('li');
        newResultItem.classList.add('list-group-item');
        newResultItem.textContent = result;
        gameHistory.appendChild(newResultItem);
    }

    function disableChoices() {
        choices.forEach(function(choice) {
            choice.disabled = true;
        });
        setTimeout(function() {
            choices.forEach(function(choice) {
                choice.disabled = false;
            });
        }, 3000);
    }
});
