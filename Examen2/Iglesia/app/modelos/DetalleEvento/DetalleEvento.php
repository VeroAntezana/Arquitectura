<?php

class DetalleEvento
{
    private int $id;
    private int $registro_evento_id;
    private int $usuario_id;

    public function __construct(int $id, int $registro_evento_id, int $usuario_id)
    {
        $this->id = $id;
        $this->registro_evento_id = $registro_evento_id;
        $this->usuario_id = $usuario_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRegistroEventoId(): int
    {
        return $this->registro_evento_id;
    }

    public function getUsuarioId(): int
    {
        return $this->usuario_id;
    }

    
    public function __toString(): string
    {
        return "DetalleEvento{" .
            "id=" . $this->id .
            ", usuario_id='" . $this->usuario_id . '\'' .
            '}';
    }
}
