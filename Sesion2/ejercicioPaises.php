<?php
function tipoPais($habitantes){
    $tipo="";
    if($habitantes>100000000){
        $tipo="grande";
    }else{
        $tipo="pequeño";
    }
    return $tipo;
}

function sacarTercerCaracter($superficie){
    $scaracter="";
    $ssuperficie=strval($superficie);
    $lcadena=strlen($ssuperficie);
    
    $scaracter=substr($ssuperficie, -3, 1);
    return $scaracter;
}

$paises = [
    (object)[ "nombre" => "China", "habitantes" => 1410470000, "superficie" => 9596961 ],
    (object)[ "nombre" => "India", "habitantes" => 1382600000, "superficie" => 3287263 ],
    (object)[ "nombre" => "Estados Unidos", "habitantes" => 339000000, "superficie" => 9833517 ],
    (object)[ "nombre" => "Indonesia", "habitantes" => 275500000, "superficie" => 1904569 ],
    (object)[ "nombre" => "Pakistán", "habitantes" => 240500000, "superficie" => 770880 ],
    (object)[ "nombre" => "Brazil", "habitantes" => 215000000, "superficie" => 8515770 ],
    (object)[ "nombre" => "Nigeria", "habitantes" => 224000000, "superficie" => 923768 ],
    (object)[ "nombre" => "Bangladesh", "habitantes" => 171000000, "superficie" => 147570 ],
    (object)[ "nombre" => "Rusia", "habitantes" => 146000000, "superficie" => 17098242 ],
    (object)[ "nombre" => "México", "habitantes" => 133000000, "superficie" => 1964375 ],
    (object)[ "nombre" => "Japón", "habitantes" => 124000000, "superficie" => 377975 ],
    (object)[ "nombre" => "Etiopía", "habitantes" => 120000000, "superficie" => 1104300 ],
    (object)[ "nombre" => "Filipinas", "habitantes" => 116000000, "superficie" => 300000 ],
    (object)[ "nombre" => "Egipto", "habitantes" => 110000000, "superficie" => 1002450 ],
    (object)[ "nombre" => "Vietnam", "habitantes" => 103000000, "superficie" => 331212 ],
    (object)[ "nombre" => "República Democrática del Congo", "habitantes" => 110000000, "superficie" => 2344858 ],
    (object)[ "nombre" => "Irán", "habitantes" => 86000000, "superficie" => 1648195 ],
    (object)[ "nombre" => "Turquía", "habitantes" => 86000000, "superficie" => 783562 ],
    (object)[ "nombre" => "Alemania", "habitantes" => 84000000, "superficie" => 357022 ],
    (object)[ "nombre" => "Tailandia", "habitantes" => 70000000, "superficie" => 510890 ]
];

//VAMOS A HACER UN EJERCICIO
//VAMOS A HACER UN TABLE DONDE LAS COLUMNAS SEAN
// NOMBRE DEL PAIS
//SEGUNDA COLUMNA SI TIENE MAS DE 100 MILLONES DE HABITANTES PAIS GRANDE SI ES MENOS PAIS PEQUEÑO
//TERCERA COLUMNA EL TERCER CARACTER EMPEZANDO POR LA DERECHA DE LA SUPERFICIE


//inicializo mi variable que va a contener el código html
$sHtml="";
//Inicializamos la tabla html
$sHtml.="<table>";

//Ponemos los títulos de la tabla
$sHtml.="<tr>";
$sHtml.="   <th><b>PAIS</b></th>";
$sHtml.="   <th><b>TIPO PAIS</b></th>";
$sHtml.="   <th><b>TERCER CARACTER</b></th>";
$sHtml.="</tr>";

//RECORRER EL ARRAY
foreach ($paises as $pais) {
    //Inicializo las variables para definir el tipo
    $tipopais="";
    $caracter="";

    $tipopais=tipoPais($pais->habitantes);
    $caracter=sacarTercerCaracter($pais->superficie);
    //Vamos añadiendo fila a fila
    $sHtml.="<tr>";
    $sHtml.="   <td>". $pais->nombre ."</td>";
    $sHtml.="   <td>". $tipopais ."</td>";
    $sHtml.="   <td>". $caracter ."</td>";
    $sHtml.="</tr>";
}
//Finalizamos la tabla html
$sHtml.="</table>";

echo($sHtml);

