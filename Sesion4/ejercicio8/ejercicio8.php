<?php
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

$conexion = new Manager('mongodb://jorge:1234@192.168.108.100:27017/videojuegos_db');
$plataformas = $conexion->executeQuery("videojuegos_db.plataformas", new Query([], []));
var_dump($plataformas->toArray());

