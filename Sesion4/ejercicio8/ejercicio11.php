<?php
use MongoDB\Driver\Manager;
use MongoDB\Driver\BulkWrite;

$conexion = new Manager('mongodb://jorge:1234@192.168.108.100:27017/videojuegos_db');

$filtro = ['$and' => [['nombre' => 'NEOGEO']]];
$cambio = ['$set' => ['nombre' => 'atari']];

$plataforma = new BulkWrite();
$plataforma->update($filtro, $cambio, ['multi' => true, 'upsert' => true]);
$conexion->executeBulkWrite("videojuegos_db.plataformas", $plataforma);



 