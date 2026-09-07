<?php $idioma = $_POST['idioma'];
if ($idioma == "es") {
    $bienvenida = "Tu nombre completo es ";
} elseif ($idioma == "en") {
    $bienvenida = "Your full name is ";
}
echo $bienvenida . " " . $_POST['nombre']
    . " " . $_POST["apellidos"]; ?>

<form action="ejemplo1.php" method="post">
    <label>Deseo ser atendido/a en: </label>
    <input type="radio" id="idioma1" name="idioma" value="es" />Castellano
    <input type="radio" id="idioma2" name="idioma" value="en" />English<br />
    <input type="submit" value="AAAA" />
</form>