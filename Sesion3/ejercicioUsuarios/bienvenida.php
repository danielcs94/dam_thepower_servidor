<?php
require_once "sesiones.php";
require_once "../encriptador.php";

$usu = $_SESSION["usuario"];
//Compruebo si el usuario a iniciado sesion 
if (isset($usu["nombre"]) && isset($usu["password"]) && $usu["nombre"] != "" && $usu["password"] != "") {
    echo "El usuario " . ($usu["nombre"] ?? '') . " y contraseña " . (descifrar($usu["password"]) ?? '') . "";

    //Llamamos al valor que nos incrementa la cookie
    cookieVisitas();
    echo "Numero de visitas " . $_COOKIE["visitas"];
} else {
    header('Location: login.php?accion=error');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="scripts.js"></script>
</head>

<body>
    <!-- CHICOS ESTO ES UNA CHAPUZA PERO ES LA ÚNICA MANERA QUE SE ME OCURRE SIN USAR UNA API -->
    <script>
        window.addEventListener("message", function(event) {
            if (event.data === "sesionFinalizada") {
                window.location.href = "login.php?accion=sesionFinalizada";
            }
        }, false);
    </script>
    <iframe src="checkSesion.php" width="150" height="150"></iframe>
</body>

</html>