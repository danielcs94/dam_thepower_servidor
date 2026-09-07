<?php
//Incluyo mi fichero de conectores
require_once "conectores.php";

use MongoDB\Driver\Manager;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Query;

//Instancio mi clase de conector
$conec = new Conectores();

//Me traigo los datos de BBDD
$conec->conectarMongodb();
$conexion = $conec->getManagerMongodb();

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $id = $_POST['id'] ?? '';

    //Creo mis dos clases de las entidades que necesito

    // Llamamos a la función correspondiente
    switch ($accion) {
        case 'guardar':
            guardar($id);
            volver($error, $list);
            break;
        case 'eliminar':
            eliminar($id);
            volver($error, $list);
            break;
        case 'anadir':
            anadir($id);
            volver($error, $list);
            break;
        case 'anadirPla':
            anadirPla();
            volver($error, $list);
            break;
        case 'modificarPla':
            modificarPla();
           volver($error, $list);
            break;
        case 'eliminarPla':
            eliminarPla();
            volver($error, $list);
            break;

        default:
    }
}

function anadirPla()
{
    global $conexion;
    $nuePlataforma = $_POST['nuePlataforma']  ?? '';
    $pla = [
        'nombre' => $nuePlataforma,
        'juegos' => []
    ];
    $bwplataforma = new BulkWrite();
    $bwplataforma->insert($pla);
    $conexion->executeBulkWrite('videojuegos_db.plataformas', $bwplataforma);
}

function modificarPla()
{
    global $conexion;
    $nuePlataforma = $_POST['nuePlataforma']  ?? '';
    $antPlataforma = $_POST['antPlataforma']  ?? '';

    print_r($nuePlataforma);
    print_r($antPlataforma);

    $filtro = ['$and' => [['nombre' => $antPlataforma]]];
    $cambio = ['$set' => ['nombre' => $nuePlataforma]];
    $bwplataforma = new BulkWrite();
    $bwplataforma->update($filtro, $cambio, ['multi' => true]);
    $conexion->executeBulkWrite('videojuegos_db.plataformas', $bwplataforma);
}

function eliminarPla()
{
    global $conexion;
    $nuePlataforma = $_POST['nuePlataforma']  ?? '';
    $bwplataforma = new BulkWrite();
    $filtro = ['$and' => [['nombre' => $nuePlataforma]]];
    $bwplataforma->delete($filtro, ['limit' => false]);
    $conexion->executeBulkWrite('videojuegos_db.plataformas', $bwplataforma);
}

function guardar($id)
{
    $id = str_replace(" ", "_", $id);
    global $conexion;
    $titulo = $_POST['titulo' . $id]  ?? '';
    $anio = $_POST['anio' . $id] ?? '';
    $metacritic = $_POST['metacritic' . $id] ?? '';
    $plataforma_id = ($_POST['plataforma_id' . $id]  ?? '');
    $plataforma_id_ant = ($_POST['plataforma_id_ant' . $id]  ?? '');

    //Me traigo la plataforma que quiero modificar
    $plataforma = $conexion->executeQuery("videojuegos_db.plataformas", new Query(
        ['nombre' => ['$eq' => $plataforma_id]],
        []
    ));

    $plataforma_ant = $conexion->executeQuery("videojuegos_db.plataformas", new Query(
        ['nombre' => ['$eq' => $plataforma_id_ant]],
        []
    ));

    $plataforma = iterator_to_array($plataforma);
    $plataforma_ant = iterator_to_array($plataforma_ant);

    //Extraigo sus datos de juegos
    $juegos = [];
    $juegos_ant = [];
    foreach ($plataforma as $p) {
        if ((isset($p->juegos))) {
            $juegos = $p->juegos;
        }
    }

    foreach ($plataforma_ant as $p_ant) {
        if ((isset($p_ant->juegos))) {
            $juegos_ant = $p_ant->juegos;
        }
    }

    $arrId = explode("-", $id);
    $id_juego = $arrId[1];
    if ($plataforma_id == $plataforma_id_ant) {
        //Si la plataforma no cambia le modifico solo la coleccion
        //Recorro los juegos y modifico el del id con los datos de los campos
        foreach ($juegos as $j) {
            if ($j->id == $id_juego) {
                $j->anio = $anio;
                $j->titulo = $titulo;
                $j->metacritic = $metacritic;
                break;
            }
        }

        //Lanzo la consulta modificacion sobre la tabla plataformas 
        $filtro = ['$and' => [['nombre' => $plataforma_id]]];
        $cambio = ['$set' => ['juegos' => $juegos]];

        $bwplataforma = new BulkWrite();
        $bwplataforma->update($filtro, $cambio, ['multi' => false]);
        $conexion->executeBulkWrite("videojuegos_db.plataformas", $bwplataforma);
    } else {
        //Si la plataforma cambia 
        //Me cargo el juego de la plataforma antigua
        $juegos_fil = array_values(array_filter($juegos_ant, function ($j) use ($id_juego) {
            return $j->id != $id_juego;
        }));


        //Lanzo la consulta modificacion sobre la tabla plataformas 
        $filtro_ant = ['$and' => [['nombre' => $plataforma_id_ant]]];
        $cambio_ant = ['$set' => ['juegos' => $juegos_fil]];

        $bwplataforma_ant = new BulkWrite();
        $bwplataforma_ant->update($filtro_ant, $cambio_ant, ['multi' => false]);
        $conexion->executeBulkWrite("videojuegos_db.plataformas", $bwplataforma_ant);

        //Ahora añado el juego con sus valores cambiados a la nueva plataforma
        $idmax = generarIdMax($juegos);
        $j = (object)["id" => $idmax, "titulo" => $titulo, "metacritic" => $metacritic, "anio" => $anio];

        array_push($juegos, $j);
        //Lanzo la consulta modificacion sobre la tabla plataformas 
        $filtro = ['$and' => [['nombre' => $plataforma_id]]];
        $cambio = ['$set' => ['juegos' => $juegos]];

        $bwplataforma = new BulkWrite();
        $bwplataforma->update($filtro, $cambio, ['multi' => false]);
        $conexion->executeBulkWrite("videojuegos_db.plataformas", $bwplataforma);
    }
}

