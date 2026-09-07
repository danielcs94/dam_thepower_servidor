<?php

use MongoDB\Driver\BulkWrite;

require_once "conectores.php";
require_once "models/alumno.php";
//Vamos a establecer un proceso de carga de datos en array que luego volcaremos al mongodb

$conec = new Conectores();

//Conecto con mongodb
$conec->conectarMongodb();
$manager = $conec->getManagerMongodb();

//Antes de cargar vacio la coleccion en mongodb
$bwdelfila = new BulkWrite();
$bwdelfila->delete([], ['limit' => false]);
$manager->executeBulkWrite('videojuegos_db.filas', $bwdelfila);

//Cargo el csv
$arrcsv = $conec->getCsv();

//Cargo el json
$arrjson = $conec->getJSON();

//cargo el xml
$arrxml = $conec->getXML();

//Uno usando el operador spread
$arrfinal = [...$arrcsv, ...$arrjson, ...$arrxml];


//Reindexo
$arrfinal = array_values($arrfinal);

//Ahora escribo en mongodb

//Extraigo las filas de los alumnos con array_map y me fabrico un array
//print_r($arrfinal);
$arrFilas = array_map(function ($nav) {
    //print_r($nav);
    return ["fila_id" => $nav[2]];
}, $arrfinal);
//print_r($arrFilas);
$arrDistinctFilas = [];
foreach ($arrFilas as $fila) {
    if (isset($fila)) {
        $ifila = $fila["fila_id"];
        if (in_array($ifila, $arrDistinctFilas) == false) {
            array_push($arrDistinctFilas, $ifila);
        }
    }
}

//print_r($arrDistinctFilas);
//Recorro cada una de las filas y con array map voy generando el array de alumnos de cada fila
foreach ($arrDistinctFilas as $fila) {
    //print_r($fila);
    //Busco los alumnos de cada fila con array_filter
    $arralusFila = array_filter($arrfinal, function ($alu) use ($fila) {
        return $alu[2] == $fila;
    });
    $arrAlus = [];
    foreach ($arralusFila as $alufila) {
        $alu = new Alumno();
        $alu->id = (string)$alufila[2].'-'.(string)$alufila[0].'##'.(string)$alufila[1];
        $alu->nombre = (string)$alufila[0];
        $alu->apellidos = (string)$alufila[1];
        $alu->sexo = (string)$alufila[3];
        $alu->es_profe_sexi = (int)$alufila[4] == 1 ? true : false;

        $arrAlus[] = $alu;
    }

    //Reindexo
    $arrAlus = array_values($arrAlus);
    //Añado en mongodb
    $nuefila = [
        'fila_id' => (int)$fila,
        'alumnos' => $arrAlus
    ];

    $bwfila = new BulkWrite();
    $bwfila->insert($nuefila);
    $manager->executeBulkWrite('videojuegos_db.filas', $bwfila);
}
