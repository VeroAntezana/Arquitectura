<?php

declare(strict_types=1);

class VMinisterio
{
    private function renderizarTabla(array $ministerios): string
    {
        $rowData = '';

        if (empty($ministerios)) {
            return "<tbody></tbody>";
        }

        foreach ((array)$ministerios as $ministerio) {
            $rowData .= "<tr>";
            $rowData .= "<td>{$ministerio->getId()}</td>";
            $rowData .= "<td>{$ministerio->getNombre()}</td>";
            $rowData .= "<td>{$ministerio->getDescripcion()}</td>";
            $rowData .= "<td><a href='/editar_ministerio?id={$ministerio->getId()}' class='edit-button'>Editar</a></td>";
            $rowData .= "<td>";
            $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_ministerio'>";
            $rowData .= "<input type='hidden' name='id' value='{$ministerio->getId()}'>";
            $rowData .= "<button type='button' onclick='confirmarEliminar({$ministerio->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
            $rowData .= "</form>";
            $rowData .= "</td>";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    public function actualizar(array $ministerios): void
    {
        $title = 'Ministerios';
        $tbody = $this->renderizarTabla($ministerios);
        include '../app/vistas/Ministerio/index.php';
    }

    private function renderizarFormularioEdicion(Ministerio $ministerio): string
    {
        $formulario = '';

        if (!empty($ministerio) && $ministerio instanceof Ministerio) {
            $formulario .= "<form method='post' action='/actualizar_ministerio'>";
            $formulario .= "<input type='hidden' name='id' value='{$ministerio->getId()}'>";
            $formulario .= "<div class='container-fluid'>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='nombre'>Nombres:</label>";
            $formulario .= "<input type='text' id='nombre' name='nombre' value='{$ministerio->getNombre()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='descripcion'>Descripción:</label>";
            $formulario .= "<input type='text' id='descripcion' name='descripcion' value='{$ministerio->getDescripcion()}' required>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<div class='row mt-3'>";
            $formulario .= "<div class='col-12 d-flex justify-content-end'>";
            $formulario .= "<button class='add-button' type='submit'>Actualizar</button>";
            $formulario .= "<a href='/ministerios' class='back-button'>Volver</a>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "</form>";
        } else {
            $formulario .= "El Ministerio no se encontró o no existe.";
        }

        return $formulario;
    }

    public function mostrarFormularioEdicion(Ministerio $ministerio): void
    {
        $title = 'Ministerio - Editar';
        $formulario = $this->renderizarFormularioEdicion($ministerio);
        include '../app/vistas/Ministerio/edit.php';
    }
}

