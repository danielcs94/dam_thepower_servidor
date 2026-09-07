<?php
//Incluyo mi fichero de conectores
require_once "conectores.php";

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

        default:
    }
}

function guardar($id)
{
    $id = str_replace(" ", "_", $id);
    global $conexion;
    $nombre = $_POST['nombre' . $id]  ?? '';
    $apellidos = $_POST['apellidos' . $id] ?? '';
    $sexo = $_POST['sexo' . $id] ?? '';
    $es_profe_sexi = $_POST['es_profe_sexi' . $id] ?? 'false';
    $fila_id = (int)($_POST['fila_id' . $id]  ?? 0);
    $fila_id_ant = (int)($_POST['fila_id_ant' . $id]  ?? 0);

    //Me traigo la fila que quiero modificar
    $fila = $conexion->executeQuery("videojuegos_db.filas", new Query(
        ['fila_id' => ['$eq' => $fila_id]],
        []
    ));

    $fila_ant = $conexion->executeQuery("videojuegos_db.filas", new Query(
        ['fila_id' => ['$eq' => $fila_id_ant]],
        []
    ));

    $fila = iterator_to_array($fila);
    $fila_ant = iterator_to_array($fila_ant);

    //Extraigo sus datos de alumnos
    $alumnos = [];
    $alumnos_ant = [];
    foreach ($fila as $p) {
        if ((isset($p->alumnos))) {
            $alumnos = $p->alumnos;
        }
    }

    foreach ($fila_ant as $p_ant) {
        if ((isset($p_ant->alumnos))) {
            $alumnos_ant = $p_ant->alumnos;
        }
    }


    $arrId = explode("-", $id);
    $id_alumno = $arrId[1];
    if ($fila_id == $fila_id_ant) {
        //Si la fila no cambia le modifico solo la coleccion
        //Recorro los alumnos y modifico el del id con los datos de los campos
        foreach ($alumnos as $j) {
            $mixnomape = $j->nombre . "##" . $j->apellidos;
            if ($mixnomape == $id_alumno) {
                $j->nombre = $nombre;
                $j->apellidos = $apellidos;
                $j->sexo = $sexo;
                $j->es_profe_sexi = $es_profe_sexi == "on" ? true : false;
                break;
            }
        }

        //Lanzo la consulta modificacion sobre la tabla fila 
        $filtro = ['$and' => [['fila_id' => $fila_id]]];
        $cambio = ['$set' => ['alumnos' => $alumnos]];

        $bwfila = new BulkWrite();
        $bwfila->update($filtro, $cambio, ['multi' => false]);
        $conexion->executeBulkWrite("videojuegos_db.filas", $bwfila);
    } else {
        //Si la fila cambia 
        //Me cargo el juego de la fila antigua
        $alumnos_fil = array_values(array_filter($alumnos_ant, function ($j) use ($id_alumno) {
            $mixnomape = $j->nombre . "##" . $j->apellidos;
            if ($mixnomape == $id_alumno) {
                return false;
            } else {
                return true;
            }
        }));

        //Lanzo la consulta modificacion sobre la tabla filas 
        $filtro_ant = ['$and' => [['fila_id' => $fila_id_ant]]];
        $cambio_ant = ['$set' => ['alumnos' => $alumnos_fil]];

        $bwfila_ant = new BulkWrite();
        $bwfila_ant->update($filtro_ant, $cambio_ant, ['multi' => false]);
        $conexion->executeBulkWrite("videojuegos_db.filas", $bwfila_ant);

        //Ahora añado el alumno con sus valores cambiados a la nueva fila

        $j = (object)["id" => $fila_id . "-" . $nombre, "nombre" => $nombre, "apellidos" => $apellidos, "sexo" => $sexo, "es_profe_sexi" => $es_profe_sexi == "on" ? true : false];

        array_push($alumnos, $j);
        //Lanzo la consulta modificacion sobre la tabla filas 
        $filtro = ['$and' => [['fila_id' => $fila_id]]];
        $cambio = ['$set' => ['alumnos' => $alumnos]];

        $bwfila = new BulkWrite();
        $bwfila->update($filtro, $cambio, ['multi' => false]);
        $conexion->executeBulkWrite("videojuegos_db.filas", $bwfila);
    }
}

