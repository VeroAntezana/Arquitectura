<?php

require_once('../app/modelos/iglesiaDB.php');
require_once('../app/modelos/Parentesco/Parentesco.php');


class MParentesco
{
    private iglesiaDB $database;

    public function __construct()
    {
        $this->database = new iglesiaDB();
    }

    // Función para agregar una nueva relación
    public function agregarParentesco($usuarioA, $usuarioB, $tipoRelacionA ): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "INSERT INTO " . $this->database::TABLE_PARENTESCO . " (usuario_a, usuario_b, tipo_relacion_a) VALUES (?, ?, ?)";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("iii", $usuarioA, $usuarioB, $tipoRelacionA);
            if ($stmt->execute()) {
                error_log("Relación insertada con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al insertar la relación a la base de datos: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    // Función para obtener todas las relaciones
    public function listarParentescos(): array
    {
        $bd = $this->database->getConnection();
        $relaciones = [];

        try {
            $result = $bd->query('SELECT * FROM ' . $this->database::TABLE_PARENTESCO);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $relacion = new Parentesco($row['id'], $row['usuario_a'], $row['usuario_b'], $row['tipo_relacion_a']);
                    $relaciones[] = $relacion;
                }
            }
        } catch (Exception $e) {
            error_log("Excepción en obtenerRelaciones: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return $relaciones;
    }

    // Función para buscar una relación por su ID
    public function buscarParentesco($id)
    {
        $bd = $this->database->getConnection();
        try {
            $query = "SELECT * FROM " . $this->database::TABLE_PARENTESCO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $relacion = new Parentesco($row['id'] ,$row['usuario_a'], $row['usuario_b'], $row['tipo_relacion_a']);
                return $relacion;
            }
        } catch (Exception $e) {
            error_log("Excepción en buscarRelacion: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return null;
    }

    // Función para editar una relación
    public function editarParentesco($id, $usuarioA, $usuarioB, $tipoRelacionA): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "UPDATE " . $this->database::TABLE_PARENTESCO . " SET usuario_a = ?, usuario_b = ?, tipo_relacion_a = ? WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("iiii", $usuarioA, $usuarioB, $tipoRelacionA, $id);

            if ($stmt->execute()) {
                error_log("Relación editada con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al editar la relación: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    // Función para eliminar una relación por su ID
    public function eliminarParentesco($id): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "DELETE FROM " . $this->database::TABLE_PARENTESCO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                error_log("Relación eliminada con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al eliminar la relación: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }
}
