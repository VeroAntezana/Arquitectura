<?php
require_once('../app/Login/InterfaceStrategia.php');
class EstrategiaLoginCelular implements InterfaceStrategia {
    private MUsuario $modeloUsuario;

    public function __construct(MUsuario $modeloUsuario) {
        $this->modeloUsuario = $modeloUsuario;
    }

    public function login(string $celular, string $password): bool {
        $usuario = $this->modeloUsuario->buscarUsuarioPorCelular($celular);

        return $usuario !== null;
    }
}

