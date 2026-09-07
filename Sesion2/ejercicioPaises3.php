<?php
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

$capitales = [
    (object)["pais" => "China", "capital" => "Beijing"],
    (object)["pais" => "India", "capital" => "Nueva Delhi"],
    (object)["pais" => "Estados Unidos", "capital" => "Washington D.C."],
    (object)["pais" => "Indonesia", "capital" => "Yakarta"],
    (object)["pais" => "Pakistán", "capital" => "Islamabad"],
    (object)["pais" => "Brazil", "capital" => "Brasilia"],
    (object)["pais" => "Nigeria", "capital" => "Abuya"],
    (object)["pais" => "Bangladesh", "capital" => "Daca"],
    (object)["pais" => "Rusia", "capital" => "Moscú"],
    (object)["pais" => "México", "capital" => "Ciudad de México"],
    (object)["pais" => "Japón", "capital" => "Tokio"],
    (object)["pais" => "Etiopía", "capital" => "Adís Abeba"],
    (object)["pais" => "Filipinas", "capital" => "Manila"],
    (object)["pais" => "Egipto", "capital" => "El Cairo"],
    (object)["pais" => "Vietnam", "capital" => "Hanói"],
    (object)["pais" => "República Democrática del Congo", "capital" => "Kinshasa"],
    (object)["pais" => "Irán", "capital" => "Teherán"],
    (object)["pais" => "Turquía", "capital" => "Ankara"],
    (object)["pais" => "Alemania", "capital" => "Berlín"],
    (object)["pais" => "Tailandia", "capital" => "Bangkok"]
];


//VAMOS A HACER UN EJERCICIO
//VAMOS A HACER UN TABLE DONDE LAS COLUMNAS SEAN
// NOMBRE DEL PAIS
//Segunda columna capital pero que este centrada
//tercera columna habitantes

//MANERA CON BUCLE
function sacarCapital($pais){
    $scapital="";
    global $capitales;
    foreach($capitales as $capi){
        $spais=$capi->pais;
        if( $spais==$pais){
            $scapital=$capi->capital;
            break;
        }
    }
    return $scapital;
}
//MANERA CON FUNCIONES DE ARRAY
function obtenerCapital($pais) {
    global $capitales;

    $resultado = array_filter($capitales, function($capi) use ($pais) {
        return $capi->pais == $pais;
    });

    // $resultado es un array, tomamos el primer elemento
    if (!empty($resultado)) {
        $c = array_values($resultado)[0]; // reindexar
        return $c->capital;
    }

    return "";
}


//VAMOS A HACER UN EJERCICIO
//VAMOS A HACER UN TABLE DONDE LAS COLUMNAS SEAN
// NOMBRE DEL PAIS
//Segunda columna capital

//PEEEEEROOOO QUIERO LA TABLA ORDENADA POR NOMBRE DE PAIS

//inicializo mi variable que va a contener el código html
$sHtml="";

//Añado los estilos
$sHtml.="<style>";
$sHtml.="    .bordeNegro {";
$sHtml.="        border:1px solid black;";
$sHtml.="        text-align:center;";
$sHtml.="    }";
$sHtml.="    .cabeceraAmarilla {";
$sHtml.="        background-color:yellow";
$sHtml.="    }";
$sHtml.="    .alineadoIzq {";
$sHtml.="        text-align:left";
$sHtml.="    }";

$sHtml.="</style>";
//Inicializamos la tabla html
$sHtml.="<table class=\"bordeNegro\">";

//Ponemos los títulos de la tabla
$sHtml.="<tr class=\"cabeceraAmarilla\">";
$sHtml.="   <th><b>PAIS</b></th>";
$sHtml.="   <th><b>CAPITAL</b></th>";
$sHtml.="   <th><b>HABITANTES</b></th>";
$sHtml.="</tr>";

//RECORRER EL ARRAY
foreach ($paises as $pais) {
    //Inicializo las variables para definir el tipo
    $capital="";
    $capital=obtenerCapital($pais->nombre);
    //Vamos añadiendo fila a fila
    $sHtml.="<tr>";
    $sHtml.="   <td class=\"alineadoIzq\">$pais->nombre</td>";
    $sHtml.="   <td>$capital</td>";
    $sHtml.="   <td>$pais->habitantes</td>";
    $sHtml.="</tr>";
}
//Finalizamos la tabla html
$sHtml.="</table>";

echo($sHtml);

