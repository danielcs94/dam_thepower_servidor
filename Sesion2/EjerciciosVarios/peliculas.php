<?php

//Lo primero me traigo el fichero de datos
require_once "datos.php";

//Es de buen programador declararse las funciones arriba


//++ARRAY NORMAL

//Ordeno por orden alfabetico
$movieTitlesOrd = [];
$movieTitlesOrd = $movieTitles;
sort($movieTitlesOrd);
pintarArrayTabla($movieTitlesOrd);

//Saco la posicion 11 y 15 en otro array
$arr11_15 = array_slice($movieTitles, 11, 5, false);
pintarArrayTabla($arr11_15);

//Hago un array nuevo a partir del otro
$nueMoviesTitle = [];
$nueMoviesTitle = $movieTitles;
$nueMoviesTitle[14] = "Interestelar";
pintarArrayTabla($nueMoviesTitle);

//Añado al principio la mejor pelicula de todos los tiempos
array_unshift($movieTitlesOrd, "Yo hice a Roque tercero");
pintarArrayTabla($movieTitlesOrd);

//Añado al final la mejor pelicula de todos los tiempos
array_push($movieTitlesOrd, "Brácula: Condemor II");
pintarArrayTabla($movieTitlesOrd);
//--ARRAY NORMAL

//++ARRAY ASOCIATIVO
//Vamos a hacer lo mismo para el array asociativo
usort($bestMovies, function ($a, $b) {
    return $a['title'] <=> $b['title'];  // funciona con arrays complejos
});
pintarArrayTabla($bestMovies);

//Saco la posicion 11 y 15 en otro array
$bestMovies11_15 = array_slice($bestMovies, 11, 5, false);
pintarArrayTabla($bestMovies11_15);

//Hago un array nuevo a partir del otro
$nuebestMovies = [];
$nuebestMovies = $bestMovies;
$nuebestMovies[14] = ["title" => "Interestellar", "director" => "Christopher Nolan", "actor" => "Matthew McConaughey"];
pintarArrayTabla($nuebestMovies);

//Añado al principio la mejor pelicula de todos los tiempos
array_unshift($bestMovies, ["title" => "Yo hice a Roque Tercero", "director" => "Mariano Ozores", "actor" => "Andrés Pajares"]);
pintarArrayTabla($bestMovies);

//Añado al final la mejor pelicula de todos los tiempos
array_push($bestMovies, ["title" => "Brácula Condemor III", "director" => "Por la gloria de mi madre", "actor" => "Chiquitorrrr"]);
pintarArrayTabla($bestMovies);
//--ARRAY ASOCIATIVO


//++ NUEVO ELEMENTO
//director -numero de veces - pesado
$arrElementos = [];
foreach ($bestMovies as $mov) {
    //Saco el director
    $director = $mov['director'];

    //Compruebo si el director esta en el array nuevo
    $arrDir = array_filter($arrElementos, function ($obj) use ($director) {
        if(isset($obj)){
            return $obj['Director'] == $director;
        }else{
            return false;
        }
    });

    $icuenta=count($arrDir);
    //Si no esta lo proceso
    if ($icuenta == 0) {

        //Cuento las veces que aparece el director
        $arrDirExis = array_filter($bestMovies, function ($obj) use ($director) {
            return $obj['director'] == $director;
        });
        $icuenta = count($arrDirExis);

        //Compruebo a Nolan
        $btiene = false;
        if ($director == "Christopher Nolan") {
            $btiene = true;
        }

        //Añado el elemento
        array_push($arrElementos, ["Director" => $director, "Veces" => $icuenta, "pesado" => $btiene===true?"MAZO":"NOLAN ES EL MEJOR"]);
    }
}
pintarArrayTabla($arrElementos);
//-- NUEVO ELEMENTO
