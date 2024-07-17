<?php

require_once('../app/modelos/iglesiaDB.php');
require_once('../app/modelos/Ministerio/Ministerio.php');

class MMinisterio 
{
    private IglesiaDB $database;

    public function __construct()
    {
        $this->database = new IglesiaDB();
    }

    public function crearMinisterio(string $nombre, string $descripcion): void //crear
    {
        $bd = $this->database->getConnection();
        try {
            $query = "INSERT INTO " . $this->database::TABLE_MINISTERIO . " (nombre, descripcion) VALUES (?, ?)";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("ss", $nombre, $descripcion);
            if ($stmt->execute()) {
                error_log("Ministerio insertado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al insertar el ministerio en la base de datos: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    public function listarMinisterios(): array //listar
    {
        $bd = $this->database->getConnection();

        $ministerios = [];

        try {
            $result = $bd->query('SELECT * FROM ' . $this->database::TABLE_MINISTERIO);

            if ($result) {
                while ($row = $result->fetch_assoc()) {

                    $ministerio = new Ministerio($row['id'], $row['nombre'], $row['descripcion']);
                    $ministerios[] = $ministerio;
                }
            }
        } catch (Exception $e) {
            error_log("Excepción en mostrarMinisterios: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return $ministerios;
    }

    public function buscarMinisterio(int $id): Ministerio
    {
        $bd = $this->database->getConnection();

        try {
            $query = "SELECT * FROM " . $this->database::TABLE_MINISTERIO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Crear y devolver un objeto Cargo a partir de los datos de la fila
                $ministerio = new Ministerio($row['id'], $row['nombre'], $row['descripcion']);
                return $ministerio;
            }
        } catch (Exception $e) {
            error_log("Excepción en buscarMinisterio: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return null;
    }

    public function editarMinisterio(int $id, string $nombre, string $descripcion): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "UPDATE " . $this->database::TABLE_MINISTERIO . " SET nombre = ?, descripcion = ? WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("ssi", $nombre, $descripcion, $id);

            if ($stmt->execute()) {
                error_log("Ministerio editado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al editar el ministerio: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }


    public function eliminarMinisterio(int $id): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "DELETE FROM " . $this->database::TABLE_MINISTERIO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                error_log("Ministerio eliminado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al eliminar el ministerio: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }
}
