<?php

//Saco el nombre de la carpeta actual
$carpeta = getcwd();

//Fecha de ultima modificacion y tamaño
$nombre = "mi_archivo.txt";
$tamanio = filesize($nombre);
$momento = filemtime($nombre);
$fecha = date("d/m/Y H:i:s", $momento);
echo "El archivo $nombre ocupa $tamanio bytes";
echo "<br/>";
echo "La última modificación fue el $fecha";

//Ficheros del directorio actual
$lista = scandir($carpeta);

foreach ($lista as $fichero) {
    $rutaCompleta = $carpeta . '/' . $fichero;

    if (is_file($rutaCompleta)) {
        //echo "Es un archivo: $fichero<br>";
        if (strpos($fichero, ".txt")) {
            echo "Es un archivo txt: $fichero<br>";
        }
    }
}

//Creo el directorio y hago una copia del archivo
$dir_nue = "mi_directorio";
$rutaCompletaDir = $carpeta . '/' . $dir_nue;

//Compruebo que existe para que no me cree mas
if (!(is_dir($rutaCompletaDir))) {
    mkdir($dir_nue);
}


//Copio el archivo
$origen = "$carpeta/$nombre";
if (file_exists($origen)) {
    $nombre_nue = str_replace(".txt", "_copia.txt", $nombre);
    $destino = "$carpeta/$nombre_nue";
    copy($origen, $destino);

    //Muevo el antiguo
    $destino_nue = "$carpeta/$dir_nue/$nombre";
    rename($origen, $destino_nue);
}
