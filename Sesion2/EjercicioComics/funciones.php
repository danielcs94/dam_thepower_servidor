<?php

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos la acción del query string
    $accion = $_GET['action'] ?? '';

    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $localizacion = $_POST['localizacion'];
    $estado = $_POST['estado'];
    $prestado = $_POST['prestado'];
    $id = $_POST['id'];

    $ssalida = "";

    // Llamamos a la función correspondiente
    switch ($accion) {
        case 'guardar':
            $ssalida = validarCampos($titulo, $autor, $localizacion, $estado, $prestado);
            if ($ssalida == "") {
                modificarComic($titulo, $autor, $localizacion, $estado, $prestado, $id);
            }
            volver($ssalida);
            break;
        case 'eliminar':
            eliminarComic($id);
            volver("");
            break;
        case 'anadir':
            $ssalida = validarCampos($titulo, $autor, $localizacion, $estado, $prestado);
            if ($ssalida == "") {
                anadirComic($titulo, $autor, $localizacion, $estado, $prestado);
            }

            volver($ssalida);
            break;

        default:
    }
}

function volver($ssalida)
{
    //Volvemos a la página que ha hecho el submit
    //Si tiene erro mandamos el error por query string
    $slocation = "Location: index.php?ok=1". ($ssalida != "" ? '&error='. $ssalida : "")."";
    header($slocation);
    exit();
}

function validarCampos($titulo, $autor, $localizacion, $estado): string
{
    //Validamos que los campos obligatorios estan y construimos un mensaje con los que no vienen
    $ssalida = "";
    if (!(isset($titulo)) || $titulo == "") {
        $ssalida .= "título-";
    }

    if (!(isset($autor)) || $autor == "") {
        $ssalida .= "autor-";
    }

    if (!(isset($localizacion)) || $localizacion == "") {
        $ssalida .= "localización-";
    }

    if (!(isset($estado)) || $estado == "") {
        $ssalida .= "estado-";
    }

    return $ssalida;
}

function anadirComic($titulo, $autor, $localizacion, $estado, $prestado)
{
    //Cargo el json  en memoria
    $comics = cargarJSON('comics.json');
    if ($comics === null) {
        return false;
    }
    // Genero el id nuevo para la tarea
    $id = generarIdComic($comics);

    $bPrestado = $prestado == "true" ? true : false;
    // Nueva tarea que queremos añadir
    $nuevoComic = (object)['id' => $id, 'titulo' => $titulo,'autor' => $autor,'localizacion' => $localizacion,'estado' => $estado, 'prestado' => $bPrestado];

    // Añadimos la nueva tarea al array
    $comics[] = $nuevoComic;

    //Guardo el json
    guardarJSON('comics.json', $comics);
    return true;
}

function modificarComic($nuevoTitulo, $nuevoAutor, $nuevaLocalizacion, $nuevoEstado, $nuevoPrestado, $id)
{
    // Cargo el JSON en memoria
    $comics = cargarJSON('comics.json');
    if ($comics === null) {
        return false;
    }

    // Recorremos por referencia para modificar el objeto directamente
    foreach ($comics as &$comic) {
        if ($comic->id == $id) {
            $comic->estado = $nuevoEstado;  // cambia el estado
            $comic->titulo = $nuevoTitulo;  // cambia el texto del titulo
            $comic->autor = $nuevoAutor;  // cambia autor
            $comic->localizacion = $nuevaLocalizacion;  // cambia localizacion
            $comic->prestado = $nuevoPrestado == "true" ? true : false; // cambia el prestado
            break; // ya no hace falta seguir buscando
        }
    }
    unset($tarea); // buena práctica al usar referencias (&)

    // Guardar el JSON actualizado
    guardarJSON('comics.json', $comics);

    return true;
}

