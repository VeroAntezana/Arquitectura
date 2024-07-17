<?php

declare(strict_types=1);

require_once('../app/modelos/Ministerio/MMinisterio.php');
require_once('../app/vistas/Ministerio/VMinisterio.php');

class CMinisterio
{
    private VMinisterio $vista;
    private MMinisterio $modelo;


    public function __construct()
    {
        $this->vista = new VMinisterio();
        $this->modelo = new MMinisterio();
    }

    public function listarMinisteriosC(): void
    {

        $ministerio = $this->modelo->listarMinisterios();

        $this->vista->actualizar($ministerio);
    }

    public function crearMinisterioC(string $nombre, string $descripcion): void
    {

        $this->modelo->crearMinisterio($nombre, $descripcion);

        $ministerio = $this->modelo->listarMinisterios();

        $this->vista->actualizar($ministerio);
    }

    public function eliminarMinisterioC(int $id): void
    {
        $this->modelo->eliminarMinisterio($id);

        $ministerio = $this->modelo->listarMinisterios();

        $this->vista->actualizar($ministerio);
    }

    public function updateMinisterioC(int $id): void
    {
        $ministerio = $this->modelo->buscarMinisterio($id);

        $this->vista->mostrarFormularioEdicion($ministerio);
    }

    public function editarMinisterioC(int $id, string $nombre, string $descripcion): void
    {

        $this->modelo->editarMinisterio($id, $nombre, $descripcion);

        $ministerio = $this->modelo->listarMinisterios();

        $this->vista->actualizar($ministerio);
    }
}
