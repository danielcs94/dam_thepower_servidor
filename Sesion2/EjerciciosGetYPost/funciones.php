<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $accion = $_GET['action'] ?? '';
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['sexo'];
    $estudiosGM = ($_POST['estudiosGM']) == "on" ? "SI" : "NO";

    
    echo "Nombre: $nombre<br>";
    echo "Apellido: $apellido<br>";
    echo "Dirección: $direccion<br>";
    echo "Sexo: $sexo<br>";
    echo "Estudios de Grado Medio: " . $estudiosGM . "<br>";

    
    
}

// function verificarInfo($nombre, $apellido, $direccion, $sexo, $estudiosGM){
//     $Nombre = trim($nombre);
//     $Apellido = trim($apellido);
//     $Direccion = trim($direccion);
//     $Sexo = trim($sexo);
//     $EstudiosGM = $estudiosGM;
//     if (gettype($Nombre) === 'string' && gettype($Apellido) === 'string' && gettype($Direccion) === 'string' && gettype($Sexo)? 'masculino' : 'femenino' && gettype($EstudiosGM) === 'boolean'){
//         echo "Valores correctos". true;
//     } else {
//         echo "Valores incorrectos". false;
        
//     }
// }
?>