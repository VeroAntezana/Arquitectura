<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iglesia App</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>Iglesia</h1>
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
    <main>
    <div class="container">
            <h2>Nuevo Ministerio</h2>
        </div>
        <div class="container">
                <div id='form_ministerio'>
                    <form action="/ministerios" method="post">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="nombre">Nombre</label>
                                <input name="nombre" type="text" id="nombre" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="descripcion">Descripción</label>
                                <input name="descripcion" type="text" id="descripcion" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <button class="add-button" type="submit">Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>

        </div>

        <h1><?= $title ?></h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th> <!-- Cambiado a Nombre -->
                    <th>Descripción</th> <!-- Agregado campo de descripción -->
                </tr>
            </thead>
            <?= $tbody ?>
        </table>
        </div>
    </main>
    
    <footer>
        <div class="container text-center">
            <p>&copy; <?php echo date("Y"); ?> VeronicaAntezana</p>
        </div>
    </footer>
    <script>
        function confirmarEliminar(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este ministerio?')) {
                // Si el usuario confirma, enviar el formulario de eliminación
                document.querySelector('form[action="/eliminar_ministerio"] input[name="id"]').value = id;
                document.querySelector('form[action="/eliminar_ministerio"]').submit();
            }
        }
    </script>
</body>

</html>