function anadir($id)
{
    $id = str_replace(" ", "_", $id);
    global $conexion;
    $titulo = $_POST['titulo0']  ?? '';
    $anio = $_POST['anio0'] ?? '';
    $metacritic = $_POST['metacritic0'] ?? '';
    $plataforma_id = ($_POST['plataforma_id0']  ?? '');

    //Me traigo la plataforma que quiero modificar
    $plataforma = $conexion->executeQuery("videojuegos_db.plataformas", new Query(
        ['nombre' => ['$eq' => $plataforma_id]],
        []
    ));

    $plataforma = iterator_to_array($plataforma);

    //Extraigo sus datos de juegos
    $juegos = [];
    foreach ($plataforma as $p) {
        if ((isset($p->juegos))) {
            $juegos = $p->juegos;
        }
    }

    //Ahora añado el juego con sus valores cambiados a la nueva plataforma
    $idmax = generarIdMax($juegos);
    $j = (object)["id" => $idmax, "titulo" => $titulo, "metacritic" => $metacritic, "anio" => $anio];

    array_push($juegos, $j);
    //Lanzo la consulta modificacion sobre la tabla plataformas 
    $filtro = ['$and' => [['nombre' => $plataforma_id]]];
    $cambio = ['$set' => ['juegos' => $juegos]];

    $bwplataforma = new BulkWrite();
    $bwplataforma->update($filtro, $cambio, ['multi' => false]);
    $conexion->executeBulkWrite("videojuegos_db.plataformas", $bwplataforma);
}

function eliminar($id)
{
    global $conexion;
    $id = str_replace(" ", "_", $id);
    $plataforma_id = ($_POST['plataforma_id' . $id]  ?? '');

    //Me traigo la plataforma que quiero modificar
    $plataforma = $conexion->executeQuery("videojuegos_db.plataformas", new Query(
        ['nombre' => ['$eq' => $plataforma_id]],
        []
    ));

    $plataforma = iterator_to_array($plataforma);

    //Extraigo sus datos de juegos
    $juegos = [];

    foreach ($plataforma as $p) {
        if ((isset($p->juegos))) {
            $juegos = $p->juegos;
        }
    }

    $arrId = explode("-", $id);
    $id_juego = $arrId[1];

    //Si la plataforma cambia 
    //Me cargo el juego de la plataforma antigua
    $juegos_fil = array_values(array_filter($juegos, function ($j) use ($id_juego) {
        return $j->id != $id_juego;
    }));


    //Lanzo la consulta modificacion sobre la tabla plataformas 
    $filtro = ['$and' => [['nombre' => $plataforma_id]]];
    $cambio = ['$set' => ['juegos' => $juegos_fil]];

    $bwplataforma = new BulkWrite();
    $bwplataforma->update($filtro, $cambio, ['multi' => false]);
    $conexion->executeBulkWrite("videojuegos_db.plataformas", $bwplataforma);
}

function volver($error = "", $list = false)
{
    //Volvemos a la página que ha hecho el submit en caso de error
    header('Location: juegos_crud_mongo_db.php?ok=1');
    exit();
}

function generarIdMax($juegos)
{
    $idmax = 1;

    if (isset($juegos)) {
        $icuenta=count($juegos);
        $idmax = $icuenta+1;
    }

    return $idmax;
}
