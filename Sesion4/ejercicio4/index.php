<?php
// $fichero = "cursos.json";
// if (file_exists($fichero)) {
//     $json = file_get_contents($fichero);
//     $datos = json_decode($json, true);
//     foreach ($datos["DAW"] as $modulo) {
//         foreach ($modulo as $clave => $valor) {
//             echo "$clave: $valor <br/>";
//         }
//         echo "<br/>";
//     }
// } else {
//     echo "El fichero no existe";
// }
?>

<?php
$fichero = "cursos.json";
if (file_exists($fichero)) {
    $json = file_get_contents($fichero);
    $datos = json_decode($json); // Ahora $datos es un objeto
    foreach ($datos->DAW as $modulo) {
        echo "Módulo: " . $modulo->modulo . "<br/>";
        echo "Curso: " . $modulo->curso . "<br/>";
        echo "Horas semanales: " . $modulo->horas_semanales . "<br/>";
        echo "<br/>";
    }
} else {
    echo "El fichero no existe";
}
?>

