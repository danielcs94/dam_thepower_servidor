<?php

require_once "../utils/ApiClient.php";

//Me hago una clase importador
class Importador
{
    //Declaro las propiedades de mi importador
    protected $url; //url de la api
    protected $bbdd;//Ruta de la bbdd sqllite
    protected $db; //Conexion global de la db
    public function __construct($_url, $_bbdd)
    {
        //Inicio las propiedades necesarias en el constructor y hago la conexión la BBDD
        $this->url = $_url;
        $this->bbdd = $_bbdd;
        // Conectar a SQLite
        $this->db = new PDO('sqlite:' . __DIR__ . '/'. $_bbdd);
    }
    public function extraerCamposTabla($tabla, $clave = ""): string
    {
        $salida = "";
        // Obtener información de las columnas
        $stmt = $this->db->query("PRAGMA table_info($tabla);");

        // Recorrer resultados
        $columnas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Me hago un concatenado de las columnas de la BBDD
        if (count($columnas) > 0) {
            foreach ($columnas as $col) {
                if ($col["name"] != $clave) {
                    $salida .= $col["name"] .",";
                }

            }
            $salida = substr($salida, 0, -1);
        }

        return $salida;
    }

    public function importarDatosAPI($tabla, $clave = "")
    {
        try {
            $api = new APIClient(
                $this->url,
                ['Authorization: Bearer TU_TOKEN']
            );

            //LLamos a los datos de la api
            $datos = $api->getData();

            // print_r($datos["items"]);

            // Extraer claves del json
            $claves = array_keys($datos["items"][0]);
            //print_r($claves);

            //Saco los campos de la tabla
            $camposTabla = $this->extraerCamposTabla($tabla, $clave);
            print_r($camposTabla);

            //Agrego el prefijo ":" para indicar los parametros
            $camposValor = agregarPrefijo(explode(",", $camposTabla));

            //Checkeo que tengo campos de la tabla
            if (isset($camposTabla) && $camposTabla != "") {
                // Preparar inserción indicando los campos y los parametros
                $ssql = "INSERT INTO $tabla ($camposTabla) VALUES ($camposValor)";
                $stmt = $this->db->prepare($ssql);

                //Recorro los elementos de la coleccion
                foreach ($datos["items"] as $fila) {
                    //print_r($fila);
                    $datosNue = [];
                    //Construyo el array asociativo recorriendo los campos valor
                    foreach (explode(",", $camposValor) as $index => $campo) {
                        //print_r($claves[$index]);
                        $datosNue[$campo] = $fila[$claves[$index]];
                    };
                    // print_r($datosNue);
                    //Importo los sql para ir insertando
                    $stmt->execute($datosNue);
                }

                echo "Datos importados correctamente.";
            }


            echo "<pre>";
            print_r($datos);
            echo "</pre>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

function agregarPrefijo($array, $prefijo = ':')
{
    return implode(",", array_map(function ($item) use ($prefijo) {
        return $prefijo . $item;
    }, $array));
}

$imp = new Importador("https://dragonball-api.com/api/characters", "../bbdd/dragonBall.db");

$imp->importarDatosAPI("Personajes");
