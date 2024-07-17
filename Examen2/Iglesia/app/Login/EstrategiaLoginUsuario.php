<?php
require_once('../app/Login/InterfaceStrategia.php');
class EstrategiaLoginUsuario implements InterfaceStrategia {
    private MUsuario $modeloUsuario;
    
    public function __construct(MUsuario $modeloUsuario) {
        $this->modeloUsuario = $modeloUsuario;
    }
    public function login(string $user, string $password): bool {
        $usuario = $this->modeloUsuario->buscarUsuarioPorNombre($user);

        return $usuario !== null;
    }
}
