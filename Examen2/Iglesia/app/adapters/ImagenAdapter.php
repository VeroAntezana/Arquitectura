<?php
require_once('../app/adapters/CertificadoTarget.php');
require_once('../app/modelos/Certificado/ImagenAdaptee.php');
require_once('../app/modelos/RegistroEvento/RegistroEvento.php');
require_once('../app/modelos/Usuario/Usuario.php');
class ImagenAdapter extends CertificadoTarget {
    private ImagenAdaptee $imagenAdaptee;
    public function __construct() {
        $this->imagenAdaptee = new ImagenAdaptee();
    }
    public function download(RegistroEvento $registroEvento, string $nombreEvento,array $usuarios): void {
        $this->imagenAdaptee->convertirYdescargar($registroEvento,$nombreEvento, $usuarios);
    }
}