<?php

require_once('../app/modelos/iglesiaDB.php');
require_once('../app/modelos/Evento/Evento.php');

class MEvento 
{
    private IglesiaDB $database;

    public function __construct()
    {
        $this->database = new IglesiaDB();
    }

    public function crearEvento(string $nombre, string $descripcion): void //crear
    {
        $bd = $this->database->getConnection();
        try {
            $query = "INSERT INTO " . $this->database::TABLE_EVENTO . " (nombre, descripcion) VALUES (?, ?)";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("ss", $nombre, $descripcion);
            if ($stmt->execute()) {
                error_log("Cargo insertado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al insertar el cargo en la base de datos: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    public function listarEventos(): array //listar
    {
        $bd = $this->database->getConnection();

        $cargos = [];

        try {
            $result = $bd->query('SELECT * FROM ' . $this->database::TABLE_EVENTO);

            if ($result) {
                while ($row = $result->fetch_assoc()) {

                    $cargo = new Evento($row['id'], $row['nombre'], $row['descripcion']);
                    $cargos[] = $cargo;
                }
            }
        } catch (Exception $e) {
            error_log("Excepción en mostrarCargos: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return $cargos;
    }

    public function buscarEvento(int $id): Evento
    {
        $bd = $this->database->getConnection();

        try {
            $query = "SELECT * FROM " . $this->database::TABLE_EVENTO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Crear y devolver un objeto Cargo a partir de los datos de la fila
                $cargo = new Evento($row['id'], $row['nombre'], $row['descripcion']);
                return $cargo;
            }
        } catch (Exception $e) {
            error_log("Excepción en buscarCargo: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return null;
    }

    public function editarEvento(int $id, string $nombre, string $descripcion): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "UPDATE " . $this->database::TABLE_EVENTO . " SET nombre = ?, descripcion = ? WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("ssi", $nombre, $descripcion, $id);

            if ($stmt->execute()) {
                error_log("Cargo editado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al editar el cargo: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }


    public function eliminarEvento(int $id): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "DELETE FROM " . $this->database::TABLE_EVENTO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                error_log("Cargo eliminado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al eliminar el cargo: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }
}
