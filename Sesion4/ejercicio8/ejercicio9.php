<?php
use MongoDB\Driver\Manager;
use MongoDB\Driver\BulkWrite;

$conexion = new Manager('mongodb://jorge:1234@192.168.108.100:27017/videojuegos_db_lucio');
// Damos de alta un contacto
$plataforma = new BulkWrite();
$plataforma->insert([
    'nombre' => 'NEOGEO',
    'juegos' => []
]);
$conexion->executeBulkWrite("videojuegos_db_lucio.plataformas", $plataforma);



 