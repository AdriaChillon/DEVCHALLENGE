@extends('layouts.navbar')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Usuario</title>
    @vite(['resources/css/portfoli.css'])
</head>

<body>
    <div class="container">
        <div class="datos-personales">
            <img src="{{ asset('img/myAvatar.png') }}" class="fotodni">
            <div class="nombre">Adrià Chillón Sánchez</div>
            <p>Desenvolupador web</p>
            <div class="datos">
                <p>Me considero una persona responsable y con ganas de aportar todos los conocimientos que he adquirido
                    en
                    trabajos anteriores,
                    además de seguir creciendo como profesional.</p>
                <p>I consider myself a responsible person and eager to contribute all the knowledge
                    I have acquired in previous jobs, in addition to continuing to grow as a professional.</p>
                <p><img src="{{ asset('img/edad.jpg') }}">28/03/2002</p>
                <p><img src="{{ asset('img/mail.png') }}">adria.chillon@insbaixcamp.cat</p>
                <p><img src="{{ asset('img/phone.png') }}">(+34) 640 211 674</p>
            </div>
        </div>
    </div>
</body>

</html>
@endsection
