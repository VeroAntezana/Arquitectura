<?php
require_once('../app/adapters/CertificadoTarget.php');
require_once('../app/modelos/Certificado/HTMLAdaptee.php');
require_once('../app/modelos/RegistroEvento/RegistroEvento.php');
require_once('../app/modelos/Usuario/Usuario.php');
class HTMLAdapter extends CertificadoTarget {
    private HTMLAdaptee $HTMLAdaptee;
    public function __construct() {
        $this->HTMLAdaptee = new HTMLAdaptee();
    }
    public function download(RegistroEvento $registroEvento, string $nombreEvento, array $usuarios): void {
        $this->HTMLAdaptee->convertirYdescargar($registroEvento,$nombreEvento,$usuarios);
    }
}