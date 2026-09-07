<?php
// echo "ESTE VA BIEN";
// $nombreAnimal = "perro"; 
// $perro = "Fido"; 
// echo $$nombreAnimal; 

// echo "ESTE VA CATAPUM";
// $nombreAnimal = "perro1"; 
// $perro = "Fido"; 
// echo $$nombreAnimal; // Accede a $perro => "Fido"

$saludo_en = "Hello"; 
$saludo_es = "Hola"; 
$saludo_fr = "Bonjour"; 
$idioma = "fr"; 
$nombreVariableSaludo = "saludo_" . $idioma; 
echo $$nombreVariableSaludo . ", Monde!"; // Bonjour, Monde!