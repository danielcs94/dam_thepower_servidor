<?php
//Incluyo mi pagina de gestion de sesiones
require_once "sesiones.php";

// Obtenemos la acción del query string
$accion = $_GET['accion'] ?? '';

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Llamamos a la función correspondiente
    switch ($accion) {
        case 'checkSesion':
            //Comprobamos la sesion 
            $salida = comprobarSesion();
            if ($salida == false) {
                //Le mando un script de vuelta
                echo "<script>window.parent.volver();</script>";
            }
            break;

        default:
    }
};
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Login</title>
    <script src="scripts.js"></script>
</head>

<body>
    <h2>Iniciar sesión</h2>
    <form action="checkSesion.php?accion=checkSesion" method="post" name="frmCheck" id="frmCheck">
        <!-- CHICOS ESTO ES UNA CHAPUZA PERO ES LA ÚNICA MANERA QUE SE ME OCURRE SIN USAR UNA API -->
    </form>
    <script>
        setInterval(() => {
            console.log("Checkeo el tiempo de conexión");
            checkearSesion();

        }, 5000);
    </script>
</body>

</html>