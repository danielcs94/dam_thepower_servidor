<?php
$email = "jorge.moreno@gmail.com";
$patron = '/^(?=.{1,64}@)(?!\.)(?!.*\.\.)([A-Za-z0-9._%+-]*[A-Za-z0-9_%+-])@gmail\.com$/i';

if (preg_match($patron, $email)) {
    echo "Tu correo electrónico $email es válido";
} else {
    echo "Tu correo electrónico $email no tiene un formato válido";
}


if (!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['dni'])) {

    echo "Hola, " . $_POST['nombre'] . " " . $_POST['apellidos'] . "<br/>";

    $dni = $_POST['dni'];
    $patron = '/^[09]{8}[A-Z]{1}$/';

    if (preg_match($patron, $dni)) {
        echo "Tu DNI $dni es válido";
    } else {
        echo "Tu DNI $dni no tiene un formato válido";
    }

} else {
    echo "Debes introducir el DNI para poderlo validar";
}


?>

