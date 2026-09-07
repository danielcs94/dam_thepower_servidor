<?php

// Tomo como origen la carpeta inicial
$carpeta = "C:/Users/A8Profesor/Desktop/Servidor PHP";
$tabulacion_inicial = "";

define("TAB", "\t");
$f = null;
//Creamos el fichero inicial
if (!file_exists("Ficheros.txt")) {
    $f = fopen("Ficheros.txt", "w"); // se crea el archivo vacío
} else {
    unlink("Ficheros.txt");
    $f = fopen("Ficheros.txt", "w"); // se abre para añadir contenido
}

pintarContenido($carpeta, $tabulacion_inicial,$f);
// Cerrar el archivo
fclose($f);
function pintarContenido($carpeta, $tabulacion_inicial, $f)
{
    //Ficheros del directorio actual
    $lista = scandir($carpeta);

    foreach ($lista as $fichero) {
        if ($fichero != "." && $fichero != "..") {
            $rutaCompleta = $carpeta . '/' . $fichero;
            //Compruebo que tiene algun directorio y si es asi llamo al proceso
            $es_directorio = is_dir($rutaCompleta);
            $es_fichero = is_file($rutaCompleta);
            if ($es_directorio) {
                //echo $tabulacion_inicial."Directorio ". $fichero. "<br>";;
                fwrite($f, $tabulacion_inicial . "Directorio " . $fichero . PHP_EOL);
                pintarContenido($carpeta . '/' . $fichero, TAB  . $tabulacion_inicial,$f);
            }

            if ($es_fichero) {
                fwrite($f, $tabulacion_inicial . "Fichero " . $fichero . PHP_EOL);
            }
        }
    }
}
