<?php

class Personajes
{
    protected int $personaje_id;
    protected string $personaje;
    protected string $ki;
    protected string $descripcion;

    public function getpersonaje_id()
    {
        return $this->personaje_id;
    }

    public function getpersonaje()
    {
        return $this->personaje;
    }
    public function getki()
    {
        return $this->ki;
    }
    public function getdescripcion()
    {
        return $this->descripcion;
    }

    public function setpersonaje_id($personaje_id)
    {
        $this->personaje_id = $personaje_id;
    }

    public function setpersonaje($personaje)
    {
        $this->personaje = $personaje;
    }

    public function setki($ki)
    {
        $this->ki = $ki;
    }

    public function setdescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
}
