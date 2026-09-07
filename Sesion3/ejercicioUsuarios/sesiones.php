<?php
//Obligatorio en todas las páginas para la página tenga acceso a la sesion del servidor
session_start();

function crearSesion()
{
    //Esta funcion me crea una sesion con el usuario y la contraseña
    //Destruyo la sesion de usuario si existiera
    $usu = ["nombre" => "", "password" => ""];
    $usu["nombre"] = $_SESSION["usuario_nombre"];
    $usu["password"] = $_SESSION["password"];

    $_SESSION["usuario"] = $usu;
    $_SESSION["login_time"] = time();
}

function comprobarSesion(): bool
{
    $salida = true;
    //Esta funcion me comprueba si el usuario esta conectado en base a que haya pasado un minuto
    if ((time() - $_SESSION["login_time"]) > 60) {
        //Vacio la sesion 
        session_destroy();

        //Actualizo mi variable de salida
        $salida = false;
        //Le envio de nuevo al login
       // header('Location: login.php?accion=sesioncaducada');
    }
    return $salida;
}

function cookieVisitas()
{
    $visitas = 0;
    if (isset($_COOKIE["visitas"])&& isset($_COOKIE["fechacreacionvisitas"])) {
        //Compruebo si la cookie tiene que espirar
        $tiempocookie = (int)$_COOKIE["fechacreacionvisitas"];
        if ((time() - $tiempocookie) > 86400) {
            //Destruyo las cookies y me las cargo
            setcookie('visitas');
            setcookie('fechacreacionvisitas');
        } else {
            //Saco el valor de la cookie y la añado
            $visitas = (int)$_COOKIE["visitas"];
            $visitas += 1;
            setcookie('visitas', $visitas);
        }
    } else {
        setcookie('visitas', "1");
        setcookie('fechacreacionvisitas', time());
    }
}
