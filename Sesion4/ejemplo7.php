<?php
$fichero = "ejemplo.csv";
if (file_exists($fichero)) {
    echo "<h4>Fichero CSV</h4>";
    $f = fopen($fichero, "r");
    $array = fgetcsv($f);
    while (!feof($f)) {
        echo "Nombre: " . $array[0] . " " . $array[1] . "<br/>";
        echo "Email: " . $array[2] . "<br/>";
        echo "Teléfono: " . $array[3] . "<br/>";
        echo "--<br/>";
        $array = fgetcsv($f);
    }
    fclose($f);
} else {
    echo "El fichero especificado no existe";
}