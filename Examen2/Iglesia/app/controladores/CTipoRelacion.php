<?php

declare(strict_types=1);

require_once('../app/modelos/TipoRelacion/MTipoRelacion.php');
require_once('../app/vistas/TipoRelacion/VTipoRelacion.php');

class CTipoRelacion
{
    private VTipoRelacion $vista;
    private MTIpoRelacion $modelo;


    public function __construct()
    {
        $this->vista = new VTipoRelacion();
        $this->modelo = new MTipoRelacion();
    }

    public function listarTipoRelacionC(): void
    {

        $tipo_relaciones = $this->modelo->listarTipos();

        $this->vista->actualizar($tipo_relaciones);
    }

    public function crearTipoRelacionC(string $nombre): void
    {

        $this->modelo->crearTipos($nombre);

        $tipo_relaciones = $this->modelo->listarTipos();

        $this->vista->actualizar($tipo_relaciones);
    }

    public function eliminarTipoRelacionC(int $id): void
    {
        $this->modelo->eliminarTipo($id);
        $tipo_relaciones = $this->modelo->listarTipos();
        $this->vista->actualizar($tipo_relaciones);
    }

    public function updateTipoRelacionC(int $id): void
    {
        $tipo_relacion = $this->modelo->buscarTipo($id);
        $this->vista->mostrarFormularioEdicion($tipo_relacion);
    }

    public function editarTipoRelacionC(int $id, string $nombre): void
    {

        $this->modelo->editarTipo($id, $nombre);

        $tipo_relaciones = $this->modelo->listarTipos();

        $this->vista->actualizar($tipo_relaciones);
    }
}
