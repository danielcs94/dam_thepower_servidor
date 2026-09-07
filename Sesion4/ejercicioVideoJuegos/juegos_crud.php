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
    //Incluyo mi fichero de conectores
    require_once "conectores.php";
    require_once "./Models/plataforma.php";
    require_once "./Models/videojuego.php";

    //Instancio mi clase de conector
    $conec = new Conectores();
    $vj = new Videojuego();
    $pla = new Plataforma();

    //Me traigo los datos de BBDD
    $conector = 'mysql';
    $conec->conectarMySql();
    $pdo = $conec->getPdoMySql();
    $juegos = $vj->obtenerTodos($pdo);

    //Me traigo las plataformas para cargar los datos de los desplegables
    $plataformas = $pla->obtenerTodos($pdo);

    //Me guardo la cadena de plataformas para añadirla luego
    $optionsHTML = '';

    foreach ($plataformas as $p) {
        $optionsHTML .= '##' . $p->getplataforma_id() . '-'
            . $p->getplataforma() .
            '##';
    }

    //pinto mi tabla con mis campos 
    ?>
    <form action="ficha_guardar_juego.php" name="frmGuardar" id="frmGuardar" method="POST">
        <input id="id" name="id" type="hidden" value="" />
        <input id="accion" name="accion" type="hidden" value="" />
        <table id="tablaJuegos">
            <tr>
                <th>ID</th>
                <th>PLATAFORMA</th>
                <th>TITULO</th>
                <th>METACRITIC</th>
                <th>ANIO</th>
                <th>Acciones</th>
                <th><input type="button" class="btn borrar" onclick="nuevoRegistro('<?= $optionsHTML ?>')" value="+" /></th>
            </tr>

            <?php foreach ($juegos as $j): ?>
                <tr>
                    <td><input id="id<?= $j->getvideo_juego_id() ?>" name="id<?= $j->getvideo_juego_id() ?>" type="text" value="<?= $j->getvideo_juego_id() ?>" readonly /></td>
                    <td>
                        <select name="plataforma_id<?= $j->getvideo_juego_id() ?>" id="plataforma_id<?= $j->getvideo_juego_id() ?>">
                            <option value="0">[Sin Plataforma]</option>
                            <?php foreach ($plataformas as $p): ?>
                                <option value="<?= $p->getplataforma_id() ?>" <?= $p->getplataforma_id() === $j->getplataforma_id() ? 'selected' : '' ?>><?= $p->getplataforma() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input id="titulo<?= $j->getvideo_juego_id() ?>" name="titulo<?= $j->getvideo_juego_id() ?>" type="text" value="<?= $j->gettitulo() ?>" /></td>
                    <td><input id="metacritic<?= $j->getvideo_juego_id() ?>" name="metacritic<?= $j->getvideo_juego_id() ?>" type="number" value="<?= $j->getmetacritic() ?>" /></td>
                    <td><input id="anio<?= $j->getvideo_juego_id() ?>" name="anio<?= $j->getvideo_juego_id() ?>" type="number" value="<?= $j->getanio() ?>" /></td>

                    <td class="acciones">
                        <input type="button" class="btn borrar" onclick="guardarJuego(<?= $j->getvideo_juego_id() ?>)" value="Guardar" />
                        <input type="button" class="btn borrar" onclick="eliminarJuego(<?= $j->getvideo_juego_id() ?>)" value="Borrar" />
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </form>
</body>

</html>