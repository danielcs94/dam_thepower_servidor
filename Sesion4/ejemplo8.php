<?php
$fichero = "ejemploEscribir.txt";
$f = fopen($fichero, "w");
fwrite($f, "Línea número 01" . PHP_EOL);
fwrite($f, "Línea número 02" . PHP_EOL);
fclose($f);

$f = fopen($fichero, "a");
fwrite($f, "Línea número 03" . PHP_EOL);
fwrite($f, "Línea número 04" . PHP_EOL);
fclose($f);
