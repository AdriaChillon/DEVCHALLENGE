@extends('layouts.navbar')

@section('content')
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyectos</title>
        @vite(['resources/css/portfoli.css'])
    </head>

    <body>
        <section class="project-section">
            <div class="container">
                <div class="projectes">
                    <button class="lenguaj" onclick="filtrarProyectos('todos')">Todos</button>
                    <button class="lenguaj" onclick="filtrarProyectos('JavaScript')">JavaScript</button>
                    <button class="lenguaj" onclick="filtrarProyectos('Java')">Java</button>
                    <button class="lenguaj" onclick="filtrarProyectos('PHP')">PHP</button>
                </div>

                <div class="proyecto" data-lenguaje="JavaScript">
                    <h3><a href="/">DEVCHALLENGE1 - PORTFOLIO</a></h3>
                    <p>Lenguaje: JavaScript</p>
                </div>

                <div class="proyecto" data-lenguaje="PHP">
                    <h3><a href="{{ route('login') }}">DEVCHALLENGE2 - LOGIN</h3>
                    <p>Lenguaje: PHP</p>
                </div>
                <div class="proyecto" data-lenguaje="PHP">
                    <h3><a href="{{ route('calendar') }}">DEVCHALLENGE3 - CALENDARIO</h3>
                    <p>Lenguaje: PHP</p>
                </div>
                <div class="proyecto" data-lenguaje="JavaScript">
                    <h3><a href="{{ route('sqword') }}">DEVCHALLENGE4 - SQWORD</h3>
                    <p>Lenguaje: JavaScript</p>
                </div>
                <div class="proyecto" data-lenguaje="JavaScript">
                    <h3><a href="{{ route('game') }}">DEVCHALLENGE5 - PIEDRA PAPEL</h3>
                    <p>Lenguaje: JavaScript</p>
                </div>
            </div>
        </section>
        <script>
        function filtrarProyectos(lenguaje) {
            var proyectos = document.querySelectorAll('.proyecto');
        
            proyectos.forEach(proyecto => {
                var proyectoLenguaje = proyecto.getAttribute('data-lenguaje');
        
                if (lenguaje === 'todos' || proyectoLenguaje === lenguaje) {
                    proyecto.classList.add('visible'); // Mostrar proyecto
                } else {
                    proyecto.classList.remove('visible'); // Ocultar proyecto
                }
            });
        }
        
        window.onload = function () {
            filtrarProyectos('todos');
        };
        </script>
    </body>

    </html>
@endsection
