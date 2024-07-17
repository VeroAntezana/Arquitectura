<?php

declare(strict_types=1);

require_once('../app/modelos/Cargo/MCargo.php');
require_once('../app/modelos/Ministerio/MMinisterio.php');
require_once('../app/vistas/Cargo/VCargo.php');

class CCargo
{
    private VCargo $vista;
    private MCargo $modelo;
    private MMinisterio $modeloMinisterio;


    public function __construct()
    {
        $this->vista = new VCargo();
        $this->modelo = new MCargo();
        $this->modeloMinisterio = new MMinisterio(); 
    }

    public function listarCargosC(): void
    {

        $cargos = $this->modelo->listarCargos();
        $ministerios = $this->modeloMinisterio->listarMinisterios();
        $this->vista->actualizar($cargos,$ministerios);
    }

    public function crearCargoC(string $nombre, string $descripcion, int $ministerio_id): void
    {

        $this->modelo->crearCargo($nombre, $descripcion, $ministerio_id);
        $cargos = $this->modelo->listarCargos();
        $ministerios = $this->modeloMinisterio->listarMinisterios();
        $this->vista->actualizar($cargos, $ministerios);
    }

    public function eliminarCargoC(int $id): void
    {
        $this->modelo->eliminarCargo($id);
        $cargos = $this->modelo->listarCargos();
        $ministerios = $this->modeloMinisterio->listarMinisterios();
        $this->vista->actualizar($cargos, $ministerios);
    }

    public function updateCargoC(int $id): void
    {
        $cargos = $this->modelo->buscarCargo($id);
        $ministerios = $this->modeloMinisterio->listarMinisterios();
        $this->vista->mostrarFormularioEdicion($cargos,$ministerios);
    }

    public function editarCargoC(int $id, string $nombre, string $descripcion, int $ministerio_id): void
    {
        $this->modelo->editarCargo($id, $nombre, $descripcion, $ministerio_id);
        $cargos = $this->modelo->listarCargos();
        $ministerios = $this->modeloMinisterio->listarMinisterios();
        $this->vista->actualizar($cargos, $ministerios);
    }
}
