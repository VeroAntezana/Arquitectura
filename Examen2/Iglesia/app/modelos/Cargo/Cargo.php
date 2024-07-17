<?php

class Cargo
{
    private int $id;
    private string $nombre;
    private string $descripcion;
    private $ministerio_id;

    public function __construct(int $id, string $nombre, string $descripcion,$ministerio_id)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->ministerio_id= $ministerio_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }
    public function getMinisterioId()
    {
        return $this->ministerio_id;
    }

    public function setMinisterioId($ministerio_id)
    {
        $this->ministerio_id = $ministerio_id;
    }

    public function __toString(): string
    {
        return "Cargo{" .
            "id=" . $this->id .
            ", nombre='" . $this->nombre . '\'' .
            ", descripcion='" . $this->descripcion . '\'' .
            ", ministerio_id=" . $this->ministerio_id .
            '}';
    }
}
