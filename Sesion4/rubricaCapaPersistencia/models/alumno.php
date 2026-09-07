<?php
class Alumno
{
    public string $id;
    public string $nombre;
    public string $apellidos;
    public string $sexo;
    public bool $es_profe_sexi;
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->nombre = $data['nombre'] ?? null;
            $this->apellidos = $data['apellidos'] ?? null;
            $this->sexo = $data['sexo'] ?? null;
            $this->es_profe_sexi = $data['es_profe_sexi'] ?? null;
        }
    }
    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id = $id;
    }
    public function getnombre()
    {
        return $this->nombre;
    }

    public function setnombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getapellidos()
    {
        return $this->apellidos;
    }

    public function setapellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getsexo()
    {
        return $this->sexo;
    }

    public function setsexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getes_profe_sexi()
    {
        return $this->es_profe_sexi;
    }

    public function setes_profe_sexi($es_profe_sexi)
    {
        $this->es_profe_sexi = $es_profe_sexi;
    }
}
