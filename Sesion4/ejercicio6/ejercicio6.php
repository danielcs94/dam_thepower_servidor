<?php
try {
    $pdo = new PDO('mysql:host=localhost:3307;dbname=videojuegos_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
    echo '<h4>Conexión establecida</h4>';

    //Insertamos una nueva plataforma
    $sql = "INSERT INTO plataformas (nombre) VALUES ('NEOGEO')";
    $filasInsertadas = $pdo->exec($sql);
    echo "Se han añadido $filasInsertadas filas<br/>";

    


} catch (PDOException $e) {
    echo 'Error en la conexión: ' . $e->getMessage();
}

