<?php
require_once 'datos.php';  // Asegúrate de que 'datos.php' contenga el array de los meses correctamente definido.

$year = date("Y");
echo "Año actual: $year<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_GET['action'] ?? '';  // Deberías revisar si realmente necesitas $_GET['action'] aquí
    $year = $_POST['year'] ?? $year;  // Si no se manda el año, se mantiene el actual
}

$shtml = "<table border='1'>";
$iconta = 1;

foreach ($Meses as $mes) {
    $textoMes = $mes['nombre'];
    $shtml .= "<tr><td colspan='31'>" . strtoupper($textoMes) . "</td></tr>";
    $idias = 0;

    if ($mes['nombre'] == "Febrero") {
        $ianio = (int)$year;
        $resto = $ianio % 4;
        if ($resto == 0) {
            $idias = 29;
        } else {
            $idias = 28;
        }
    } else {
        $idias = $mes['dias'];
    }

    for ($i = 0; $i < $idias; $i++) {
        $smes = $iconta < 10 ? "0" . $iconta : (string)$iconta;
        $sdia = ($i + 1) < 10 ? "0" . ($i + 1) : ($i + 1);  // Sumar 1 al día
        $sfecha = "$year/$smes/$sdia";
        $diaSemana = diaDeLaSemana($sfecha);
        $objetivofinal = "$diaSemana " . ($i + 1) . " de $textoMes de $year";
        $shtml .= "<tr><td>$objetivofinal</td></tr>";
    }
    $iconta++;
}

$shtml .= "</table>";
echo $shtml;

?>
