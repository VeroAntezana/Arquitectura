<?php

declare(strict_types=1);

class VEvento
{
    private function renderizarTabla(array $eventos): string
    {
        $rowData = '';

        if (empty($eventos)) {
            return "<tbody></tbody>";
        }

        foreach ((array)$eventos as $evento) {
            $rowData .= "<tr>";
            $rowData .= "<td>{$evento->getId()}</td>";
            $rowData .= "<td>{$evento->getNombre()}</td>";
            $rowData .= "<td>{$evento->getDescripcion()}</td>";
            $rowData .= "<td><a href='/editar_evento?id={$evento->getId()}' class='edit-button'>Editar</a></td>";
            $rowData .= "<td>";
            $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_evento'>";
            $rowData .= "<input type='hidden' name='id' value='{$evento->getId()}'>";
            $rowData .= "<button type='button' onclick='confirmarEliminar({$evento->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
            $rowData .= "</form>";
            $rowData .= "</td>";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    public function actualizar(array $eventos): void
    {
        $title = 'Tipos de Eventos';
        $tbody = $this->renderizarTabla($eventos);
        include '../app/vistas/Evento/index.php';
    }

    private function renderizarFormularioEdicion(Evento $evento): string
    {
        $formulario = '';

        if (!empty($evento) && $evento instanceof Evento) {
            $formulario .= "<form method='post' action='/actualizar_evento'>";
            $formulario .= "<input type='hidden' name='id' value='{$evento->getId()}'>";
            $formulario .= "<div class='container-fluid'>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='nombre'>Nombres:</label>";
            $formulario .= "<input type='text' id='nombre' name='nombre' value='{$evento->getNombre()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='descripcion'>Descripción:</label>";
            $formulario .= "<input type='text' id='descripcion' name='descripcion' value='{$evento->getDescripcion()}' required>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<div class='row mt-3'>";
            $formulario .= "<div class='col-12 d-flex justify-content-end'>";
            $formulario .= "<button class='add-button' type='submit'>Actualizar</button>";
            $formulario .= "<a href='/eventos' class='back-button'>Volver</a>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "</form>";
        } else {
            $formulario .= "El evento no se encontró o no existe.";
        }

        return $formulario;
    }

    public function mostrarFormularioEdicion(Evento $evento): void
    {
        $title = 'Evento - Editar';
        $formulario = $this->renderizarFormularioEdicion($evento);
        include '../app/vistas/Evento/edit.php';
    }
}

