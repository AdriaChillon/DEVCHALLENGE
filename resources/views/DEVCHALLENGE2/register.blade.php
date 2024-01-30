<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de Registre</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .register-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .register-container h2 {
            text-align: center;
        }
        .login-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="register-container">
            <h2>Registre</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    Correu electrònic ya existent
                </div>
            @endif
            <form action="{{route('validar-registro')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Insereix el teu nom" required>
                </div>
                <div class="form-group">
                    <label for="email">Correu Electrònic</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Insereix el teu correu electrònic" required> 
                </div>
                <div class="form-group">
                    <label for="password">Contrasenya</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Insereix la teva contrasenya" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrar-se</button>
            </form>
            <div class="login-link">
                ¿Ja tens un compte? <a href="{{route('login')}}">Inicia Sessió aquí</a>
            </div>
        </div>
    </div>
</body>
</html>