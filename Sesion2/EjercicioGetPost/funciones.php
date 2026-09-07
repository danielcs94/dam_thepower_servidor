<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos la acción del query string
    $accion = $_GET['accion'] ?? '';
    $segundo = $_GET['segundo'] ?? '';

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    //$estudiosGMParsa = isset($_POST['estudiosGM'])?"ea":"oee";
   // $estudiosGM = $_POST['estudiosGM'];
    $sexo = $_POST['sexo'];

    $salestudios="";
    if(isset($_POST['estudiosGM'])){
        $salestudios=($_POST['estudiosGM']=="on"?"SI":"NO");
    }else{
        $salestudios="NO";
    }

    echo "<b>ACCION:&nbsp;</b>$accion<br>";
    echo "<b>SEGUNDO:&nbsp;</b>$segundo<br>";
    echo "<b>NOMBRE:&nbsp;</b>$nombre<br>";
    echo "<b>APELLIDOS:&nbsp;</b>$apellidos<br>";
    echo "<b>DIRECCION:&nbsp;</b>$direccion<br>";
    echo "<b>SEXO:&nbsp;</b>$sexo<br>";
    echo "<b>ESTUDIOS GRADO MEDIO:&nbsp;</b>$salestudios<br>";
}