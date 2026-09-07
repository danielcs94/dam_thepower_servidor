<?php

//Incluyo el control de errores
require_once(__DIR__ . "/../error.php");

//Siempre esta bien modelar las clases
//Modelado de clase de contacto
class Contacto
{
    public $contacto_id;
    public $cliente_id;
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;

    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->contacto_id = $data['contacto_id'] ?? null;
            $this->nombre     = $data['nombre'] ?? null;
            $this->apellidos    = $data['apellidos'] ?? null;
            $this->email      = $data['email'] ?? null;
            $this->telefono   = $data['telefono'] ?? null;
            $this->cliente_id     = $data['cliente_id'] ?? null;
        }
    }

    // ====== Getters y Setters ======

    public function getId()
    {
        return $this->contacto_id ?? 0;
    }
    public function setId($id)
    {
        $this->contacto_id = $id;
    }

    public function getNombre()
    {
        return $this->nombre ?? '';
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getEmail()
    {
        return $this->email ?? '';
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTelefono()
    {
        return $this->telefono ?? '';
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getApellidos()
    {
        return $this->apellidos ?? '';
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getClienteId()
    {
        return $this->cliente_id ?? 0;
    }
    public function setClienteId($cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }


    // ====== Métodos CRUD con PDO ======

    public function guardar($pdo)
    {
        if ($this->contacto_id === null || $this->contacto_id === 0) {
            // Insert
            $stmt = $pdo->prepare("INSERT INTO contactos (nombre,email, telefono, apellidos, cliente_id) 
                                   VALUES (:nombre,:email, :telefono, :apellidos, :cliente_id)");

            $stmt->execute([
                ':nombre'   => $this->nombre,
                ':email'     => $this->email,
                ':telefono'    => $this->telefono,
                ':apellidos' => $this->apellidos,
                ':cliente_id'    => $this->cliente_id,
            ]);

            $this->contacto_id = $pdo->lastInsertId();
        } else {
            // Update
            $stmt = $pdo->prepare("UPDATE contactos SET 
                                    nombre = :nombre,
                                    email = :email,
                                    telefono = :telefono,
                                    apellidos = :apellidos,
                                    cliente_id = :cliente_id
                                   WHERE contacto_id = :id");

            $stmt->execute([
                ':nombre'   => $this->nombre,
                ':email'     => $this->email,
                ':telefono'    => $this->telefono,
                ':apellidos' => $this->apellidos,
                ':cliente_id'    => $this->cliente_id,
                ':id'        => $this->contacto_id
            ]);
        }
    }

    public static function obtenerPorId($pdo, $id)
    {
        $stmt = $pdo->prepare("SELECT * FROM contactos WHERE contacto_id = :id");
        $stmt->execute([':id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new self($data) : new Contacto();
    }


    public static function obtenerTodos($pdo, $filter = "")
    {
        $sql = "SELECT * FROM contactos";
        if ($filter != "") {
            $sql .= $filter;
        }
        $stmt = $pdo->query($sql);
        $contactos = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contactos[] = new self($row);
        }

        return $contactos;
    }

    public function eliminar($pdo)
    {
        if ($this->contacto_id != null) {
            $stmt = $pdo->prepare("DELETE FROM contactos WHERE contacto_id = :id");
            $stmt->execute([':id' => $this->contacto_id]);
        }
    }
}
