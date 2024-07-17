<?php

class RegistroEvento
{
    private int $id;
    private string $lugar;
    private string $nota;
    private string $fecha;
    private $evento_id;

    public function __construct(int $id, string $lugar, string $nota, string $fecha, $evento_id )
    {
        $this->id = $id;
        $this->lugar = $lugar;
        $this->nota = $nota;
        $this->fecha = $fecha;
        $this->evento_id= $evento_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLugar(): string
    {
        return $this->lugar;
    }

    public function getNota(): string
    {
        return $this->nota;
    }
    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setLugar(string $lugar): void
    {
        $this->lugar = $lugar;
    }

    public function setNota(string $nota): void
    {
        $this->nota = $nota;
    }
    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }
    public function getEventoId()
    {
        return $this->evento_id;
    }

    public function setEventoId($evento_id)
    {
        $this->evento_id = $evento_id;
    }

    public function __toString(): string
    {
        return "RegistroEvento{" .
            "id=" . $this->id .
            ", lugar='" . $this->lugar . '\'' .
            ", nota='" . $this->nota . '\'' .
            ", fecha='" . $this->fecha . '\'' .
            ", evento_id=" . $this->evento_id .
            '}';
    }
}
