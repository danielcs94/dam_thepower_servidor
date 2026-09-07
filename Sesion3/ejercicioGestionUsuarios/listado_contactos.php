<?php
//Me traigo el fichero que tiene todas las librerias básicas del proyecto
require_once "utils.php";
require_once "./models/Contactos.php";
require_once "./models/Clientes.php";


$con = new Contacto();
$cli = new Cliente();

//Me traigo el cliente_id si vienen los contactos de un cliente
$cliente_id = (int)($_GET['cliente_id'] ?? 0);

$filter = "";
$nombre_cliente = "";
if ($cliente_id > 0) {
    $filter = " where cliente_id=$cliente_id";

    //Me traigo el nombre del cliente para pintarlo
    $cli = $cli->obtenerPorId($pdo, $cliente_id);
    $nombre_cliente = " de ". $cli->getNombre();
}

$contactos = $con->obtenerTodos($pdo, $filter);

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
    <title>Listado de Contactos </title>
    <link rel="stylesheet" href="./estilos/estilos.css">
    <script src="./scripts/scripts.js"></script>
</head>

<body>
    <div class="tabla-contenedor">

        <h1>Listado de Contactos <?= $nombre_cliente ?></h1>
        <button class="btn cerrarsesion" onclick="cerrarSesion()">
            Cerrar Sesion
        </button>
        <button class="btn cerrarsesion" onclick="IrListadoClientes()">
            Clientes
        </button>
        <?php if ($rol_id_usuario == 1): ?>
        <a href="#" onclick="javascript:IrFichaContacto(true)" class="btn primary anadir">➕ Añadir Contacto</a>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Cliente</th>
                <?php if ($rol_id_usuario == 1): ?>
                <th>Acciones</th>
                <?php endif; ?>
            </tr>

            <?php foreach ($contactos as $c): ?>
            <tr>
                <td><?= $c->getId() ?></td>
                <td><?= $c->getNombre() ?></td>
                <td><?= $c->getApellidos() ?></td>
                <td><?= $c->getEmail() ?></td>
                <td><?= $c->getTelefono() ?></td>
                <?php
                $cliente = "";
                $cliente_id = $c->getClienteId();
                $cli = $cli->obtenerPorId($pdo, $cliente_id);
                ?>
                <td><?= $cli->getNombre() ?></td>
                <?php if ($rol_id_usuario == 1): ?>
                <td class="acciones">
                    <a class="btn editar"
                        href="ficha_contacto.php?contacto_id=<?= $c->getId() ?>&listado=true">
                        Editar
                    </a>

                    <button class="btn borrar"
                        onclick="eliminarContacto(<?= $c->getId() ?>)">
                        Borrar
                    </button>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
    <form action="" method="post" id="frmEli" name="frmEli" style="visibility: hidden;">
        <input type="hidden" name="contacto_id" id="contacto_id">
    </form>
</body>

</html>