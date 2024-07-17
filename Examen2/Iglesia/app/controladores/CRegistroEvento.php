<?php

require_once('../app/modelos/RegistroEvento/MRegistroEvento.php');
require_once('../app/modelos/Evento/MEvento.php');
require_once('../app/modelos/Usuario/MUsuario.php');
require_once('../app/modelos/DetalleEvento/MDetalleEvento.php');
require_once('../app/vistas/RegistroEvento/VRegistroEvento.php');

class CRegistroEvento
{
    private VRegistroEvento $vista;
    private MRegistroEvento $modelo;
    private MEvento $modeloEvento;
    private MDetalleEvento $modeloDetalleEvento;
    private MUsuario $modeloUsuario;

    public function __construct()
    {
        $this->vista = new VRegistroEvento();
        $this->modelo = new MRegistroEvento();
        $this->modeloEvento = new MEvento();
        $this->modeloDetalleEvento = new MDetalleEvento();
        $this->modeloUsuario = new MUsuario();
    }

    public function listarRegistroEventosC(): void
    {
        $cargos = $this->modelo->listarRegistroEventos();
        $eventos = $this->modeloEvento->listarEventos();
        $this->vista->actualizar($cargos, $eventos);
    }

    public function crearRegistroEventoC(string $lugar, string $nota, string $fecha, int $evento_id): void
    {
        $this->modelo->crearRegistroEvento($lugar, $nota, $fecha, $evento_id);
        $cargos = $this->modelo->listarRegistroEventos();
        $eventos = $this->modeloEvento->listarEventos();
        $this->vista->actualizar($cargos, $eventos);
    }

    public function eliminarRegistroEventoC(int $id): void
    {
        $this->modelo->eliminarRegistroEvento($id);
        $cargos = $this->modelo->listarRegistroEventos();
        $eventos = $this->modeloEvento->listarEventos();
        $this->vista->actualizar($cargos, $eventos);
    }

    public function updateRegistroEventoC(int $id): void
    {
        $registroEvento = $this->modelo->buscarRegistroEvento($id);
        $eventos = $this->modeloEvento->listarEventos();
        $this->vista->mostrarFormularioEdicion($registroEvento, $eventos);
    }

    public function editarRegistroEventoC(int $id, string $lugar, string $nota, string $fecha, int $evento_id): void
    {
        $this->modelo->editarRegistroEvento($id, $lugar, $nota, $fecha, $evento_id);
        $cargos = $this->modelo->listarRegistroEventos();
        $eventos = $this->modeloEvento->listarEventos();
        $this->vista->actualizar($cargos, $eventos);
    }

    public function agregarUsuario(int $registroEventoId): void
    {
        $usuarios = $this->modeloUsuario->listarUsuarios();
        $this->vista->mostrarFormularioAgregarUsuario($registroEventoId, $usuarios);
    }

    public function guardarUsuarioDetalleEvento(int $registroEventoId, int $usuarioId): void
    {
        $this->modeloDetalleEvento->crearDetalleEvento($registroEventoId, $usuarioId);
        $this->verUsuariosDetalleEvento($registroEventoId);
    }

    public function verUsuariosDetalleEvento(int $registroEventoId): void
    {
        $detallesEventos = $this->modeloDetalleEvento->listarDetalleEvento($registroEventoId);
        $usuarios = [];
        foreach ($detallesEventos as $detalleEvento) {
            $usuario = $this->modeloUsuario->buscarUsuario($detalleEvento->getUsuarioId());
            if ($usuario) {
                $usuarios[] = $usuario;
            }
        }
        $this->vista->mostrarUsuariosEvento($detallesEventos, $usuarios, $registroEventoId);
    }

    public function mostrarFormularioCertificado(int $registroEventoId, string $formato): void
    {
        $registroEvento = $this->modelo->buscarRegistroEvento($registroEventoId);
        $detallesEventos = $this->modeloDetalleEvento->listarDetalleEvento($registroEventoId);
        $usuarios = [];
        foreach ($detallesEventos as $detalleEvento) {
            $usuario = $this->modeloUsuario->buscarUsuario($detalleEvento->getUsuarioId());
            if ($usuario) {
                $usuarios[] = $usuario;
            }
        }
        $this->vista->mostrarFormularioCertificado($registroEvento, $usuarios, $formato);
    }

    public function downloadCertificado(int $registroEventoId, string $formato): void
    {
        $registroEvento = $this->modelo->buscarRegistroEvento($registroEventoId);
        $detallesEventos = $this->modeloDetalleEvento->listarDetalleEvento($registroEventoId);
        $usuarios = [];
        foreach ($detallesEventos as $detalleEvento) {
            $usuario = $this->modeloUsuario->buscarUsuario($detalleEvento->getUsuarioId());
            if ($usuario) {
                $usuarios[] = $usuario;
            }
        }
        $evento = $this->modeloEvento->buscarEvento($registroEvento->getEventoId());
        $nombreEvento = $evento ? $evento->getNombre() : 'Evento Desconocido';
        $this->modelo->generarCertificado($registroEvento, $nombreEvento, $usuarios, $formato);
    }
}
