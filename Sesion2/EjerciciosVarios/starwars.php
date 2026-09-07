<?php

//Lo primero me traigo el fichero de datos
require_once "datos.php";

$arrResults=$sw['results'];

//Filtro por las naves que tengan mas de 100 tripulantes
$arrDirExis = array_filter($arrResults, function ($nav) {
            //Hago una funcion que me controle registro a registro si tiene mas de 100 tripulantes
            $bSalida=false;

            //Checkeo si tiene nulos
            if(isset($nav['passengers'])){

                //Convierto a número la clave del array asociativo
                $iNum=(int)$nav['passengers'];
                if($iNum>100){
                    $bSalida=true;
                }else{
                    $bSalida=false;
                }
            }else{
                $bSalida=false;
            }
            return $bSalida;;
        });

//Extraigo solo las dos propiedades del array name y model
$mapArr=array_map(function ($nav){
        return [ "name" => $nav["name"],"model" => $nav["model"]];
},$arrDirExis);

//Pinto con mi super funcion la tabla de salida
pintarArrayTabla($mapArr);

//Pinto naves que tengan menos o igual que 100
//++Forma1
$arrDirMenos100_1 = array_filter($arrResults, function ($nav) {
            //Hago una funcion que me controle registro a registro si tiene mas de 100 tripulantes
            $bSalida=false;

            //Checkeo si tiene nulos
            if(isset($nav['passengers'])){

                //Convierto a número la clave del array asociativo
                $iNum=(int)$nav['passengers'];
                if($iNum<=100){
                    $bSalida=true;
                }else{
                    $bSalida=false;
                }
            }else{
                $bSalida=false;
            }
            return $bSalida;;
        });

//Extraigo solo las dos propiedades del array name y model
$mapArr_100_1=array_map(function ($nav){
        return [ "name" => $nav["name"],"model" => $nav["model"]];
},$arrDirMenos100_1);

//Pinto con mi super funcion la tabla de salida
pintarArrayTabla($mapArr_100_1);
//--Forma1

//++Forma2
$arrDirMenos100_2 = array_filter($arrResults, function ($nav) {
            //Hago una funcion que me controle registro a registro si tiene mas de 100 tripulantes
            $bSalida=false;

            //Checkeo si tiene nulos
            if(isset($nav['passengers'])){

                //Convierto a número la clave del array asociativo
                $iNum=(int)$nav['passengers'];
                if((int)$nav['passengers']<=100 || $nav['passengers']=="unknown"){
                    $bSalida=true;
                }else{
                    $bSalida=false;
                }
            }else{
                $bSalida=false;
            }
            return $bSalida;;
        });

//Extraigo solo las dos propiedades del array name y model
$mapArr_100_2=array_map(function ($nav){
        return [ "name" => $nav["name"],"model" => $nav["model"]];
},$arrDirMenos100_2);

//Pinto con mi super funcion la tabla de salida
pintarArrayTabla($mapArr_100_2);
//--Forma2

//++Forma3
function filtrarMasDe100($nav) {
            //Hago una funcion que me controle registro a registro si tiene mas de 100 tripulantes
            $bSalida=false;

            //Checkeo si tiene nulos
            if(isset($nav['passengers'])){

                //Convierto a número la clave del array asociativo
                $iNum=(int)$nav['passengers'];
                if((int)$nav['passengers']<=100 || $nav['passengers']=="unknown"){
                    $bSalida=true;
                }else{
                    $bSalida=false;
                }
            }else{
                $bSalida=false;
            }
            return $bSalida;;
        }
$arrDirMenos100_3 = array_filter($arrResults, 'filtrarMasDe100');

//Extraigo solo las dos propiedades del array name y model
$mapArr_100_3=array_map(function ($nav){
        return [ "name" => $nav["name"],"model" => $nav["model"]];
},$arrDirMenos100_3);

//Pinto con mi super funcion la tabla de salida
pintarArrayTabla($mapArr_100_3);
//--Forma3

//++Forma4
$arrDirMenos100_4 = array_filter($arrResults, fn($nav) => filtrarMasDe100($nav));

//Extraigo solo las dos propiedades del array name y model
$mapArr_100_4=array_map(function ($nav){
        return [ "name" => $nav["name"],"model" => $nav["model"]];
},$arrDirMenos100_4);

//Pinto con mi super funcion la tabla de salida
pintarArrayTabla($mapArr_100_4);
//--Forma4
