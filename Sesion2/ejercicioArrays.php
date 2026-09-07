<?php
//Vamos a hacer un proceso recursivo que me sume los números de un array dado
//me tiene que valer cualquier array y de cualquier tipo elementos


function sumarArray(array &$numeros,int $indice=0):int{
    if($indice>= count($numeros)){
        return 0.0;
    }
    
    return $numeros[$indice] + sumarArray($numeros,$indice +1);
}


function sumarArray2(int &$salida,array $numeros,int $indice=0){
    if($indice>= count($numeros)){
        return 0.0;
    }else{
        $salida+=$numeros[$indice] + sumarArray($numeros,$indice +1);
    }
}

$valores=[13,14,15,15,1,5,45,106];
$resultado=sumarArray($valores);
echo "La suma es $resultado<br>";

$sresultado=0;
sumarArray2($sresultado,$valores);

echo "La suma es $sresultado<br>";
