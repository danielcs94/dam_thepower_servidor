<?php
require_once 'funciones.php';
$filTitulo = '';
$filAutor = '';
$filLocalizacion = '';
$filEstado = '';
$filPrestado = '';

//Controlamos si viene con algún error de validación
$error = $_GET['error'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $filTitulo = $_POST['titulo'];
    $filAutor = $_POST['autor'];
    $filLocalizacion = $_POST['localizacion'];
    $filEstado = $_POST['estado'];
    $filPrestado = $_POST['prestado'];

}

//Listo los comics psándole las variables de filtro
$comics = [];
$comics = listarComics($filTitulo, $filAutor, $filLocalizacion, $filEstado, $filPrestado);

?>

<html>

<head>
    <title>Gestion de Comics</title>
    <script src="funciones.js"></script>
    <link rel="stylesheet" href="estilos.css">

</head>

<body>
    <?php
        //Si viene con error muestro el mensaje por pantalla
        if ($error != "") {
            ?>
    <script>
        let cadenaErr = "<?= $error ?>";
        //Cambio los guiones por comas y le quito la última
        let arrError = cadenaErr.split("-");
        cadenaErr = "";
        for (let err of arrError) {
            if (err != null && err != '') {
                cadenaErr += err + ",";
            }
        }
        cadenaErr = cadenaErr.substring(0, cadenaErr.length - 1);
        alert('No ha rellenado los siguientes campos obligatorios ' + cadenaErr)
    </script>
    <?php
        }

?>
    <div id="banner"></div>
    <form id="frm" name="frm" action="funciones.php" method="post">
        <input type="hidden" id="titulo" name="titulo">
        <input type="hidden" id="autor" name="autor">
        <input type="hidden" id="estado" name="estado">
        <input type="hidden" id="localizacion" name="localizacion">
        <input type="hidden" id="prestado" name="prestado">
        <input type="hidden" id="id" name="id">
        <div id="principal">
            <div id="cabecera">
                <div>Titulo</div>
                <div>Autor</div>
                <div>Estado</div>
                <div>Prestado</div>
                <div>Localización</div>
                <div>Botonera</div>
            </div>
            <div id="filtro">
                <div><input type="text" value="<?= $filTitulo ?>"
                        id="filTitulo" name="filTitulo" onchange="filtrar()" /></div>
                <div><input type="text" value="<?= $filAutor ?>"
                        id="filAutor" name="filAutor" onchange="filtrar()" /></div>
                <div>
                    <select id="filEstado" name="filEstado" onchange="filtrar()">
                        <option value=""></option>
                        <option value="pendiente de leer" <?= $filEstado === 'pendiente de leer' ? 'selected' : '' ?>>pendiente
                            de leer
                        </option>
                        <option value="leyendo" <?= $filEstado === 'leyendo' ? 'selected' : '' ?>>leyendo
                        </option>
                        <option value="leido" <?= $filEstado === 'leido' ? 'selected' : '' ?>>leído
                        </option>
                    </select>
                </div>
                <div><input type="checkbox" id="filPrestado" onchange="filtrar()"
                        <?= $filPrestado == "true" ? 'checked' : '' ?>/>
                </div>
                <div>
                    <select id="filLocalizacion" name="filLocalizacion" onchange="filtrar()">
                        <option value=""></option>
                        <option value="Estanteria1" <?= $filLocalizacion === 'Estanteria1' ? 'selected' : '' ?>>Estantería
                            1
                        </option>
                        <option value="Estanteria2" <?= $filLocalizacion === 'Estanteria2' ? 'selected' : '' ?>>Estantería
                            2</option>
                        <option value="Estanteria3" <?= $filLocalizacion === 'Estanteria3' ? 'selected' : '' ?>>Estantería
                            3
                        </option>
                    </select>
                </div>
                <input type="button" id="btnAnadir" onclick="anadirFila();" value="NUEVO" />
            </div>
            <div id="listado">
                <?php
                foreach ($comics as $comic) {
                    ?>
                <div class="fila">
                    <div><input type="text"
                            id="titulo<?= $comic->id ?>"
                            value="<?= $comic->titulo ?>" required />
                    </div>
                    <div><input type="text"
                            id="autor<?= $comic->id ?>"
                            value="<?= $comic->autor ?>" required />
                    </div>
                    <div> <select id="estado<?= $comic->id ?>"
                            name="estado<?= $comic->id ?>" required>
                            <option value=""></option>
                            <option value="pendiente de leer" <?= $comic->estado === 'pendiente de leer' ? 'selected' : '' ?>>pendiente
                                de leer
                            </option>
                            <option value="leyendo" <?= $comic->estado === 'leyendo' ? 'selected' : '' ?>>leyendo
                            </option>
                            <option value="leido" <?= $comic->estado === 'leido' ? 'selected' : '' ?>>leído
                            </option>
                        </select>
                    </div>
                    <div><input type="checkbox"
                            id="prestado<?= $comic->id ?>"
                            <?= $comic->prestado === true ? 'checked' : '' ?>/>
                    </div>
                    <div>
                        <select id="localizacion<?= $comic->id ?>"
                            name="localizacion<?= $comic->id ?>"
                            required>
                            <option value=""></option>
                            <option value="Estanteria1" <?= $comic->localizacion === 'Estanteria1' ? 'selected' : '' ?>>Estantería
                                1</option>
                            <option value="Estanteria2" <?= $comic->localizacion === 'Estanteria2' ? 'selected' : '' ?>>Estantería
                                2</option>
                            <option value="Estanteria3" <?= $comic->localizacion === 'Estanteria3' ? 'selected' : '' ?>>Estantería
                                3</option>
                        </select>
                    </div>
                    <div>
                        <input type="button" id="btnAnadir" onclick="anadirFila();" value="NUEVO" />
                        <input type="button" id="btnAnadir"
                            onclick="modificar('<?= $comic->id ?>');"
                            value="MOD" />
                        <input type="button" id="btnAnadir"
                            onclick="eliminar('<?= $comic->id ?>');"
                            value="DEL" />
                    </div>
                </div>
                <?php
                }
?>
            </div>
        </div>
    </form>
</body>

</html>