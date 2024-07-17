<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Descargar Certificado</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <h1>Certificado de Evento</h1>
    <p>Lugar: <?php echo $registroEvento->getLugar(); ?></p>
    <p>Fecha: <?php echo $registroEvento->getFecha(); ?></p>
    <p>Nota: <?php echo $registroEvento->getNota(); ?></p>
    <p>Participantes:</p>
    <ul>
        <?php foreach ($usuarios as $usuario): ?>
            <li><?php echo $usuario->getNombre() . ' ' . $usuario->getApellido(); ?></li>
        <?php endforeach; ?>
    </ul>

    <form action="/descargar_certificado" method="get">
        <input type="hidden" name="id" value="<?php echo $registroEvento->getId(); ?>">
        <input type="hidden" name="formato" value="pdf">
        <button type="submit" id="descargar-pdf-btn">Descargar PDF</button>
    </form>

    <form action="/descargar_certificado" method="get">
        <input type="hidden" name="id" value="<?php echo $registroEvento->getId(); ?>">
        <input type="hidden" name="formato" value="html">
        <button type="submit" id="descargar-html-btn">Descargar HTML</button>
    </form>
    <form action="/descargar_certificado" method="get">
        <input type="hidden" name="id" value="<?php echo $registroEvento->getId(); ?>">
        <input type="hidden" name="formato" value="imagen">
        <button type="submit" id="descargar-imagen-btn">Descargar Imagen</button>
    </form>
</body>
</html>
