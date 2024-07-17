<?php
require_once('../app/adapters/CertificadoTarget.php');
require_once('../app/modelos/Certificado/PDFAdaptee.php');
require_once('../app/modelos/RegistroEvento/RegistroEvento.php');
require_once('../app/modelos/Usuario/Usuario.php');
require_once('../vendor/autoload.php');

class PDFAdapter extends CertificadoTarget {
    private PDFAdaptee $PDFAdaptee;
    public function __construct() {
        $this->PDFAdaptee = new PDFAdaptee();
    }
    public function download(RegistroEvento $registroEvento, string $nombreEvento,array $usuarios): void {
        $this->convertirYdescargar($registroEvento,$nombreEvento, $usuarios);
    }
    public function convertirYDescargar(RegistroEvento $registroEvento, string $nombreEvento,array $usuarios): void {
        ob_clean();

        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Write(0, "Certificado de {$nombreEvento}\n");
        $pdf->Write(0, "Lugar: {$registroEvento->getLugar()}\n");
        $pdf->Write(0, "Fecha: {$registroEvento->getFecha()}\n");
        $pdf->Write(0, "Nota: {$registroEvento->getNota()}\n");
        $pdf->Write(0, "Participantes:\n");

        foreach ($usuarios as $usuario) {
            $pdf->Write(0, "{$usuario->getNombre()} {$usuario->getApellido()}\n");
        }

        $pdf->Output('certificado.pdf', 'D'); // D para descarga
    }
}