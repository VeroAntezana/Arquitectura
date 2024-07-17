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
<nav class="sidebar">
        <a href="/menu">Inicio</a>
        <a href="/usuarios">Usuario</a>
        <a href="/cargos">Cargo</a>
        <a href="/ministerios">Ministerio</a>
        <a href="/eventos">Evento</a>
        <a href="/eventos">Registro Eventos</a>
        <a href="/tipo_relacion">Tipo Relacion</a>
        <a href="/parentescos">Parentesco</a>
    </nav>
<body>
    <header>
        <div class="container">
            <h1>Iglesia </h1>
        </div>
    </header>
    <nav>
        <div class="container">
            
        </div>
    </nav>
    <main>
        <?= $formulario ?>
        <h1><?= $title ?></h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha Nacimiento</th>
                    <th>CI</th>
                    <th>Telefono</th>
                    <th>Cargo</th>
                </tr>
            </thead>
            <?= $tbody ?>
        </table>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> VeronicaAntezana</p>
        </div>
    </footer>
    <script>
        function confirmarEliminar(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                // Si el usuario confirma, enviar el formulario de eliminación
                document.querySelector('form[action="/eliminar_usuario"] input[name="id"]').value = id;
                document.querySelector('form[action="/eliminar_usuario"]').submit();
            }
        }
    </script>
</body>

</html>