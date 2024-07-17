<?php

declare(strict_types=1);

class VCargo
{
    private function renderizarTabla($cargos,array $ministerios): string
    {
        $rowData = '';
        
        if (empty($cargos)) {
            return "<tbody></tbody>";
        }

        foreach ((array)$cargos as $cargo) {
            $rowData .= "<tr>";
            $rowData .= "<td>{$cargo->getId()}</td>";
            $rowData .= "<td>{$cargo->getNombre()}</td>";
            $rowData .= "<td>{$cargo->getDescripcion()}</td>";
         

            // Busca el nombre del cargo basado en el ID del cargo
            $nombreMinisterio = "";
            foreach ($ministerios as $ministerio) {
                if ($ministerio->getId() == $cargo->getMinisterioId()) {
                    $rowData .= "<td>{$ministerio->getNombre()}</td>";
                    break;
                }
            }
            
            

            $rowData .= "<td><a href='/editar_cargo?id={$cargo->getId()}' class='edit-button'>Editar</a></td>";
            $rowData .= "<td>";
            $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_cargo'>";
            $rowData .= "<input type='hidden' name='id' value='{$cargo->getId()}'>";
            $rowData .= "<button type='button' onclick='confirmarEliminar({$cargo->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
            
            $rowData .= "</form>";
            $rowData .= "</td>";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    public function renderizarFormularioCrear($ministerios): string
    {

        $nuevoCargoForm = '
        <div class="container">
        <h2>Nuevo Cargo </h2>
    </div>
    <div class="container">
        
        <div id="form_cargo">
            <form action="/cargos" method="post">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="nombre">Nombre</label>
                        <input name="nombre" type="text" id="nombre" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="descripcion">Descripcion</label>
                        <input name="descripcion" type="text" id="descripcion" required>
                    </div>
                   
                    <div class="col-12 col-md-4">
                        <label for="ministerio">Ministerio</label>
                        <select name="ministerio" id="ministerio" >';

                        foreach ($ministerios as $ministerio) {
                         $nuevoCargoForm .= "<option value='{$ministerio->getId()}'>{$ministerio->getNombre()}</option>";
                         }

                     $nuevoCargoForm .= '
                        </select>
                    </div>
                </div>
              <br>
                <div class="row mt-3">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="add-button" type="submit">Ag regar</button>
                    </div>
                </div>
                
            </div>
            </form>
        </div>
    </div>
    ';



        return $nuevoCargoForm;
    }

    public function actualizar($cargos, $ministerios): void
    {
        $title = 'Cargos';
        $tbody = $this->renderizarTabla($cargos, $ministerios);
        $formulario = $this->renderizarFormularioCrear($ministerios);
        include '../app/vistas/Cargo/index.php';
    }


    private function renderizarFormularioEdicion($cargo, $ministerios): string
    {
        $formulario = '';

        if (!empty($cargo)) {
            $formulario .= "<form method='post' action='/actualizar_cargo'>";
            $formulario .= "<input type='hidden' name='id' value='{$cargo->getId()}'>";
            $formulario .= "<div class='container-fluid'>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='nombre'>Nombres:</label>";
            $formulario .= "<input type='text' id='nombre' name='nombre' value='{$cargo->getNombre()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='apellido'>Apellidos:</label>";
            $formulario .= "<input type='text' id='apellido' name='apellido' value='{$cargo->getDescripcion()}' required>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='ministerio'>Ministerio:</label>";
            $formulario .= "<select name='ministerio' id='ministerio' required>";

            foreach ($ministerios as $ministerio) {
                $selected = $ministerio->getId() === $cargo->getMinisterioId() ? 'selected' : '';
                $formulario .= "<option value='{$ministerio->getId()}' {$selected}>{$ministerio->getNombre()}</option>";
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

    public function mostrarFormularioEdicion($cargo, $ministerios): void
    {
        $title = 'Cargo - Editar';
        $formulario = $this->renderizarFormularioEdicion($cargo, $ministerios);
        include '../app/vistas/Cargo/edit.php';
    }
}
