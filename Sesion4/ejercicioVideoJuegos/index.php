<?php
//Incluyo mi fichero de conectores
require_once "conectores.php";

$conec = new Conectores();

//Me traigo de mi get el conector
$conector = $_GET['conector'] ?? '';

//Inicializo la variable de pintar la tabla
$arrFinalPlataformas = [];

print_r("<h1>Procesando ". $conector ."</h1>");
$arrFinalPlataformas=$conec->procesarArray($conector);
$shtml = $conec->pintarArrayDiv($arrFinalPlataformas);
print_r($shtml);
