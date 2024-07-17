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
            <h1>Iglesia App</h1>
        </div>
    </header>
    
    <main>
        <div class="container">
            <h2><?= $title ?></h2>


            <!-- Muestra el formulario de edición aquí -->
            <?= $formulario ?>

            <!-- Más contenido HTML si es necesario -->
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Veronica Antezana</p>
        </div>
    </footer>
    <script>
        function confirmarEliminar(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este Ministerio?')) {
                // Si el usuario confirma, enviar el formulario de eliminación
                document.querySelector('form[action="/eliminar_ministerio"] input[name="id"]').value = id;
                document.querySelector('form[action="/eliminar_ministerio"]').submit();
            }
        }
    </script>
</body>

</html>