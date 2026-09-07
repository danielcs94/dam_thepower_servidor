<?php
$datos = array(
    "DAW" => array(
        array("modulo" => "Lenguaje de marcas", "curso" => 1, "horas" => 3),
        array("modulo" => "Sistemas informáticos", "curso" => 1, "horas" => 5),
        array("modulo" => "Despliegue de aplicaciones web", "curso" => 2, "horas" => 4)
    )
);
$json = json_encode($datos);
$bytes = file_put_contents("modulos.json", $json);
?>
