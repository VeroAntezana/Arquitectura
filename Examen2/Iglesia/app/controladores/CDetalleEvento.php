<?php

declare(strict_types=1);

require_once('../app/modelos/DetalleEvento/MDetalleEvento.php');
require_once('../app/modelos/Usuario/MUsuario.php');
require_once('../app/vistas/RegistroEvento/VDetalleEvento.php');

class CDetalleEvento
{
    private VDetalleEvento $vistaDetalleEvento;
    private MUsuario $modeloUsuario;
    private MDetalleEvento $modeloDetalleEvento;

    public function __construct()
    {
        $this->vistaDetalleEvento = new VDetalleEvento();
        $this->modeloUsuario = new MUsuario();
        $this->modeloDetalleEvento = new MDetalleEvento();
    }

    // public function listarDetalleEventosC(): void
    // {
    //     $relaciones = $this->modeloDetalleEvento->listarDetalleEventos();
    //     $usuarios = $this->modeloUsuario->listarUsuarios();
    //     $this->vistaDetalleEvento->actualizar($relaciones, $usuarios);
    // }
   

    // public function agregarDetalleEventoC(int $usuario_id): void //Agrego USuario 
    // {
    //     $this->modeloDetalleEvento->agregarDetalleEvento($usuario_id);

    //     $relaciones = $this->modeloDetalleEvento->listarDetalleEventos();
    //     $usuarios = $this->modeloUsuario->listarUsuarios();
    //     $this->vistaDetalleEvento->actualizar($relaciones, $usuarios);
    // }

    // public function eliminarDetalleEventoC(int $id): void
    // {
    //     $this->modeloDetalleEvento->eliminarDetalleEvento($id);

    //     $relaciones = $this->modeloDetalleEvento->listarDetalleEventos();
    //     $usuarios = $this->modeloUsuario->listarUsuarios();
    //     $this->vistaDetalleEvento->actualizar($relaciones, $usuarios);
    // }

    
}
