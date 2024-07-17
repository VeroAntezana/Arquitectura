<?php

declare(strict_types=1);

class VDetalleEvento

{



    
    private function renderizarTabla(array $usuarios): string
    {
        $rowData = '';
        
        if (empty($detalles)) {
            return "<tbody></tbody>";
        }

        foreach ((array)$detalles as $detalle) {
            $rowData .= "<tr>";
           
         

          
          // Buscar Usuario A por ID
          $usuarioA = null;
          foreach ($usuarios as $usuario) {
              if ($usuario->getId() === $detalle->getUsuarioA()) {
                  $usuarioA = $usuario;
                  break;
              }
          }

          $rowData .= "<td>";
          $rowData .= ($usuarioA ? $usuarioA->getNombre() . " " . $usuarioA->getApellido()  : "Usuario no encontrado");
          $rowData .= "</td>";

            $rowData .= "<td>";
            $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_detalle_evento'>";
            $rowData .= "<input type='hidden' name='id' value='{$detalle->getId()}'>";
            $rowData .= "<button type='button' onclick='confirmarEliminar({$detalle->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
            
            $rowData .= "</form>";
            $rowData .= "</td>";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    private function renderizarFormularioAgregarUsuario($usuarios): string
    {
        $formulario = '';

        $formulario .= "<div class='container'>";
        $formulario .= "<h2>Agregar Usuario</h2>";
        $formulario .= "</div>";
        $formulario .= "<div class='container'>";
        $formulario .= "<form method='post' action='/agregar_usuario_detalle_evento'>";

        $formulario .= "<div class='row'>";
        $formulario .= "<div class='col-12'>";
        $formulario .= "<label for='usuario'>Seleccionar Usuario</label>";
        $formulario .= "<select name='usuario' id='usuario' required>";
        foreach ($usuarios as $usuario) {
            $formulario .= "<option value='{$usuario->getId()}'>{$usuario->getNombre()} {$usuario->getApellido()}</option>";
        }
        $formulario .= "</select>";
        $formulario .= "</div>";

        $formulario .= "</div>";
        $formulario .= "<div class='row mt-3'>";
        $formulario .= "<div class='col-12 d-flex justify-content-end'>";
        $formulario .= "<button class='add-button' type='submit'>Agregar</button>";
        $formulario .= "<a href='/menu' class='back-button'>Volver</a>";
        $formulario .= "</div>";
        $formulario .= "</div>";
        $formulario .= "</form>";
        $formulario .= "</div>";

        return $formulario;
    }

    public function actualizar(array $detalles, array $usuarios): void
    {
        $title = 'Detalle de Evento';
        $tbody = $this->renderizarTabla($detalles, $usuarios);
        $formularioAgregarUsuario = $this->renderizarFormularioAgregarUsuario($usuarios);
        include '../app/vistas/DetalleEvento/index.php';
    }


    
}
