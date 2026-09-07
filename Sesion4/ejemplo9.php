<?php
$fichero = "ejemplo.csv";
$f = fopen($fichero, "a+");
fwrite($f, "Línea número 05" . PHP_EOL);
rewind($f);
echo fgets($f) . "<br/>";
while (!feof($f)) {
    echo fgets($f) . "<br/>";
}
fclose($f);
?>