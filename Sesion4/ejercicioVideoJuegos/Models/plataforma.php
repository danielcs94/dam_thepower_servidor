<?php
class Plataforma
{
    public int $plataforma_id;
    public string $plataforma;
    public array $videojuegos = [];
       public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->plataforma_id = $data['plataforma_id'] ?? null;
            $this->plataforma     = $data['plataforma'] ?? null;
            $this->videojuegos=[];
        }
    }

    public function getplataforma_id()
    {
        return $this->plataforma_id;
    }

    public function setplataforma_id($plataforma_id)
    {
        $this->plataforma_id = $plataforma_id;
    }

    public function getplataforma()
    {
        return $this->plataforma;
    }

    public function setplataforma($plataforma)
    {
        $this->plataforma = $plataforma;
    }

    public function setvideojuegos($videojuegos)
    {
        $this->videojuegos = $videojuegos;
    }
    public function getvideojuegos(): array
    {
        return $this->videojuegos;
    }

    // ====== Métodos CRUD con PDO ======

    public function guardar($pdo)
    {
        if ($this->plataforma_id === null || $this->plataforma_id === 0) {
            // Insert
            $stmt = $pdo->prepare("INSERT INTO plataformas (nombre) 
                                   VALUES (:nombre)");

            $stmt->execute([
                ':nombre'   => $this->plataforma,
            ]);

            $this->plataforma_id = $pdo->lastInsertId();
        } else {
            // Update
            $stmt = $pdo->prepare("UPDATE plataformas SET 
                                    nombre = :nombre
                                   WHERE id = :id");

            $stmt->execute([
                ':nombre'     => $this->plataforma,
                ':id'        => $this->plataforma_id
            ]);
        }
    }

    public static function obtenerPorId($pdo, $id)
    {
        $stmt = $pdo->prepare("SELECT id as plataforma_id,nombre as plataforma FROM plataformas WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new self($data) : new Plataforma();
    }


    public static function obtenerTodos($pdo, $filter = "")
    {
        $sql = "SELECT id as plataforma_id,nombre as plataforma FROM plataformas";
        if ($filter != "") {
            $sql .= $filter;
        }
        $stmt = $pdo->query($sql);
        $plataformas = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $oplataforma = new self($row);
            $plataformas[] = $oplataforma;
        }

        return $plataformas;
    }

    public function eliminar($pdo)
    {
        if ($this->plataforma_id != null) {
            $stmt = $pdo->prepare("DELETE FROM plataformas WHERE id = :id");
            $stmt->execute([':id' => $this->plataforma_id]);
        }
    }
}
