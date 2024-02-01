// Importaciones necesarias
import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Modal } from 'bootstrap';

// Lista de ejemplo de palabras en catalán
var diccionarioCatalan;
// Variables globales
const letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
let letraActual = '';
let tablero = [];
let contador = 0;

document.addEventListener('DOMContentLoaded', () => {
    cargarDiccionario();
    iniciarJuego();
});

function cargarDiccionario() {
    fetch('/files/out.txt')
        .then(response => response.text())
        .then(contenido => {
            diccionarioCatalan = contenido.split('\n').map(palabra => palabra.trim().toLowerCase());
        })
        .catch(error => console.error('Error al cargar el diccionario:', error));
}

function iniciarJuego() {
    inicializarTablero();
    cambiarLetraActual();
    configurarInputLetra();
}

function inicializarTablero() {
    const casillas = document.querySelectorAll('#tablero .casella');
    casillas.forEach((casilla, index) => {
        let fila = Math.floor(index / 5);
        let columna = index % 5;
        if (!tablero[fila]) {
            tablero[fila] = [];
        }
        tablero[fila][columna] = '';
        casilla.textContent = '';
        casilla.addEventListener('click', () => colocarLetra(casilla, fila, columna));
    });
    contador = 0;
}

function cambiarLetraActual() {
    let letraPonderada;

    // Probabilidad de que sea vocal: 40%
    if (Math.random() < 0.4) {
        const vocales = 'AEIOU'.split('');
        letraPonderada = vocales[Math.floor(Math.random() * vocales.length)];
    } else {
        // Probabilidad de que sea consonante: 60%
        letraPonderada = letras[Math.floor(Math.random() * letras.length)];
    }

    letraActual = letraPonderada;
    document.getElementById('letra-actual').textContent = `Lletra Actual: ${letraActual}`;
}

function configurarInputLetra() {
    const inputLetra = document.getElementById('lletra');
    inputLetra.addEventListener('change', () => {
        const letraIngresada = inputLetra.value.toUpperCase();
        if (letras.includes(letraIngresada)) {
            letraActual = letraIngresada;
            document.getElementById('letra-actual').textContent = `Lletra Actual: ${letraActual}`;
        } else {
            alert('Lletra no vàlida');
            inputLetra.value = letraActual;
        }
    });
}

function colocarLetra(casilla, fila, columna) {
    if (tablero[fila][columna] === '') {
        casilla.textContent = letraActual;
        tablero[fila][columna] = letraActual;
        contador++;
        if (contador === 25) {
            calcularPuntuacion();
        } else {
            cambiarLetraActual();
        }
    }
}

function calcularPuntuacion() {
    let puntuacion = 0;
    let palabrasEncontradas = new Set();
    for (let i = 0; i < 5; i++) {
        buscarPalabrasEnLinea(tablero[i], palabrasEncontradas);
        let columna = tablero.map(fila => fila[i]);
        buscarPalabrasEnLinea(columna, palabrasEncontradas);
    }
    puntuacion = [...palabrasEncontradas].reduce((sum, palabra) => sum + palabra.length, 0);
    mostrarPuntuacion(puntuacion, palabrasEncontradas);
    guardarPuntuacion(puntuacion);
}

function buscarPalabrasEnLinea(linea, palabrasEncontradas) {
    for (let longitud = 3; longitud <= 5; longitud++) {
        for (let i = 0; i <= linea.length - longitud; i++) {
            let palabra = linea.slice(i, i + longitud).join('');
            if (esPalabraValida(palabra)) {
                palabrasEncontradas.add(palabra);
                console.log('Palabra encontrada:', palabra);
            }
        }
    }
}


function guardarPuntuacion(puntuacion) {
    fetch('/score', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ score: puntuacion })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Puntuación guardada:', data);
        // Aquí puedes llamar a otras funciones, como mostrar las últimas puntuaciones
    })
    .catch((error) => {
        console.error('Error al guardar la puntuación:', error);
    });
}

function mostrarPuntuacion(puntuacion, palabrasEncontradas) {
    const resultadoDiv = document.getElementById('resultado');
    const puntuacionTexto = document.getElementById('puntuacion-texto');
    const palabrasDiv = document.getElementById('palabras-adivinadas');

    // Puedes ajustar el texto para que refleje el puntaje real
    puntuacionTexto.textContent = `La teva puntuació es: ${puntuacion} punts.`;
    palabrasDiv.innerHTML = [...palabrasEncontradas].map(palabra => `<span class="palabra-adivinada">${palabra}</span>`).join(' ');

    resultadoDiv.classList.add('resultado-visible');
    mostrarUltimasPuntuaciones();

    // Hacer scroll hacia abajo
    resultadoDiv.scrollIntoView({ behavior: 'smooth', block: 'end' });
}


function mostrarUltimasPuntuaciones() {
    fetch('/scores/last-five', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(scores => {
        const scoresList = document.getElementById('lista-puntuaciones');
        scoresList.innerHTML = ''; // Limpia el contenido anterior

        scores.forEach(score => {
            const scoreItem = document.createElement('div');
            scoreItem.textContent = `Puntuació: ${score.score} -  ${new Date(score.created_at).toLocaleDateString()}`;
            scoresList.appendChild(scoreItem);
        });
    })
    .catch(error => console.error('Error:', error));
}


function reiniciarJuego() {
    contador = 0;
    tablero = Array.from({ length: 5 }, () => Array(5).fill(''));
    iniciarJuego();
    const resultadoDiv = document.getElementById('resultado');
    resultadoDiv.classList.remove('resultado-visible');
    resultadoDiv.classList.add('resultado-oculto');
}


function mostrarInstrucciones() {
    const modalElement = document.getElementById('modal');
    const modal = new Modal(modalElement);
    modal.show();
}

function ocultarInstrucciones() {
    const modalElement = document.getElementById('modal');
    const modal = Modal.getInstance(modalElement);
    if (modal) {
        modal.hide();
    }
}

function esPalabraValida(palabra) {
    return diccionarioCatalan.includes(palabra.toLowerCase());
}

document.getElementById('instruccions').addEventListener('click', mostrarInstrucciones);
document.getElementById('reiniciar').addEventListener('click', reiniciarJuego);
document.getElementById('close').addEventListener('click', ocultarInstrucciones);