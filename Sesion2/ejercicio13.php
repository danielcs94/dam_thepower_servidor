<?php
// Forma antigua (aún válida)
$frutas1 = array("Manzana", "Naranja", "Plátano");
// Forma moderna y más corta (desde PHP 5.4)
$frutas2 = ["Manzana", "Naranja", "Plátano"];
// Crear un array vacío y añadir elementos después
$colores = []; // o $colores = array();
$colores[] = "Rojo"; // Añade "Rojo" en el índice 0
$colores[] = "Verde"; // Añade "Verde" en el índice 1
$colores[2] = "Azul"; // Asigna "Azul" explícitamente al índice 2
$colores[] = "Amarillo"; // Añade "Amarillo" en el índice 3 (siguiente disponible)

echo $frutas1[0]; // Manzana
echo $colores[1]; // Verde
echo $colores[2]; // Verde
$colores[0] = "Morado"; // Modificar un elemento
echo $colores[0]; // Morado

$numeros = [10, 20, 30, 40, 50];
echo "Recorriendo con for:<br/>"; 
for ($i = 0; $i <count($numeros); $i++) 
{ 
    echo "Índice $i:$numeros[$i]<br/>"; 
}

foreach ($numeros as $numero) 
{ 
    echo "Número:$numero. >Va por ti NOE<br/>"; 
}