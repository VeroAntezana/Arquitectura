<?php
header('Content-Type: image/png');

// Crear una imagen en blanco de 200x200 píxeles
$width = 200;
$height = 200;
$image = imagecreatetruecolor($width, $height);

// Asignar el color blanco
$white = imagecolorallocate($image, 255, 255, 255);

// Rellenar la imagen con el color blanco
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Guardar la imagen como un archivo PNG
imagepng($image);

// Liberar memoria
imagedestroy($image);
?>
