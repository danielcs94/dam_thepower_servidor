<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    $_SESSION["usuario"] = "Mercedes";
    ?>

    <a href="ejemplo5bis.php">Haga clic para iniciar la sesión</a>

</body>

</html>