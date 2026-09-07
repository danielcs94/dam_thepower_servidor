<?php

//Me traigo el fichero que tiene todas las librerias básicas del proyecto
require_once "utils.php";

//Incluyo mi clases necesarias
require_once "./models/Contactos.php";

//Me instancio mi clase de contacto
$con = new Contacto();

// Obtenemos la acción del query string
$accion = $_GET['action'] ?? '';
$list = $_GET['listado'] ?? false;

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $cliente_id = (int)($_POST['cliente_id']  ?? 0);
    $contacto_id = (int)($_POST['contacto_id']  ?? 0);

    //Creo mis dos clases de las entidades que necesito
    $con = new Contacto();
    $con = $con->obtenerPorId($pdo, (int)$contacto_id);

    $con->setNombre($nombre);
    $con->setEmail($email);
    $con->setTelefono($telefono);
    $con->setApellidos($apellidos);
    $con->setClienteId($cliente_id);
    $con->setId($contacto_id);

    // Llamamos a la función correspondiente
    switch ($accion) {
        case 'guardar':
            $error = validar();
            if ($error == "") {
                $con->guardar($pdo);
            }
            volver($error, $list);
            break;
        case 'eliminar':
            print_r("elimina");
            $error = validar();
            print_r($error);
            if ($error == "") {
                $con->eliminar($pdo);
            }
            volver($error, $list);
            break;
        case 'anadir':
            $error = validar();
            if ($error == "") {
                $con->guardar($pdo);
            }
            volver($error, $list);
            break;

        default:
    }
}

function volver($error = "", $list = false)
{

    global $nombre;
    global $email;
    global $telefono;
    global $apellidos;
    global $contacto_id;
    global $cliente_id;

    //Volvemos a la página que ha hecho el submit en caso de error
    if ($error == "") {
        header('Location: listado_contactos.php?ok=1');

    } else {
        header('Location: ficha_contacto.php?error=' . $error . '&nombre=' . $nombre . '&email=' . $email . '&telefono=' . $telefono . '&apellidos=' . $apellidos . '&cliente_id=' . $cliente_id . '&contacto_id=' . $contacto_id . '');
    }
    exit();
}

function validar(): string
{
    global $accion;
    global $nombre;
    global $telefono;
    global $email;
    global $contacto_id;
    global $cliente_id;
    global $pdo;
    $error = "";

    switch ($accion) {
        case 'guardar':
            if (!(isset($contacto_id)) || $contacto_id == 0) {
                $error .= "Tiene que seleccionar un contacto para poder modificarlo--";
            }

            if (comprobarPatronEmail($email) == false) {
                $error .= "El email no tiene el formato correcto--";
            }

            if (comprobarTelefono($telefono) == false) {
                $error .= "El teléfono no es un número de España--";
            }

            if (!(isset($cliente_id)) || $cliente_id == "" || $cliente_id == "0") {
                $error .= "Es necesario seleccionar un cliente--";
            }

            if (!(isset($nombre)) || $nombre == "") {
                $error .= "Es necesario rellenar el campo nombre--";
            }
            break;
        case 'eliminar':
            if (!(isset($contacto_id)) || $contacto_id == 0) {
                $error .= "Tiene que seleccionar un contacto para poder eliminarlo";
            }
            break;
        case 'anadir':
            if (comprobarPatronEmail($email) == false) {
                $error .= "El email no tiene el formato correcto--";
            }

            if (comprobarTelefono($telefono) == false) {
                $error .= "El teléfono no es un número de España--";
            }

            if (!(isset($cliente_id)) || $cliente_id == "" || $cliente_id == "0") {
                $error .= "Es necesario seleccionar un cliente--";
            }

            if (!(isset($nombre)) || $nombre == "") {
                $error .= "Es necesario rellenar el campo nombre--";
            }
            break;

        default:
            break;
    }

    return $error;
}
