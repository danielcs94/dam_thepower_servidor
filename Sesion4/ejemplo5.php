<?php
// $nombre = "ejemplo5.php";
// $tamaño = filesize($nombre);
// $momento = filemtime($nombre);
// $fecha = date("d/m/Y H:i:s", $momento);
// echo "El archivo $nombre ocupa $tamaño bytes";
// echo "<br/>";
// echo "La última modificación fue el $fecha";


$carpeta = "C:/Users/A8Profesor/Desktop/Servidor PHP/dam_thepower_servidor";

$manejador = opendir($carpeta);

if ($manejador) {

    $fichero = readdir($manejador);

    while ($fichero !== false) {

        // ignorar . y ..
        if ($fichero !== "." && $fichero !== "..") {

            $rutaCompleta = $carpeta . "/" . $fichero;

            if (is_file($rutaCompleta)) {
                echo "Archivo: $fichero<br>";
            } else {
                echo "Directorio: $fichero<br>";
            }
        }

        $fichero = readdir($manejador);
    }

    closedir($manejador);
}


$lista = scandir($carpeta);

foreach ($lista as $fichero) {
    echo $fichero . "<br>";

    $rutaCompleta = $carpeta . '/' . $fichero;

    if (is_file($rutaCompleta)) {
        echo "Es un archivo: $fichero<br>";
    }
}
?>

