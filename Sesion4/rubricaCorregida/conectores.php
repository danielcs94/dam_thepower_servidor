<?php
//Importo mi fichero de configuracion
$config = require_once "config.php";
require_once "./Models/plataforma.php";
require_once "./Models/videojuego.php";
$arrtiposcampoImg = ["image", "picture", "img", "imagen"];
class Conectores
{
    protected $pdoSqlLite; //Conexion global de la db sqlLite

    public function __construct() {}

    public function conectarSqLite()
    {
        global $config;
        //Este método me conecta al sqllite
        //Inicio las propiedades necesarias en el constructor y hago la conexión la BBDD
        $bbdd = $config['database']['dbname'];
        // Conectar a SQLite
        $this->pdoSqlLite = new PDO('sqlite:' . __DIR__ . "\\datos\\" . $bbdd);
    }
    public function getPdoSqLite()
    {
        return $this->pdoSqlLite;
    }

    public function getCsv()
    {
        //Esta funcion me coge el csv de mi fichero de configuracion y me lo convierte en un array
        global $config;
        $csv = $config['database']['csv'];
        $fichero = __DIR__ . "\\datos\\" . $csv;
        $arr_salida = [];
        if (file_exists($fichero)) {
            //Abro el cursor del fichero
            $f = fopen($fichero, "r");

            //Me lo convierto cada linea en un array con el metodo fgetcsv y lo voy añadiendo a mi array final

            //Recordar que el curso se posiciona en la primera linea y siempre hay que leerla
            $array = fgetcsv($f);
            array_push($arr_salida, $array);
            while (!feof($f)) {
                //El bucle me va línea a línea mientras no sea el caracter final de fichero
                $array = fgetcsv($f);
                array_push($arr_salida, $array);
            }

            //Cierro el fichero para evitar errores de memoria
            fclose($f);
        } else {
            echo "El fichero especificado no existe";
        }
        return $arr_salida;
    }

    public function getXML()
    {
        //Esta funcion me coge el xml de mi fichero de configuracion y me lo convierte en un array
        global $config;
        $xml_fic = $config['database']['xml'];
        $fichero = __DIR__ . "\\datos\\" . $xml_fic;
        $arr_salida = [];
        if (file_exists($fichero)) {
            $xml = simplexml_load_file($fichero);
            foreach ($xml->juego as $juego) {
                //print_r($juego);
                $plataforma = (string)$juego['plataforma'];
                $titulo = (string)$juego->titulo;
                $anio = (string)$juego->anio;
                $metacritic = (string)$juego->metacritic;
                $portada = (string)$juego->portada;
                $arr = [$plataforma, $titulo, $anio, $metacritic, $portada];
                array_push($arr_salida, $arr);
            }
        } else {
            echo "El fichero no existe";
        }
        return $arr_salida;
    }

    public function procesarArray($tipo)
    {
        //Esta funcion me convierte el fichero con su formato al array esperado por la tabla
        $arrVJ = null;

        //Me traigo el csv de la hoja
        switch ($tipo) {
            case 'csv':
                $arrVJ = $this->getCsv();
                break;
            case 'xml':
                $arrVJ = $this->getXML();
                break;
            default:
        }

        //Extraigo las plaformas que son la columna 0
        $arrPlataformas = array_map(function ($nav) {
            if (isset($nav[0]) && $nav[0] != "plataforma") {
                return ["plataforma" => $nav[0]];
            }
        }, $arrVJ);

        //Me creo un objeto distinct para sacar solo las plataformas que me interesan
        $arrDistinctPlataformas = [];
        //Recorro cada uno de los video juegos y me creo un array solo con las plataformas con valor único para luego colocarlo
        foreach ($arrPlataformas as $plat) {
            if (isset($plat)) {
                $splataforma = $plat["plataforma"];
                if (in_array($splataforma, $arrDistinctPlataformas) == false) {
                    array_push($arrDistinctPlataformas, $splataforma);
                }
            }
        }

        //Recorro el array de plataformas y me hago un array con las plataformas y sus videojuegos mejor colocado para luego hacer el bucle
        $arrFinalPlataformas = [];
        $iContaPlataforma_id = 1;
        foreach ($arrDistinctPlataformas as $pladis) {
            //Saco los elementos del array principal que son de la plataforma en cuestion
            $arrFilPla = array_filter($arrVJ, function ($VJ) use ($pladis) {
                if (isset($VJ[0])) {
                    return $VJ[0] == $pladis;
                }
            });

            //Mapeo solo los campos que me interesan que titulo anio y metacritic
            $videojuego_id = 1;
            //Paso la variable contador video_juego_id por referencia para poder incrementarlo dentro
            $mapArrFilPla = array_map(function ($oVJ) use ($iContaPlataforma_id, &$videojuego_id) {
                $videojuego = new Videojuego();
                $videojuego->setvideo_juego_id($videojuego_id);
                $videojuego->setplataforma_id($iContaPlataforma_id);
                $videojuego->settitulo($oVJ[1]);
                $videojuego->setanio($oVJ[2]);
                $videojuego->setmetacritic($oVJ[3]);
                $videojuego->setimagen($oVJ[4]);
                $videojuego_id += 1;
                return $videojuego;
            }, $arrFilPla);

            //Genero un objeto con dos propiedades la plataforma y los video juegos de la misma
            $plataforma = new Plataforma();
            $plataforma->setplataforma_id($iContaPlataforma_id);
            $plataforma->setplataforma($pladis);
            $plataforma->setvideojuegos($mapArrFilPla);

            //Añado dicho objeto a la plataforma
            array_push($arrFinalPlataformas, $plataforma);
            $iContaPlataforma_id += 1;
        }
        return $arrFinalPlataformas;
    }

