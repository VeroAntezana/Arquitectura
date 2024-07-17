<?php
abstract class CertificadoTarget {
    abstract public function download(RegistroEvento $registroEvento, string $nombreEvento, array $usuarios): void;
}
