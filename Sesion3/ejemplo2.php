<?php
echo "Hola, " . $_POST['nombre'] . " " . $_POST['apellidos'] . "<br/>";

echo "Tus intereses son: <br/>";

foreach ($_POST['interes'] as $valor) {
    echo "- " . $valor . "<br/>";
}
?>

<form action="ejemplo2.php" method="POST">
    Nombre: <input type="text" name="nombre" /><br />
    Apellidos: <input type="text" name="apellidos" /><br />

    <label>Mis intereses:</label><br />
    <input type="checkbox" name="interes[]" value="Deportes" /> Deportes<br />
    <input type="checkbox" name="interes[]" value="Música" /> Música<br />
    <input type="checkbox" name="interes[]" value="Libros" /> Libros<br />
    <input type="checkbox" name="interes[]" value="Cine" /> Cine<br />

    <input type="submit" value="Enviar">
</form>
