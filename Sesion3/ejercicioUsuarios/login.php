<?php
//Incluyo mi pagina de gestion de sesiones
require_once "sesiones.php";

//Incluyo mi pagina de gestion de encriptado
require_once "../encriptador.php";
//Inicializamos las variables
$usuario ="";
$password ="";

// Obtenemos la acción del query string
$accion = $_GET['accion'] ?? '';

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
};

// Llamamos a la función correspondiente
switch ($accion) {
    case 'login':
        //if (isset($usuario) && isset($password) && $usuario!= "" && $password!= "") {
        //Relleno la variable de sesion de usuario con el usuario y la de pass con la pass encriptándola
        $_SESSION["usuario_nombre"] = $usuario;
        $_SESSION["password"] = cifrar($password);
        crearSesion();
        header('Location: bienvenida.php?ok=1');
        //}
        // else{
        //     echo "<script>alert ('tienes que rellenar usuario y contraseña')</script>";
        // }

        break;
    case 'error':
        //Gestionamos la vuelta del error
        echo "<script>alert ('tienes que rellenar usuario y contraseña')</script>";
        break;
    case 'sesionFinalizada':
        //Comprobamos la sesion 
        echo "<script>alert ('Se ha caducado la sesión. Vuelva a introducir usuario y contraseña')</script>";
        break;


    default:
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Login</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h2>Iniciar sesión</h2>
    <form action="login.php?accion=login" method="post">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario"><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Ingresar">
    </form>
</body>

</html>