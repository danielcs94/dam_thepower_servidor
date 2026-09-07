<?php
try {
    $pdo = new PDO('mysql:host=localhost:3307;dbname=videojuegos_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
    echo '<h4>Conexión establecida</h4>';
     $pdo->beginTransaction(); // Inicia la transacción

    //Insertamos una nueva plataforma
    $sql = "INSERT INTO plataformas (nombre) VALUES ('NEOGEO')";
    $filasInsertadas = $pdo->exec($sql);
    echo "Se han añadido $filasInsertadas filas<br/>";

    //Insertamos una nueva plataforma
    $sql = "INSERT INTO plataformas  (nombre) VALUES ('GameBoy')";
    $filasInsertadas = $pdo->exec($sql);
    echo "Se han añadido $filasInsertadas filas<br/>";

    $pdo->commit(); // Confirma los cambios


} catch (Exception $e) {
    $pdo->rollBack(); // Revierte los cambios si hay un error
    echo "Ha habido un error: " . $e->getMessage();
}

