<?php
echo "Hola, " . $_POST['nombre'] . " " . $_POST['apellidos'] . "<br/>";

echo "Tus intereses son: <br/>";

foreach ($_POST['interes'] as $valor) {
    echo "- " . $valor . "<br/>";
}
?>

<form action="ejemplo3.php" method="POST">
 <label>Mis intereses:</label><br/>
<select name="interes[]" size="4" multiple>
    <option value="Deportes">Deportes</option>
    <option value="Música">Música</option>
    <option value="Libros">Libros</option>
    <option value="Cine">Cine</option>
</select>


    <input type="submit" value="Enviar">
</form>
