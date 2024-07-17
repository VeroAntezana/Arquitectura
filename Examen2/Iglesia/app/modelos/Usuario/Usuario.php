<?php

class Usuario
{
    private $id;
    private $nombre;
    private $apellido;
    private $fechanacimiento;
    private $ci;
    private $telefono;
    private $cargo_id;

    public function __construct($id, $nombre, $apellido, $fechanacimiento, $ci,$telefono, $cargo_id)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechanacimiento = $fechanacimiento;
        $this->ci = $ci;
        $this->telefono = $telefono;
        $this->cargo_id = $cargo_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getFechaNacimiento()
    {
        return $this->fechanacimiento;
    }

    public function setFechaNacimiento($fechanacimiento)
    {
        $this->fechanacimiento = $fechanacimiento;
    }

    public function getCI()
    {
        return $this->ci;
    }

    public function setCI($ci)
    {
        $this->ci = $ci;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    public function getCargoId()
    {
        return $this->cargo_id;
    }

    public function setCargoId($cargo_id)
    {
        $this->cargo_id = $cargo_id;
    }

    public function __toString()
    {
        return "Usuario{" .
            "id=" . $this->id .
            ", nombre='" . $this->nombre . '\'' .
            ", apellido='" . $this->apellido . '\'' .
            ", fechanacimiento='" . $this->fechanacimiento . '\'' .
            ", ci='" . $this->ci . '\'' .
            ", telefono='" . $this->telefono . '\'' .
            ", cargo_id=" . $this->cargo_id .
            '}';
    }
}
