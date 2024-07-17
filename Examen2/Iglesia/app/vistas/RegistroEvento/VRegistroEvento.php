<?php

declare(strict_types=1);

class VRegistroEvento
{
    private function renderizarTabla($registroeventos, array $eventos): string
    {
        $rowData = '';
        
        if (empty($registroeventos)) {
            return "<tbody></tbody>";
        }

        foreach ((array)$registroeventos as $registroevento) {
            $rowData .= "<tr>";
            $rowData .= "<td>{$registroevento->getId()}</td>";
            $rowData .= "<td>{$registroevento->getLugar()}</td>";
            $rowData .= "<td>{$registroevento->getNota()}</td>";
            $rowData .= "<td>{$registroevento->getFecha()}</td>";
         
            // Busca el nombre del evento basado en el ID del evento
            $nombreEvento = "";
            foreach ($eventos as $evento) {
                if ($evento->getId() == $registroevento->getEventoId()) {
                    $rowData .= "<td>{$evento->getNombre()}</td>";
                    break;
                }
            }
            
            $rowData .= "<td><a href='/agregar_usuario?id={$registroevento->getId()}}' class='agregarUsuario-button'>Agregar Usuario</a></td>";
            $rowData .= "<td><a href='/ver_usuarios?id={$registroevento->getId()}' class='verUsuario-button'>Ver Usuarios</a></td>";
            $rowData .= "<td>
                 <a href='/ver_certificado?id={$registroevento->getId()}&formato=pdf&accion=mostrar' class='imprimir-button'> Certificado</a>
               
            </td>";
            $rowData .= "<td><a href='/editar_registro_evento?id={$registroevento->getId()}' class='edit-button'>Editar</a></td>";
            $rowData .= "<td>";
            $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_registro_evento'>";
            $rowData .= "<input type='hidden' name='id' value='{$registroevento->getId()}'>";
            $rowData .= "<button type='button' onclick='confirmarEliminar({$registroevento->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
            
            $rowData .= "</form>";
            $rowData .= "</td>";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    public function renderizarFormularioCrear($eventos): string
    {
        $nuevoCargoForm = '
        <div class="container">
        <h2>Nuevo Registro Evento </h2>
    </div>
    <div class="container">
        <div id="form_cargo">
            <form action="/registro_evento" method="post">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="lugar">Lugar</label>
                        <input name="lugar" type="text" id="lugar" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="nota">Nota</label>
                        <input name="nota" type="text" id="nota" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="fecha">Fecha</label>
                        <input name="fecha" type="date" id="fecha" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="evento">Evento</label>
                        <select name="evento" id="evento" >';

                        foreach ($eventos as $evento) {
                            $nuevoCargoForm .= "<option value='{$evento->getId()}'>{$evento->getNombre()}</option>";
                        }

        $nuevoCargoForm .= '
                        </select>
                    </div>
                </div>
                <br>
                <div class="row mt-3">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="add-button" type="submit">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    ';

        return $nuevoCargoForm;
    }

    public function actualizar($registroeventos, $eventos): void
    {
        $title = 'Registro Eventos';
        $tbody = $this->renderizarTabla($registroeventos, $eventos);
        $formulario = $this->renderizarFormularioCrear($eventos);
        include '../app/vistas/RegistroEvento/index.php';
    }


    private function renderizarFormularioEdicion($registroevento, $eventos): string
    {
        $formulario = '';

        if (!empty($registroevento)) {
            $formulario .= "<form method='post' action='/actualizar_registro_evento'>";
            $formulario .= "<input type='hidden' name='id' value='{$registroevento->getId()}'>";
            $formulario .= "<div class='container-fluid'>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='lugar'>Lugar:</label>";
            $formulario .= "<input type='text' id='lugar' name='lugar' value='{$registroevento->getLugar()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='nota'>Nota:</label>";
            $formulario .= "<input type='text' id='nota' name='nota' value='{$registroevento->getNota()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='fecha'>Fecha:</label>";
            $formulario .= "<input type='date' id='fecha' name='fecha' value='{$registroevento->getFecha()}' required>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='evento'>Evento:</label>";
            $formulario .= "<select name='evento' id='evento' required>";

            foreach ($eventos as $evento) {
                $selected = $evento->getId() === $registroevento->getEventoId() ? 'selected' : '';
                $formulario .= "<option value='{$evento->getId()}' {$selected}>{$evento->getNombre()}</option>";
            }

            $formulario .= "</select>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<br>";
            $formulario .= "<div class='row mt-3'>";
            $formulario .= "<div class='col-12 d-flex justify-content-end'>";
            $formulario .= "<button class='add-button' type='submit'>Actualizar</button>";
            $formulario .= "<a href='/menu' class='back-button'>Volver</a>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "</form>";
        } else {
            $formulario .= "El cargo no se encontró o no existe.";
        }

        return $formulario;
    }
    public function mostrarFormularioAgregarUsuario(int $registroEventoId, array $usuarios): void
    {
        $opcionesUsuarios = '';
        foreach ($usuarios as $usuario) {
            $opcionesUsuarios .= "<option value='{$usuario->getId()}'>{$usuario->getNombre()} {$usuario->getApellido()}</option>";
        }

        $formulario = "
        <div class='container'>
            <h2>Agregar Usuario al Evento</h2>
        </div>
        <div class='container'>
            <div id='form_usuario'>
                <form method='post' action='/guardar_usuario_detalle_evento'>
                    <input type='hidden' name='registro_evento_id' value='{$registroEventoId}'>
                    <div class='row'>
                        <div class='col-12 col-md-4'>
                            <label for='usuario_id'>Seleccionar Usuario:</label>
                            <select id='usuario_id' name='usuario_id' required>
                                $opcionesUsuarios
                            </select>
                        </div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col-12 d-flex justify-content-end'>
                            <button class='add-button' type='submit'>Agregar Usuario</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        ";

        include '../app/vistas/RegistroEvento/agregar_usuario.php';
    }

    public function mostrarUsuariosEvento(array $detallesEventos, array $usuarios, int $registroEventoId): void
{
    $title = 'Usuarios en el Evento';
    $tbody = '';
    

    foreach ($detallesEventos as $detalleEvento) {
        $usuario = $this->buscarUsuario($usuarios, $detalleEvento->getUsuarioId());
        if ($usuario) {
            $tbody .= "<tr>";
           // $tbody .= "<td>{$detalleEvento->getId()}</td>";
            $tbody .= "<td>{$usuario->getNombre()}</td>";
            $tbody .= "<td>{$usuario->getApellido()}</td>";
            $tbody .= "<td><form method='post' action='/eliminar_usuario_detalle_evento'>";
            $tbody .= "<input type='hidden' name='detalle_evento_id' value='{$detalleEvento->getId()}'>";
            $tbody .= "<input type='hidden' name='registro_evento_id' value='{$registroEventoId}'>";
            $tbody .= "<button type='submit' class='delete-button'>Eliminar</button>";
            $tbody .= "</form></td>";
            $tbody .= "</tr>";
        } else {
            error_log("Usuario no encontrado para usuario_id = {$detalleEvento->getUsuarioId()}");
        }
    }

    include '../app/vistas/RegistroEvento/ver_usuarios.php';
}


    public function mostrarFormularioEdicion($registroevento, $eventos): void
    {
        $title = 'Registro - Editar';
        $formulario = $this->renderizarFormularioEdicion($registroevento, $eventos);
        include '../app/vistas/RegistroEvento/edit.php';
    }
    private function buscarUsuario(array $usuarios, int $usuarioId): ?Usuario
    {
        foreach ($usuarios as $usuario) {
           
            if ((int)$usuario->getId() === $usuarioId) {
                return $usuario;
            }
        }
        return null;
    }
    public function mostrarFormularioCertificado($registroEvento, $usuarios, $formato): void {
        include '../app/vistas/RegistroEvento/VDescargarFormulario.php';
    }
    
}
