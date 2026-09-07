<?php

//Lo primero importo los datos de la libreria externa
require_once "datos.php";

//Recoger los datos del año si no vienen o es vacio saco el actual
$anio=date('Y');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['anio']) && $_POST['anio']!=""){
        $anio = $_POST['anio'];
    }
}

//Me declaro una variable de html
$shtml="<table border='1'>";
//Hago un bucle que me recorra los meses del año 
$iconta=1;
foreach ($Meses as $mes){
    //Inserto el texto del primer mes
    $textoMes=$mes['nombre'];
    $shtml.="<tr><td><b>". strtoupper($textoMes)."</b></td></tr>";    
    
    //Controlo si es febrero para controlar los bisiestos
    $idias=0;
    if($mes['nombre']=="Febrero"){
        $ianio=(int)$anio;
        $resto=$ianio % 4;
        if($resto==0){
            $idias=29;
        }else{
            $idias=28;
        }
    }else{
        $idias=$mes['dias'];
    }

    //Hago otro bucle por los dias del mes empezando por uno y terminando en la variable idias
    for ($i=1; $i<= $idias;$i++){
        
        //COntrolo que el mes tenga dos cifras
        $smes=$iconta<10? "0".(string)$iconta:(string)$iconta;

        //COntrolo que el dia tenga dos cifras
        $sdia=$i<10? "0".(string)$i:(string)$i;
        $sfecha="$anio/$smes/$sdia";

        //Saco el dia de la semana con la funcion
        $diasemana=diaDeLaSemana($sfecha);

        //El objetivo final es esta pinta Lunes 1 de Enero de 2024
        $objetivofinal="$diasemana $i de ". $mes['nombre'] ." de $anio";
        $shtml.="<tr><td>". $objetivofinal."</td></tr>";    
    }

    $iconta++;
}

//Cierro mi tabla
$shtml.="</table>";
echo $shtml;
