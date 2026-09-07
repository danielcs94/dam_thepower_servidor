<?php
try {
    $pdo = new PDO('mysql:host=localhost:3307;dbname=videojuegos_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
    echo '<h4>Conexión establecida</h4>';

    $sql = "SELECT * FROM plataformas";
    $lista = $pdo->query($sql);
    echo "<h4>Lista de plataformas</h4>";
    while ($plat = $lista->fetch()) {
        echo "Id: " . $plat['id'] . "<br/>";
        echo "Nombre: " . $plat['nombre'] . "<br/>";
    }
} catch (PDOException $e) {
    echo 'Error en la conexión: ' . $e->getMessage();
}