    public function pintarTabla($arrFinalPlataformas)
    {
        //Esta funcion me pinta la tabla a partir del array de objetos de plataforma
        $shtml = "";
        foreach ($arrFinalPlataformas as $pla) {
            //Pinto el titulo
            $plataforma = $pla->getPlataforma();
            $stitulo = "<h1>$plataforma</h1>";
            //echo $stitulo;
            $shtml = $shtml . $stitulo;

            //Pinto la tabla
            $tabla_html = $this->pintarArrayTabla($pla->getvideojuegos());
            //echo $tabla_html;
            $shtml = $shtml . $tabla_html;
            //echo $shtml;
        }
        return $shtml;
    }

    function pintarArrayTabla($arr)
    {
        //Esta funcion me va a pintar un array en una tabla
        //Inicializo la variable html
        $shtml = "<table border='1'>";

        //Recorro el array
        foreach ($arr as $elem) {
            $shtml .= "<tr>";

            //Recorro las propiedades del array y las voy pintando en tds
            $tipo = gettype($elem);
            if ($tipo == "array" || $tipo == "object") {
                foreach ($elem as $clave => $valor) {
                    $shtml .= "<td>" . (string)$valor . "</td>";
                }
            } else {
                $shtml .= "<td>" . (string)$elem . "</td>";
            }

            $shtml .= "</tr>";
        }

        //ACordaros que el punto es concatenador en PECHAPE
        $shtml .= "</table>";

        return $shtml;
    }

    function pintarArrayDiv($arr, $deep = 1)
    {
        global $arrtiposcampoImg;
        //Esta funcion me va a pintar un array en una tabla
        //Inicializo la variable html
        $shtml = "<div class='principal'>";

        //Recorro el array
        foreach ($arr as $elem) {

            //Recorro las propiedades del array y las voy pintando en tds
            $tipo = gettype($elem);
            if ($tipo == "array" || $tipo == "object") {
                $shtml .= "<div class='elemento'>";
                foreach ($elem as $clave => $valor) {
                    //Compruebo si la clave es de tipo imagen

                    if (in_array($clave, $arrtiposcampoImg)) {
                        $shtml .= "<img src='$valor' />";
                    } else {
                        $tipo = gettype($valor);
                        if ($tipo == "array" || $tipo == "object") {
                            $shtml .= $this->pintarArrayDiv($valor, 6);
                        } else {

                            $shtml .= "<h" . (string)$deep . "><b>" . (string)$clave . "</b>" . (string)$valor . "</h" . (string)$deep . ">";
                        }
                    }
                }
                $shtml .= "</div>";
            } else {
                $shtml .= "<div>" . (string)$elem . "</div>";
            }
        }

        //ACordaros que el punto es concatenador en PECHAPE
        $shtml .= "</div>";

        return $shtml;
    }
}
