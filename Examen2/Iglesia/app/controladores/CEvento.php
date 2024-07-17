<?php

declare(strict_types=1);

require_once('../app/modelos/Evento/MEvento.php');
require_once('../app/vistas/Evento/VEvento.php');

class CEvento
{
    private VEvento $vista;
    private MEvento $modelo;


    public function __construct()
    {
        $this->vista = new VEvento();
        $this->modelo = new MEvento();
    }

    public function listarEventosC(): void
    {

        $tipo_relaciones = $this->modelo->listarEventos();

        $this->vista->actualizar($tipo_relaciones);
    }

    public function crearEventoC(string $nombre, string $descripcion): void
    {

        $this->modelo->crearEvento($nombre, $descripcion);

        $tipo_relaciones = $this->modelo->listarEventos();

        $this->vista->actualizar($tipo_relaciones);
    }

    public function eliminarEventoC(int $id): void
    {
        $this->modelo->eliminarEvento($id);

        $tipo_relaciones = $this->modelo->listarEventos();

        $this->vista->actualizar($tipo_relaciones);
    }

    public function updateEventoC(int $id): void
    {
        $tipo_relacion = $this->modelo->buscarEvento($id);

        $this->vista->mostrarFormularioEdicion($tipo_relacion);
    }

    public function editarEventoC(int $id, string $nombre, string $descripcion): void
    {

        $this->modelo->editarEvento($id, $nombre, $descripcion);

        $tipo_relaciones = $this->modelo->listarEventos();

        $this->vista->actualizar($tipo_relaciones);
    }
}
