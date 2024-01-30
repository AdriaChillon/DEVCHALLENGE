    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Inicio de Sesión con Registro</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                background-color: #f4f4f4;
            }

            .login-container {
                max-width: 400px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }

            .login-container h2 {
                text-align: center;
            }

            .register-link {
                text-align: center;
                margin-top: 10px;
            }

            /* Estilos para el botón de Google */
            .btn-google {
                display: inline-block;
                background: none;
                /* Sin fondo */
                border: none;
                /* Sin borde */
                cursor: pointer;
                padding: 0;
            }

            /* Estilos para el ícono de Google */
            .google-icon-wrapper {
                width: 48px;
                height: 48px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 50%;
                /* Hace que el contenedor sea circular */
                background-color: #ffffff;
                /* Color de fondo de Google */
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.25);
            }

            .google-icon {
                width: 28px;
                height: 28px;
            }

            /* Estilos para el botón de GitHub */
            .btn-github {
                display: inline-block;
                background: none;
                border: none;
                cursor: pointer;
                padding: 0;
            }

            /* Estilos para el ícono de GitHub */
            .github-icon-wrapper {
                width: 48px;
                height: 48px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 50%;
                background-color: #333;
                /* Color de fondo de GitHub */
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.25);
            }

            .github-icon {
                width: 28px;
                height: 28px;
            }
        </style>
    </head>

    <body>
        <div class="container mt-5">
            <div class="login-container">
                <h2>Iniciar Sesión</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Correo electrónico o contraseña incorrectos
                    </div>
                @endif
                <form action="{{ route('inicia-sesion') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Ingresa tu correo electrónico">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Ingresa tu contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                    <div class="register-link">
                        ¿No tienes una cuenta? <a href="{{ route('registro') }}">Regístrate aquí</a>
                    </div>
                </form>
                <div class="text-center">
                    <a href="{{ url('/google-auth') }}" class="btn-google">
                        <div class="google-icon-wrapper">
                            <img class="google-icon"
                                src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                                alt="Google Logo">
                        </div>
                    </a>
                    <a href="{{ url('/github-auth') }}" class="btn-github">
                        <div class="github-icon-wrapper">
                            <img class="github-icon"
                                src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png"
                                alt="GitHub Logo">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </body>

    </html>
