<?php

require_once('../app/modelos/iglesiaDB.php');
require_once('../app/modelos/RegistroEvento/RegistroEvento.php');
require_once('../app/adapters/PDFAdapter.php');
require_once('../app/adapters/HTMLAdapter.php');
require_once('../app/adapters/ImagenAdapter.php');

class MRegistroEvento
{
    private IglesiaDB $database;
    private CertificadoTarget $adapter;

    public function __construct()
    {
        $this->database = new IglesiaDB();
    }

    public function crearRegistroEvento($lugar, $nota, $fecha, $evento_id): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "INSERT INTO " . $this->database::TABLE_REGISTRO_EVENTO . " (lugar, nota, fecha, evento_id) VALUES (?, ?, ?, ?)";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("sssi", $lugar, $nota, $fecha, $evento_id);
            if ($stmt->execute()) {
                error_log("Registro de Evento insertado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al insertar el Registro de Evento en la base de datos: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    public function listarRegistroEventos(): array
    {
        $bd = $this->database->getConnection();
        $registro_eventos = [];

        try {
            $result = $bd->query('SELECT * FROM ' . $this->database::TABLE_REGISTRO_EVENTO);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $registro_evento = new RegistroEvento($row['id'], $row['lugar'], $row['nota'], $row['fecha'], $row['evento_id']);
                    $registro_eventos[] = $registro_evento;
                }
            }
        } catch (Exception $e) {
            error_log("Excepción en mostrar Registros de Eventos: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return $registro_eventos;
    }

    public function buscarRegistroEvento(int $id): ?RegistroEvento
    {
        $bd = $this->database->getConnection();

        try {
            $query = "SELECT * FROM " . $this->database::TABLE_REGISTRO_EVENTO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $registro_evento = new RegistroEvento($row['id'], $row['lugar'], $row['nota'], $row['fecha'], $row['evento_id']);
                return $registro_evento;
            }
        } catch (Exception $e) {
            error_log("Excepción en buscarRegistro: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return null;
    }

    public function editarRegistroEvento(int $id, string $lugar, string $nota, string $fecha, $evento_id): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "UPDATE " . $this->database::TABLE_REGISTRO_EVENTO . " SET lugar = ?, nota = ?, fecha = ?, evento_id = ? WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("sssii", $lugar, $nota, $fecha, $evento_id, $id);

            if ($stmt->execute()) {
                error_log("Registro editado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al editar el registro: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    public function eliminarRegistroEvento(int $id): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "DELETE FROM " . $this->database::TABLE_REGISTRO_EVENTO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                error_log("Registro de Evento eliminado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al eliminar el registro: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    public function generarCertificado(RegistroEvento $registroEvento, string $nombreEvento, array $usuarios, string $formato): void
    {
        switch ($formato) {
            case 'pdf':
                $this->adapter = new PDFAdapter();
                break;
            case 'html':
                $this->adapter = new HTMLAdapter();
                break;
            case 'imagen':
                $this->adapter = new ImagenAdapter();
                break;
            default:
                throw new Exception("Formato no soportado");
        }

        if ($this->adapter) {
            $this->adapter->download($registroEvento, $nombreEvento, $usuarios);
        }
    }
}
