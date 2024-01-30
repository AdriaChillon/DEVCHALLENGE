@extends('layouts.navbar')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Habilitats i Aficions</title>
        @vite(['resources/css/portfoli.css'])
    </head>

    <body>
        <h1>Habilitats</h1>
        <section class="habilitats-section">
            <div class="container">
                <section>
                    <h3>Habilitats Front-End</h3>
                    <p><img src="{{ asset('img/html.png') }}">Llenguatge d'etiquetes HTML</p>
                    <p><img src="{{ asset('img/css.png') }}">Llenguatge d'estils CSS</p>
                    <p><img src="{{ asset('img/js.png') }}">Llenguatge de programació JAVASCRIPT</p>
                </section>

                <section>
                    <h3>Habilitats Back-End</h3>
                    <p><img src="{{ asset('img/java.png') }}">Llenguatge de programació JAVA</p>
                    <p><img src="{{ asset('img/php.png') }}">Llenguatge de programació PHP</p>
                </section>

                <h1 class="afi">Aficions</h1>
                <div class="aficions-container">
                    <section class="aficion">
                        <h3 class="afi">Esport</h3>
                        <img src="{{ asset('img/padel.jpg') }}">
                    </section>
                
                    <section class="aficion">
                        <h3 class="afi">Oci</h3>
                        <img src="{{ asset('img/discoteca.jpg') }}">
                    </section>
                
                    <section class="aficion">
                        <h3 class="afi">Tecnologia</h3>
                        <img src="{{ asset('img/tecnologia.jpg') }}">
                    </section>
                </div>                
            </div>
        </section>
    </body>
    </html>
@endsection
