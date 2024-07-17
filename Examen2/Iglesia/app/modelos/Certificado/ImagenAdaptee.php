<?php
require_once('../app/modelos/RegistroEvento/MRegistroEvento.php');
require_once('../app/modelos/Usuario/MUsuario.php');

class ImagenAdaptee {
    public function convertirYdescargar(RegistroEvento $registroEvento, string $nombreEvento,array $usuarios): void {
        // Crear la imagen
        $width = 800;
        $height = 600;
        $image = imagecreatetruecolor($width, $height);
        if (!$image) {
            die('Error: No se pudo crear la imagen.');
        }

        // Colores
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        if ($white === false || $black === false) {
            imagedestroy($image);
            die('Error: No se pudieron asignar los colores.');
        }

        // Rellenar la imagen con blanco
        if (!imagefilledrectangle($image, 0, 0, $width, $height, $white)) {
            imagedestroy($image);
            die('Error: No se pudo rellenar la imagen con blanco.');
        }

        // Ruta a la fuente TTF
        $fontPath = 'C:/xampp/htdocs/Iglesia/public/fonts/DejaVuSans.ttf';
        if (!file_exists($fontPath)) {
            imagedestroy($image);
            die('Error: No se encontró la fuente en ' . $fontPath);
        }

        // Contenido
        $fontSize = 10; // Tamaño de la fuente
        $y = 50; // Posición vertical inicial

        // Escribir el texto en la imagen
        imagettftext($image, $fontSize, 0, 50, $y, $black, $fontPath, 'Certificado de '.$nombreEvento);
        $y += 30;
        imagettftext($image, $fontSize, 0, 50, $y, $black, $fontPath, 'Lugar: ' . $registroEvento->getLugar());
        $y += 30;
        imagettftext($image, $fontSize, 0, 50, $y, $black, $fontPath, 'Fecha: ' . $registroEvento->getFecha());
        $y += 30;
        imagettftext($image, $fontSize, 0, 50, $y, $black, $fontPath, 'Nota: ' . $registroEvento->getNota());
        $y += 30;
        imagettftext($image, $fontSize, 0, 50, $y, $black, $fontPath, 'Participantes:');
        $y += 30;

        foreach ($usuarios as $usuario) {
            imagettftext($image, $fontSize, 0, 50, $y, $black, $fontPath, $usuario->getNombre() . ' ' . $usuario->getApellido());
            $y += 30;
        }

        // Salida de la imagen
        ob_clean();
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename="certificado.png"');
        if (!imagepng($image)) {
            imagedestroy($image);
            die('Error: No se pudo generar la imagen PNG.');
        }
        imagedestroy($image);
    }
}
?>
