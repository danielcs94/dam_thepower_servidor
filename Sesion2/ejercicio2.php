<?php
// Esto es un comentario de una sola línea
/*
Esto es un
comentario de
múltiples líneas.
*/

//++TIPOS 251008
$miVariable = 10; // integer
echo gettype($miVariable) . "<br>"; // Muestra: integer

$miVariable = "Hola"; // string
echo gettype($miVariable) . "<br>"; // Muestra: string

$miVariable = true; // boolean
echo gettype($miVariable) . "<br>"; // Muestra: boolean
//--TIPOS 251008

//++OPERADORES 251008
$a=0;
$a += 5; // Equivale a $a = $a + 5;
echo ('$a'.$a. "<br>");
$saludo = "Hola" . " " . "Mundo". "<br>";
echo ('$saludo'.$saludo);
$texto = "Inicio". "<br>";

$texto .= " y continuación". "<br>"; // Resultado: "Inicio y continuación"
echo ('$texto'.$texto);
//--OPERADORES 251008