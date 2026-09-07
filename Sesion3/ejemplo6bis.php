<?php
if (isset($_POST["num1"]) && isset($_POST["num2"])) {
    try {
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];

        echo "Número 1: $num1 <br/>";
        echo "Número 2: $num2 <br/>";
        echo "La suma de $num1 y $num2 es " . ($num1 + $num2) . "<br/>";
        echo "La resta de $num1 y $num2 es " . ($num1 - $num2) . "<br/>";
        echo "La multiplicación de $num1 y $num2 es " . ($num1 * $num2) . "<br/>";

        // Controlar división por cero
        if ($num2 == 0) {
            throw new DivisionByZeroError("No puedes dividir por 0");
        }

        if($num1==5){
            throw new Exception("Vegeta viene a verte");
        }
        echo "La división de $num1 y $num2 es " . ($num1 / $num2) . "<br/>";
        $_POST["aaaa"]="aa";
    } catch (DivisionByZeroError $excepcion) {
        // Redirige con mensaje de error
        header("Location: ejemplo6.php?message=" . urlencode($excepcion->getMessage()));
        exit;
    }catch (Exception $excepcion) {
        // Redirige con mensaje de error
        header("Location: ejemplo6.php?message=" . urlencode($excepcion->getMessage()));
        exit;
    }
} else {
    // Si no se envió el formulario
    header("Location: ejemplo6.php?message=" . urlencode("Rellena el formulario"));
    exit;
}
