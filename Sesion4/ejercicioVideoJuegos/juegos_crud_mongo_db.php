<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/scripts.js"></script>
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

    //Me traigo las plataformas para cargar los datos de los desplegables
    $plataformas = $conexion->executeQuery("videojuegos_db.plataformas", new Query([], []));

    //Me traigo los juegos 
    $juegos = [];

    //Me guardo la cadena de plataformas para añadirla luego
    $plataformas = iterator_to_array($plataformas);

    $optionsHTML = '';
    foreach ($plataformas as $p) {
        $optionsHTML .= '##' . $p->nombre . '-' . $p->nombre . '##';
        if ((isset($p->juegos))) {
            foreach ($p->juegos as $j) {
                $nuevoItem = (object)["id" => $p->nombre . '-' . $j->id, "nombre" => $p->nombre, "titulo" => $j->titulo, "metacritic" => $j->metacritic, "anio" => $j->anio];
                array_push($juegos, $nuevoItem);
            }
        }
    }



    //pinto mi tabla con mis campos 
    ?>
    <form action="ficha_guardar_juego.php" name="frmGuardar" id="frmGuardar" method="POST">
        <input id="id" name="id" type="hidden" value="" />
        <input id="accion" name="accion" type="hidden" value="" />
        <!-- ME HAGO UNA CAJA DE TEXTO VACIA PARA AÑADIR LA PLATAFORMA CON SU BOTON -->
        <label for="nuePlataforma">Nueva Plataforma</label>
        <input type="text" id="nuePlataforma" name="nuePlataforma" value="" />
        <label for="antPlataforma">Plataforma Antigua</label>
        <input type="text" id="antPlataforma" name="antPlataforma" value="" />
        <input type="button" id="btnAdd" name="btnAdd" value="Add Plataforma" onclick="anadirPlataforma()"/>
        <input type="button" id="btnMod" name="btnMod" value="Mod Plataforma" onclick="modificarPlataforma()"/>
        <input type="button" id="btnDel" name="btnDel" value="Del Plataforma" onclick="eliminarPlataforma()"/>
        <table id="tablaJuegos">
            <tr>
                <th>ID</th>
                <th>PLATAFORMA</th>
                <th>TITULO</th>
                <th>METACRITIC</th>
                <th>ANIO</th>
                <th>Acciones</th>
                <th><input type="button" class="btn borrar" onclick="nuevoRegistroMG('<?= $optionsHTML ?>')" value="+" /></th>
            </tr>

            <?php foreach ($juegos as $j): ?>
                <tr>
                    <td><input id="id<?= $j->id ?>" name="id<?= $j->id ?>" type="text" value="<?= $j->id ?>" readonly /></td>
                    <td>
                        <select name="plataforma_id<?= $j->id ?>" id="plataforma_id<?= $j->id ?>">
                            <option value="0">[Sin Plataforma]</option>
                            <?php foreach ($plataformas as $p): ?>
                                <option value="<?= $p->nombre ?>" <?= $p->nombre === $j->nombre ? 'selected' : '' ?>><?= $p->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input id="plataforma_id_ant<?= $j->id ?>" name="plataforma_id_ant<?= $j->id ?>" type="hidden" value="<?= $j->nombre ?>" />
                    </td>
                    <td><input id="titulo<?= $j->id ?>" name="titulo<?= $j->id ?>" type="text" value="<?= $j->titulo ?>" /></td>
                    <td><input id="metacritic<?= $j->id ?>" name="metacritic<?= $j->id ?>" type="number" value="<?= $j->metacritic ?>" /></td>
                    <td><input id="anio<?= $j->id ?>" name="anio<?= $j->id ?>" type="number" value="<?= $j->anio ?>" /></td>

                    <td class="acciones">
                        <input type="button" class="btn borrar" onclick="guardarJuegoMG('<?= $j->id ?>')" value="Guardar" />
                        <input type="button" class="btn borrar" onclick="eliminarJuegoMG('<?= $j->id ?>')" value="Borrar" />
                    </td>
                </tr>
            <?php endforeach; ?>



        </table>
    </form>
</body>

</html>