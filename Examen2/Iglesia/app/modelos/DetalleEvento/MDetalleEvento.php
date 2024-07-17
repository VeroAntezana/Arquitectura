<?php

require_once('../app/modelos/iglesiaDB.php');
require_once('../app/modelos/DetalleEvento/DetalleEvento.php');

class MDetalleEvento
{
    private IglesiaDB $database;

    public function __construct()
    {
        $this->database = new IglesiaDB();
    }

    public function crearDetalleEvento(int $registroEventoId, int $usuarioId): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "INSERT INTO " . $this->database::TABLE_DETALLE_EVENTO . " (registro_evento_id, usuario_id) VALUES (?, ?)";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("ii", $registroEventoId, $usuarioId);
            if ($stmt->execute()) {
                error_log("Detalle de Evento insertado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al insertar el detalle de evento en la base de datos: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    public function listarDetalleEvento(int $registroEventoId): array
{
    $bd = $this->database->getConnection();
    $detallesEventos = [];

    try {
        $query = "SELECT * FROM " . $this->database::TABLE_DETALLE_EVENTO . " WHERE registro_evento_id = ?";
        $stmt = $bd->prepare($query);
        $stmt->bind_param("i", $registroEventoId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $detalleEvento = new DetalleEvento($row['id'], $row['registro_evento_id'], $row['usuario_id']);
                $detallesEventos[] = $detalleEvento;
            }
           
        }
    } catch (Exception $e) {
        error_log("Excepción en listarDetalleEvento: " . $e->getMessage());
    } finally {
        $bd->close();
    }

    return $detallesEventos;
}

}
