<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iglesia-App</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
   
</head>

<body>
    <header>
        <div class="container">
            <h1>Bienvenido a la Iglesia</h1>
        </div>
    </header>
    <nav class="sidebar">
    <a href="/menu">Inicio</a>
        <a href="/usuarios">Usuario</a>
        
        <a href="/cargos">Cargo</a>
        <a href="/ministerios">Ministerio</a>
        <a href="/eventos">Evento</a>
        <a href="/registro_evento">Registro Eventos</a>
        <a href="/tipo_relacion">Tipo Relacion</a>
        <a href="/parentescos">Parentesco</a>
    </nav>
    <div class="main-content">
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="content">
                            Bienvenido a la iglesia, gracias por formar parte de ella.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Espacio para el contenido adicional en la parte derecha -->
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer>
        <div class="container text-center">
            <p>&copy; <?php echo date("Y"); ?> VeronicaAntezana</p>
        </div>
    </footer>
</body>

</html>
