<?php
if (!file_exists("samplefile.txt")) {
    $f = fopen("samplefile.txt", "w"); // se crea el archivo vacío
} else {
    $f = fopen("samplefile.txt", "a"); // se abre para añadir contenido
}


//Lectura fichero completo
$fichero = "ejemplo_php.txt";

// echo "<h4>Fichero leído con readfile () :</h4>";
// readfile($fichero);

// echo "<h4>Fichero leído con file_get_contents () :</h4>";
// $cadena = file_get_contents($fichero);
// echo $cadena;

// echo "<h4>Fichero leído con file () :</h4>";
// $array = file($fichero);
// foreach ($array as $linea) {
//     echo $linea, "<br/>";
// }


echo "<h4>Línea a línea</h4>";
$f = fopen($fichero, "r");
$linea = fgets($f);
while (!feof($f)) {
    echo nl2br($linea);
    $linea = fgets($f);
}

echo "<h4>Carácter a carácter</h4>";
$f = fopen($fichero, "r");
$caracter = fgetc($f);
while (!feof($f)) {
    echo "$caracter<br/>";
    $caracter = fgetc($f);
}
fclose($f);
