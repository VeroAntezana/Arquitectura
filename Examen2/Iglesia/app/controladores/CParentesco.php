<?php

declare(strict_types=1);

require_once('../app/modelos/Parentesco/MParentesco.php');
require_once('../app/modelos/Usuario/MUsuario.php');
require_once('../app/modelos/TipoRelacion/MTipoRelacion.php');
require_once('../app/vistas/Parentesco/VParentesco.php');

class CParentesco
{
    private VParentesco $vistaParentesco;
    private MTIpoRelacion $modeloTipoRelacion;
    private MUsuario $modeloUsuario;
    private MParentesco $modeloParentesco;

    public function __construct()
    {
        $this->vistaParentesco = new VParentesco();
        $this->modeloTipoRelacion = new MTipoRelacion();
        $this->modeloUsuario = new MUsuario();
        $this->modeloParentesco = new MParentesco();
    }

    public function listarParentescosC(): void
    {
        $relaciones = $this->modeloParentesco->listarParentescos();
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->listarTipos();
        $this->vistaParentesco->actualizar($relaciones, $usuarios, $tiposRelaciones);
    }

    public function agregarParentescoC(int $usuarioA, int $usuarioB, int $tipoRelacionA): void
    {
        $this->modeloParentesco->agregarParentesco($usuarioA, $usuarioB, $tipoRelacionA);

        $relaciones = $this->modeloParentesco->listarParentescos();
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->listarTipos();
        $this->vistaParentesco->actualizar($relaciones, $usuarios, $tiposRelaciones);
    }

    public function eliminarRelacionC(int $id): void
    {
        $this->modeloParentesco->eliminarParentesco($id);

        $relaciones = $this->modeloParentesco->listarParentescos();
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->listarTipos();
        $this->vistaParentesco->actualizar($relaciones, $usuarios, $tiposRelaciones);
    }

    public function editarRelacionC(int $id, int $usuarioA, int $usuarioB, int $tipoRelacionA): void
    {
        $this->modeloParentesco->editarParentesco($id, $usuarioA, $usuarioB, $tipoRelacionA);

        $relaciones = $this->modeloParentesco->listarParentescos();
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->listarTipos();
        $this->vistaParentesco->actualizar($relaciones, $usuarios, $tiposRelaciones);
    }

    public function updateRelacionC(int $id): void
    {
        $relacion = $this->modeloParentesco->buscarParentesco($id);
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->listarTipos();
        $this->vistaParentesco->mostrarFormularioEdicion($relacion, $usuarios, $tiposRelaciones);
    }
}
