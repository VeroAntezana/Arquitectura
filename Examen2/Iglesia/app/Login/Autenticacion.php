<?php
class Autenticacion {
    private InterfaceStrategia $estrategia;

    public function setEstrategia(InterfaceStrategia $estrategia): void {
        $this->estrategia = $estrategia;
    }

    public function autenticar(string $identificador, string $password): bool {
        return $this->estrategia->login($identificador, $password);
    }
}