function anadir($id)
{
    $id = str_replace(" ", "_", $id);
    global $conexion;
    $nombre = $_POST['nombre0']  ?? '';
    $apellidos = $_POST['apellidos0'] ?? '';
    $sexo = $_POST['sexo0'] ?? '';
    $es_profe_sexi = $_POST['es_profe_sexi0'] ?? 'false';
    $fila_id = (int)($_POST['fila_id0']  ?? 0);

    $j = (object)["id" => $fila_id . "-" . $nombre, "nombre" => $nombre, "apellidos" => $apellidos, "sexo" => $sexo, "es_profe_sexi" => $es_profe_sexi];
    print_r($j);
    print_r("<br>");

    print_r($fila_id);

    //Me traigo la fila que quiero modificar
    $fila = $conexion->executeQuery("videojuegos_db.filas", new Query(
        ['fila_id' => ['$eq' => $fila_id]],
        []
    ));

    $fila = iterator_to_array($fila);

    //Extraigo sus datos de alumnos
    $alumnos = [];
    foreach ($fila as $p) {
        if ((isset($p->alumnos))) {
            $alumnos = $p->alumnos;
        }
    }

    //Ahora añado el alumno con sus valores cambiados a la nueva fila
    $j = (object)["id" => $fila_id . "-" . $nombre, "nombre" => $nombre, "apellidos" => $apellidos, "sexo" => $sexo, "es_profe_sexi" => $es_profe_sexi == "on" ? true : false];

    array_push($alumnos, $j);
    //Lanzo la consulta modificacion sobre la tabla fila 
    $filtro = ['$and' => [['fila_id' => $fila_id]]];
    $cambio = ['$set' => ['alumnos' => $alumnos]];

    $bwfila = new BulkWrite();
    $bwfila->update($filtro, $cambio, ['multi' => false]);
    $conexion->executeBulkWrite("videojuegos_db.filas", $bwfila);
}

function eliminar($id)
{
    global $conexion;
    $id = str_replace(" ", "_", $id);
    $fila_id = (int)($_POST['fila_id' . $id]  ?? 0);

    //Me traigo la fila que quiero modificar
    $fila = $conexion->executeQuery("videojuegos_db.filas", new Query(
        ['fila_id' => ['$eq' => $fila_id]],
        []
    ));

    $fila = iterator_to_array($fila);

    //Extraigo sus datos de alumnos
    $alumnos = [];

    foreach ($fila as $p) {
        if ((isset($p->alumnos))) {
            $alumnos = $p->alumnos;
        }
    }

    $arrId = explode("-", $id);
    $id_alumno = $arrId[1];

    $alumnos_fil = array_values(array_filter($alumnos, function ($j) use ($id_alumno) {
        $mixnomape = $j->nombre . "##" . $j->apellidos;
        if ($mixnomape == $id_alumno) {
            return false;
        } else {
            return true;
        }
    }));

    //Lanzo la consulta modificacion sobre la tabla filas 
    $filtro = ['$and' => [['fila_id' => $fila_id]]];
    $cambio = ['$set' => ['alumnos' => $alumnos_fil]];

    $bwfila = new BulkWrite();
    $bwfila->update($filtro, $cambio, ['multi' => false]);
    $conexion->executeBulkWrite("videojuegos_db.filas", $bwfila);
}

function volver($error = "", $list = false)
{
    //Volvemos a la página que ha hecho el submit en caso de error
    header('Location: alumnos_crud_mongo_db.php?ok=1');
    exit();
}

