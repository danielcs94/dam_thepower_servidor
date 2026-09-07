<?php
function colorBordePais($habitantes){
    $borde="";
    if($habitantes>100000000){
        $borde="style=\"border: 1px solid #ff0000\"";
        //$borde="style='border: 1px solid #ff0000'";
    }else{
        $borde="";
    }
    return $borde;
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
//Segunda columna si tiene mas de 100 millones que se vea el borde rojo
//Tercera columna superficie

//PEEEEEROOOO QUIERO LA TABLA ORDENADA POR NOMBRE DE PAIS

//inicializo mi variable que va a contener el código html
$sHtml="";
//Inicializamos la tabla html
$sHtml.="<table>";

//Ponemos los títulos de la tabla
$sHtml.="<tr>";
$sHtml.="   <th><b>PAIS</b></th>";
$sHtml.="   <th><b>TIPO PAIS</b></th>";
$sHtml.="   <th><b>SUPERFICIE</b></th>";
$sHtml.="</tr>";

//Ordeno el array por la primera columna
//sort($paises,0);// solo funciona con array simples


usort($paises, function($a, $b) {
    return $a->nombre <=> $b->nombre;  // funciona con arrays complejos
});


//RECORRER EL ARRAY
foreach ($paises as $pais) {
    //Inicializo las variables para definir el tipo
    $borde="";
    $borde=colorBordePais($pais->habitantes);
    //Vamos añadiendo fila a fila
    $sHtml.="<tr>";
    $sHtml.="   <td>$pais->nombre</td>";
    $sHtml.="   <td $borde>".strval($pais->habitantes)."</td>";
    $sHtml.="   <td>".strval($pais->superficie)."</td>";
    $sHtml.="</tr>";
}
//Finalizamos la tabla html
$sHtml.="</table>";

echo($sHtml);
