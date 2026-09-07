<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <script src="js/scripts.js"></script>
     <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php

    use MongoDB\Driver\Query;


    //Incluyo mi fichero de conectores
    require_once "conectores.php";

    //Instancio mi clase de conector
    $conec = new Conectores();

    //Me traigo los datos de BBDD
    $conec->conectarMongodb();
    $conexion = $conec->getManagerMongodb();

    //Me traigo las filas para cargar los datos de los desplegables
    $filas = $conexion->executeQuery("videojuegos_db.filas", new Query([], []));

    //Me traigo los alumnos 
    $alumnos = [];

    //Me guardo la cadena de filas para añadirla luego
    $filas = iterator_to_array($filas);

    $optionsHTML = '';
    foreach ($filas as $p) {
        $optionsHTML .= '##' . $p->fila_id . '-' . $p->fila_id . '##';
        if ((isset($p->alumnos))) {
            foreach ($p->alumnos as $j) {
                $nuevoItem = (object)[ "id" => (string)$p->fila_id .'-'. $j->nombre.'##'.$j->apellidos,"fila_id" => $p->fila_id, "nombre" => $j->nombre, "apellidos" => $j->apellidos, "sexo" => $j->sexo, "es_profe_sexi" => $j->es_profe_sexi];
                array_push($alumnos, $nuevoItem);
            }
        }
    }

    //pinto mi tabla con mis campos 
    ?>
    <form action="ficha_guardar_alumnos_mongodb.php" name="frmGuardar" id="frmGuardar" method="POST">
        <input id="id" name="id" type="hidden" value="" />
        <input id="accion" name="accion" type="hidden" value="" />
        <table id="tablaJuegos">
            <tr>
                <th>Id</th>
                <th>Fila</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Sexo</th>
                <th>Esta to bueno</th>
                <th><input type="button" class="btn borrar" onclick="nuevoRegistroMG('<?= $optionsHTML ?>')" value="+" /></th>
            </tr>

            <?php foreach ($alumnos as $j): ?>
                <tr>
                    <td><input id="id<?= $j->id ?>" name="id<?= $j->id ?>" type="text" value="<?= $j->id ?>" readonly /></td>
                    <td>
                        <select name="fila_id<?= $j->id ?>" id="fila_id<?= $j->id ?>">
                            <option value="0">[Sin Fila]</option>
                            <?php foreach ($filas as $p): ?>
                                <option value="<?= $p->fila_id ?>" <?= $p->fila_id === $j->fila_id ? 'selected' : '' ?>><?= $p->fila_id ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input id="fila_id_ant<?= $j->id ?>" name="fila_id_ant<?= $j->id ?>" type="hidden" value="<?= $j->fila_id ?>" />
                    </td>
                    <td><input id="nombre<?= $j->id ?>" name="nombre<?= $j->id ?>" type="text" value="<?= $j->nombre ?>" /></td>
                    <td><input id="apellidos<?= $j->id ?>" name="apellidos<?= $j->id ?>" type="text" value="<?= $j->apellidos ?>" /></td>
                    <td><select name="sexo<?= $j->id ?>" id="sexo<?= $j->id ?>">
                            <option value="0">[Sin Sexo]</option>
                            <option value="H" <?= $j->sexo === "H" ? 'selected' : '' ?>>H</option>
                            <option value="M" <?= $j->sexo === "M" ? 'selected' : '' ?>>M</option>
                        </select></td>
                    <td><input id="es_profe_sexi<?= $j->id ?>" name="es_profe_sexi<?= $j->id ?>" type="checkbox" <?= $j->es_profe_sexi === true ? 'checked' : '' ?> /></td>

                    <td class="acciones">
                        <input type="button" class="btn borrar" onclick="guardarAlumnoMG('<?= $j->id ?>')" value="Guardar" />
                        <input type="button" class="btn borrar" onclick="eliminarAlumnoMG('<?= $j->id ?>')" value="Borrar" />
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </form>
</body>

</html>