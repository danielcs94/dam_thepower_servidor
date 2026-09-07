<?php
class Fila
{
    public int $fila_id;
    public array $alumnos = [];
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->fila_id = $data['fila_id'] ?? null;
            $this->alumnos = [];
        }
    }

    public function getfila_id()
    {
        return $this->fila_id;
    }

    public function setfila_id($fila_id)
    {
        $this->fila_id = $fila_id;
    }

    public function setalumnos($alumnos)
    {
        $this->alumnos = $alumnos;
    }
    public function getalumnos(): array
    {
        return $this->alumnos;
    }
}
