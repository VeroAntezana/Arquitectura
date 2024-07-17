<?php

class HTMLAdaptee {
    public function convertirYDescargar(RegistroEvento $registroEvento,string $nombreEvento, array $usuarios): void {
        $eventoId = $registroEvento->getEventoId();
        $evento = (new MEvento())->buscarEvento($eventoId);
        $html = "<html><body>";
        $html .= "<h1>Certificado de $nombreEvento</h1>";
        $html .= "<p>Lugar: {$registroEvento->getLugar()}</p>";
        $html .= "<p>Fecha: {$registroEvento->getFecha()}</p>";
        $html .= "<p>Nota: {$registroEvento->getNota()}</p>";
        $html .= "<p>Participantes:</p><ul>";

        foreach ($usuarios as $usuario) {
            $html .= "<li>{$usuario->getNombre()} {$usuario->getApellido()}</li>";
        }

        $html .= "</ul></body></html>";

        header('Content-Type: application/html');
        header('Content-Disposition: attachment; filename="certificado.html"');
        echo $html;
    }
}