function eliminarComic($id)
{
    //Cargo el json  en memoria
    $comics = cargarJSON('comics.json');
    if ($comics === null) {
        return false;
    }

    foreach ($comics as $index => $comic) {
        if ($comic->id == $id) {
            unset($comics[$index]); // Elimina el elemento
            break; // Opcional: salir del bucle si solo hay uno
        }
    }

    // Reindexar el array si quieres índices consecutivos
    $comics = array_values($comics);

    //Guardo el json
    guardarJSON('comics.json', $comics);
    return true;
}

function generarIdComic($comics): int
{
    $id = 0;
    //Saco su elemento máximo
    $maximo = obtenerElementoMaximo($comics, 'id');
    //Recorro el array para ver cual es el primer id libre a partir del primero que tenemos
    for ($i = 1; $i <= $maximo; $i++) {
        $resultado = array_filter($comics, function ($comic) use ($i) {
            return $comic->id == $i;
        });
        if (empty($resultado)) {
            $id = $i;
            break;
        }
    }

    //Si no tengo id el máximo es el siguiente
    if ($id == 0) {
        $id = $maximo + 1;
    }

    return $id;
}

function obtenerElementoMaximo($datos, $propiedad)
{
    if (empty($datos)) {
        return null;
    }

    // Usamos array_reduce para encontrar el máximo
    $maximo = array_reduce($datos, function ($a, $b) use ($propiedad) {
        if ($a === null) {
            return $b;
        }
        return ($b->$propiedad > $a->$propiedad) ? $b : $a;
    });

    return $maximo->id;
}

function listarComics($titulo, $autor, $localizacion, $estado, $prestado)
{
    //Cambio la manera de filtrar y controlo campo a campo y voy filtrando en la lista que voy generando
    $comics = cargarJSON('comics.json');

    if (isset($titulo) && $titulo != "") {
        $comics = array_filter($comics, function ($ocomic) use ($titulo) {
            return str_contains(strtolower($ocomic->titulo), strtolower($titulo)) == true;
        });
    }

    if (isset($autor) && $autor != "") {
        $comics = array_filter($comics, function ($ocomic) use ($autor) {
            return str_contains(strtolower($ocomic->autor), strtolower($autor)) == true;
        });
    }

    if (isset($localizacion) && $localizacion != "") {
        $comics = array_filter($comics, function ($ocomic) use ($localizacion) {
            return str_contains(strtolower($ocomic->localizacion), strtolower($localizacion)) == true;
        });
    }

    if (isset($estado) && $estado != "") {
        $comics = array_filter($comics, function ($ocomic) use ($estado) {
            return str_contains(strtolower($ocomic->estado), strtolower($estado)) == true;
        });
    }

    if (isset($prestado) && $prestado == "true") {
        $comics = array_filter($comics, function ($ocomic) use ($prestado) {
            return $ocomic->prestado == ($prestado == "true" ? true : false);
        });
    }


    if ($comics === null) {
        return false;
    }
    return $comics;
}


/**
 * Carga un fichero JSON y lo convierte a un array asociativo.
 *
 * @param string $ruta Ruta del archivo JSON.
 * @return array|null Devuelve el contenido del JSON como array o null si falla.
 */
function cargarJSON($ruta)
{
    // Verificar si el archivo existe
    if (!file_exists($ruta)) {
        error_log("Error: El archivo '$ruta' no existe.");
        return null;
    }

    // Leer el contenido del archivo
    $contenido = file_get_contents($ruta);
    if ($contenido === false) {
        error_log("Error: No se pudo leer el archivo '$ruta'.");
        return null;
    }

    // Decodificar el JSON a un array asociativo
    $datos = json_decode($contenido);

    // Verificar errores de decodificación
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Error al decodificar JSON: ' . json_last_error_msg());
        return null;
    }

    return $datos;
}

/**
 * Guarda un array como JSON en un archivo.
 */
function guardarJSON($ruta, $datos)
{
    $json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (file_put_contents($ruta, $json) === false) {
        error_log("Error: No se pudo escribir en el archivo '$ruta'.");
        return false;
    }
    return true;
}
