<?php
class Videojuego
{
    public int $video_juego_id;
    public int $plataforma_id;
    public string $titulo;
    public int $anio;
    public string $imagen;
    public string $metacritic;
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->video_juego_id = $data['video_juego_id'] ?? null;
            $this->plataforma_id     = $data['plataforma_id'] ?? null;
            $this->titulo    = $data['titulo'] ?? null;
            $this->anio      = $data['anio'] ?? null;
            $this->imagen   = $data['imagen'] ?? '';
            $this->metacritic     = $data['metacritic'] ?? null;
        }
    }

    public function getvideo_juego_id()
    {
        return $this->video_juego_id;
    }

    public function setvideo_juego_id($video_juego_id)
    {
        $this->video_juego_id = $video_juego_id;
    }

    public function getplataforma_id()
    {
        return $this->plataforma_id;
    }

    public function setplataforma_id($plataforma_id)
    {
        $this->plataforma_id = $plataforma_id;
    }

    public function gettitulo()
    {
        return $this->titulo;
    }

    public function settitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getanio()
    {
        return $this->anio;
    }

    public function setanio($anio)
    {
        $this->anio = $anio;
    }

    public function getimagen()
    {
        return $this->imagen;
    }

    public function setimagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getmetacritic()
    {
        return $this->metacritic;
    }

    public function setmetacritic($metacritic)
    {
        $this->metacritic = $metacritic;
    }

     // ====== Métodos CRUD con PDO ======

    public function guardar($pdo)
    {
        if ($this->video_juego_id === null || $this->video_juego_id === 0) {
            // Insert
            $stmt = $pdo->prepare("INSERT INTO juegos (plataforma_id,titulo, anio, metacritic,portada) 
                                   VALUES (:plataforma_id,:titulo, :anio, :metacritic,'')");

            $stmt->execute([
                ':plataforma_id'   => $this->plataforma_id,
                ':titulo'     => $this->titulo,
                ':anio'    => $this->anio,
                ':metacritic' => $this->metacritic,
            ]);

            $this->video_juego_id = $pdo->lastInsertId();
        } else {
            // Update
            $stmt = $pdo->prepare("UPDATE juegos SET 
                                    plataforma_id = :plataforma_id,
                                    titulo = :titulo,
                                    anio = :anio,
                                    metacritic = :metacritic
                                   WHERE id = :id");

            $stmt->execute([
                ':plataforma_id'   => $this->plataforma_id,
                ':titulo'     => $this->titulo,
                ':anio'    => $this->anio,
                ':metacritic' => $this->metacritic,
                ':id'        => $this->video_juego_id
            ]);
        }
    }

    public static function obtenerPorId($pdo, $id)
    {
        $stmt = $pdo->prepare("SELECT id as video_juego_id,plataforma_id,titulo,anio,metacritic, portada as imagen FROM juegos WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new self($data) : new Videojuego();
    }


    public static function obtenerTodos($pdo, $filter = "")
    {
        $sql = "SELECT id as video_juego_id,plataforma_id,titulo,anio, portada as imagen,metacritic FROM juegos";
        if ($filter != "") {
            $sql .= $filter;
        }
        $stmt = $pdo->query($sql);
        $juegos = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ojuego=new self($row);
            $juegos[] = $ojuego;
        }

        return $juegos;
    }

    public function eliminar($pdo)
    {
        if ($this->video_juego_id != null) {
            $stmt = $pdo->prepare("DELETE FROM juegos WHERE id = :id");
            $stmt->execute([':id' => $this->video_juego_id]);
        }
    }
}
