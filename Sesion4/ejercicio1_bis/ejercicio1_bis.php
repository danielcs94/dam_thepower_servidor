<?php

// Tomo como origen la carpeta inicial
$carpeta = "C:/Users/A8Profesor/Desktop/Servidor PHP";
$tabulacion_inicial = "";
pintarContenido($carpeta, $tabulacion_inicial);

function pintarContenido($carpeta, $tabulacion_inicial)
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
                echo $tabulacion_inicial."Directorio ". $fichero. "<br>";;
                pintarContenido($carpeta . '/' . $fichero,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $tabulacion_inicial);
            }

            if ($es_fichero) {
                echo $tabulacion_inicial."Fichero ". $fichero . "<br>";
            }
        }
    }
}
