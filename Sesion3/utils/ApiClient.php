<?php

class APIClient
{
    private $url;
    private $headers;

    // Constructor: URL de la API y headers opcionales
    public function __construct($url, $headers = [])
    {
        $this->url = $url;
        $this->headers = $headers;
    }

    // Método para obtener los datos de la API
    public function getData()
    {
        // Inicializar cURL
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!empty($this->headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        }

        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception('Error en la conexión: ' . curl_error($ch));
        }

        // Opcional: liberar explícitamente:
        unset($ch);

        // Convertir JSON a array asociativo
        $datos = json_decode($response, true);

        if ($datos === null) {
            throw new Exception('Error al decodificar JSON');
        }

        return $datos;
    }
}
