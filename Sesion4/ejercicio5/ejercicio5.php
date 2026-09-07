<?php
try {
    $pdo = new PDO('mysql:host=localhost:3307;dbname=videojuegos_db', 'root', '');
    echo "¡Conexión establecida!";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}