<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iglesia-App</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        .content p {
            margin-bottom: 10px; /* Reduce el espacio entre los párrafos */
        }
        .login-form {
            margin-top: 20px; /* Ajusta el espacio superior del formulario de login */
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Bienvenido a la Iglesia</h1>
        </div>
    </header>
    <nav>
        
    </nav>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="content">
                        <h2>Saludos de parte de la Iglesia!</h2>
                        <p>¡Te damos una cálida bienvenida a nuestra aplicación en línea! Aquí, encontrarás una amplia gama de recursos diseñados para facilitar la organización y gestión de nuestra iglesia.</p>
                        <p>Explora las numerosas funciones que ofrecemos para simplificar la administración eclesiástica y mantener a nuestra comunidad conectada.</p>
                    </div>
                    <div class="login-form mt-3">
                        <h3>Iniciar sesión</h3>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label for="identificador">Celular o Correo</label>
                                <input type="text" class="form-control" id="identificador" name="identificador" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <p>O inicia sesión con</p>
                            <a href="login_facebook.php" class="btn btn-primary btn-block" style="background-color: #3b5998; border-color: #3b5998;">Facebook</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="resource/iglesia.png" alt="Iglesia">
                    
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container text-center">
            <p>&copy; <?php echo date("Y"); ?> IglesiaApp</p>
        </div>
    </footer>
</body>

</html>
