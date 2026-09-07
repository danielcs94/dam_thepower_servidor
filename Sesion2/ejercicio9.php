<?php
$fecha=date('d');

echo $fecha."<br>";

$fechacompleta=date("d-M-Y, H:i:s A");
echo gettype($fechacompleta)."<br>";
echo $fechacompleta."<br>";

 $timestamp=mktime(13, 41, 58, 10, 9, 2025)."<br>";
 echo $timestamp;
$timestamp2=1760060118;

 $fecha=date("d-M-Y, H:i:s A",$timestamp2);
 echo $fecha."<br>";
 