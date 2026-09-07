<?php
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

$conexion = new Manager('mongodb://jorge:1234@192.168.108.100:27017/videojuegos_db');

//Query sin filtros
//$plataformas = $conexion->executeQuery("videojuegos_db.plataformas", new Query([], []));

//Query con ordenacion
//$plataformas = $conexion->executeQuery("videojuegos_db.plataformas", new Query([], ['sort' => ['nombre' => 1]]));

//Query con filtro comienzo de texto
//$plataformas = $conexion->executeQuery("videojuegos_db.plataformas", new Query(['nombre' => new MongoDB\BSON\Regex('^P')], ['sort' => ['nombre' => 1]]));
$plataformas = $conexion->executeQuery("videojuegos_db.plataformas", new Query(
    ['nombre' => ['$eq' => 'NEOGEO']],
    ['sort' => ['titulo' => 1]]
));

//Pruebas para plataformas
foreach ($plataformas as $pla) {
    echo "Nombre: ", $pla->nombre . "<br/>";
    foreach ($pla->juegos as $jue) {
        echo "juegos: " . $jue->titulo . "<br/>";
    }
    
    echo "<hr>";
}









 