<?php

function incrementarValor(int &$numero) // El & indica paso por referencia
{
    $numero++;
    if ($numero > 5) {
        echo $numero ."<br>";
        echo "termino";
        return true;
    } else {
        echo $numero."<br>";
        incrementarValor($numero);
    }

}

if (1 == 1) {
    echo("php-cs-fixer -V");
}

$miNumero = 1;

echo "Antes de llamar a la función, miNumero es: $miNumero <br/>"; // 5

incrementarValor($miNumero);

echo "Después de llamar a la función, miNumero es: $miNumero <br/>"; // 6 (cambió)
