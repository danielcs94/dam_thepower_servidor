<!DOCTYPE html>
<html>

<head>
    <title>Prueba</title>
</head>

<body>
    <h1>Datos recibidos LOLOLOLO</h1>
    <ul>
        <?php foreach ($datos as $clave => $valor): ?>
            <li><?= $clave ?> : <?= $valor ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>