<?php
//Me traigo el fichero que tiene todas las librerias básicas del proyecto
require_once "utils.php";

//Incluyo mi clases necesarias
require_once "./models/Contactos.php";
require_once "./models/Clientes.php";

//Creo mis dos clases de las entidades que necesito
$cli = new Cliente();
$con = new Contacto();

$clientes = $cli->obtenerTodos($pdo);

//Me traigo el query string del id
$contacto_id = $_GET['contacto_id'] ?? '0';

//Me traigo el query string del error si lo hubiera
$error = $_GET['error'] ?? '';

//Me traigo el query string de si viene de listado
$listado = $_GET['listado'] ?? '';

//Esta variable me indica si es nuevo
$nuevo = false;

//Esta variable me indica si es usuario normal y no admin
$es_usuario = false;
//Declaro un objeto usuario nuevo
if (isset($contacto_id) == true && $contacto_id != 0) {
    //Viene de listado
    $nuevo = false;
} else {
    //Viene de inicio entonces es el alta de un usuario normal
    $nuevo = true;
}

//echo $nuevo;

//Si es nuevo lo creo vacio si no cargo sus datos
$nombre = "";
$email = "";
$telefono = "";
$apellidos = "";
$cliente_id = 0;

//Obtengo por id mi contacto
if ($error != "") {

    //Si tengo error me traigo los datos del get por que me ha dado un error de validacion y no los quiero rellenar otra vez

    $nombre = $_GET['nombre'] ?? '';
    $email = $_GET['email'] ?? '';
    $telefono = $_GET['telefono'] ?? '';
    $apellidos = $_GET['apellidos'] ?? '';
    $cliente_id = (int)($_GET['cliente_id'] ?? 0);

    echo "<script>alert('" . str_replace("--", "\\n", $error) . "')</script>";
} else {
    //Cojo los datos del usuario
    $con = $con->obtenerPorId($pdo, (int)$contacto_id);
    $nombre = $con->getNombre();
    $email = $con->getEmail();
    $telefono = $con->getTelefono();
    $apellidos = $con->getApellidos();
    $cliente_id = $con->getClienteId();
}

//Extraigo el usuario conectado
if (isset($_SESSION["usuario"])) {
    $usu_conectado = $_SESSION["usuario"];
    $rol_id_usuario = $usu_conectado->getRolId();
}

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php if ($nuevo): ?>
    <title>Nuevo Contacto</title>
    <?php else: ?>
    <title>Modificar Contacto</title>
    <?php endif; ?>
    <link rel="stylesheet" href="./estilos/estilos.css">
    <script src="./scripts/scripts.js"></script>
</head>

<body>
    <div class="container">
        <?php if ($nuevo): ?>
        <h1>Nuevo Contacto</h1>
        <?php else: ?>
        <h1>Modificar Contacto</h1>
        <?php endif; ?>


        <form method="post">
            <input type="hidden" id="contacto_id" name="contacto_id"
                value="<?= $contacto_id ?>">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre de contacto" required
                    value="<?= $nombre ?>">
            </div>
            <div>
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos"
                    value="<?= $apellidos ?>">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required
                    value="<?= $email ?>">
            </div>

            <div>
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" placeholder="teléfono" required
                    value="<?= $telefono ?>">
            </div>

            <div>
                <label for="cliente_id">Cliente</label>
                <select id="cliente_id" name="cliente_id" required>
                    <option value="0">
                        [Selecciona un Cliente]
                    </option>
                    <?php foreach ($clientes as $clien): ?>
                    <option value="<?= $clien->getId() ?>" <?= $clien->getId() === $cliente_id ? 'selected' : '' ?>>
                        <?= $clien->getNombre() ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if ($nuevo): ?>
            <button
                onclick="anadirContacto(<?= ($listado == 'true' ? 'true' : '') ?>)">Crear
                Contacto de Cliente</button>
            <?php else: ?>
            <button
                onclick="modificarContacto(<?= ($listado == 'true' ? 'true' : '') ?>)">Modificar
                Contacto de Cliente</button>
            <?php endif; ?>

        </form>
    </div>
</body>

</html>