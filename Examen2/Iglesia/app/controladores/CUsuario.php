<?php

declare(strict_types=1);

require_once('../app/modelos/Usuario/MUsuario.php');
require_once('../app/modelos/Cargo/MCargo.php');
require_once('../app/vistas/Usuario/VUsuario.php');
require_once('../app/Login/Autenticacion.php');
require_once('../app/Login/EstrategiaLoginUsuario.php');
require_once('../app/Login/EstrategiaLoginCelular.php');
class CUsuario
{
    private VUsuario $vista;
    private MUsuario $modeloUsuario;
    private MCargo $modeloCargo;
    private Autenticacion $autenticacion;

    public function __construct()
    {
        $this->vista = new VUsuario();
        $this->modeloUsuario = new MUsuario();
        $this->modeloCargo = new MCargo(); 
        $this->autenticacion = new Autenticacion();
     
    }
    

    public function listarUsuariosC(): void
    {
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $cargos = $this->modeloCargo->listarCargos();
        /* var_dump($cargos); */
        $this->vista->actualizar($usuarios, $cargos);
    }
    //LOGIN Patron Strategy
    public function login(string $identificador, string $password): void {
        
        if ($this->LoginUsuario($identificador, $password) || $this->LoginCelular($identificador, $password)) {
            
            header('Location: /menu');
            exit();
        } else {
           
            echo "Error: Credenciales inválidas.";
        }
      
    }
    public function IniciarSesion(): void
    {
        $this->vista->login();
    }

    
    public function LoginUsuario(string $correo, string $password): bool
    {
        $this->autenticacion->setEstrategia(new EstrategiaLoginUsuario($this->modeloUsuario));
        return $this->autenticacion->autenticar($correo, $password);
    }
    public function LoginCelular(string $celular, string $password): bool{

        $this->autenticacion->setEstrategia(new EstrategiaLoginCelular($this->modeloUsuario));
        return $this->autenticacion->autenticar($celular, $password);
    }
    //////////////////////

    public function agregarUsuarioC(string $nombre, string $apellido, string $fechanacimiento, string $ci, int $telefono, int $cargo_id): void
    {
        $this->modeloUsuario->agregarUsuario($nombre, $apellido, $fechanacimiento, $ci, $telefono, $cargo_id);
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $cargos = $this->modeloCargo->listarCargos();
        $this->vista->actualizar($usuarios, $cargos);
    }

    public function eliminarUsuarioC(int $id): void
    {
        $this->modeloUsuario->eliminarUsuario($id);
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $cargos = $this->modeloCargo->listarCargos();
        $this->vista->actualizar($usuarios, $cargos);
    }

    public function editarUsuarioC(int $id, string $nombre, string $apellido, string $fechanacimiento, string $ci, int $telefono, int $cargo_id): void
    {
        $this->modeloUsuario->editarUsuario($id, $nombre, $apellido, $fechanacimiento, $ci, $telefono,$cargo_id);
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $cargos = $this->modeloCargo->listarCargos();
        $this->vista->actualizar($usuarios, $cargos);
    }

    public function updateUsuarioC(int $id): void
    {
        $usuario = $this->modeloUsuario->buscarUsuario($id);
        $cargos = $this->modeloCargo->listarCargos();
        $this->vista->mostrarFormularioEdicion($usuario, $cargos);
    }
}
