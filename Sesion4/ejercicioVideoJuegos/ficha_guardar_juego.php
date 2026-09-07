<?php
//Incluyo mi clases necesarias
require_once "conectores.php";
require_once "./models/videojuego.php";

$conec = new Conectores();

//Me traigo los datos de BBDD
$conector = 'mysql';
$conec->conectarMySql();
$pdo = $conec->getPdoMySql();

//Me instancio mi clase de Videojuego
$vj = new Videojuego();

// Obtenemos la acción del query string


// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $id = $_POST['id'] ?? '';

    $titulo = $_POST['titulo' . $id]  ?? '';
    $anio = $_POST['anio' . $id] ?? '';
    $metacritic = $_POST['metacritic' . $id] ?? '';
    $plataforma_id = (int)($_POST['plataforma_id' . $id]  ?? 0);


    //Creo mis dos clases de las entidades que necesito
    $vj = new Videojuego();
    $vj = $vj->obtenerPorId($pdo, (int)$id);

    $vj->settitulo($titulo);
    $vj->setanio($anio);
    $vj->setmetacritic($metacritic);
    $vj->setplataforma_id($plataforma_id);
    $vj->setvideo_juego_id($id);

    // Llamamos a la función correspondiente
    switch ($accion) {
        case 'guardar':
            $vj->guardar($pdo);
            volver($error, $list);
            break;
        case 'eliminar':
            $vj->eliminar($pdo);
            volver($error, $list);
            break;
        case 'anadir':
            $vj->guardar($pdo);
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
    header('Location: juegos_crud.php?ok=1');
    exit();
}
