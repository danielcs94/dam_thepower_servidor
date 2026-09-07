<?php

namespace App\Services;
//Siempre es interesante en todo tipo de proyectos tener un fichero de configuracion
//con las conexiones y parametrizaciones del sistema

//new PDO('mysql:host=hostname;dbname=database', 'usuario', 'password');
//new Manager('mongodb://fidel:1234@localhost:27017/test');
// Los ajustes están definidos dentro de un array
class Configuracion
{

    public function getConfig()
    {
        return [
            // Configuración de la base de datos
            'database' => [
                'sqllite'   => 'usuarios.db',
                'csv'   => 'DatosRubrica4Final.csv',
                'json'   => 'DatosRubrica4Final.json',
                'xml'   => 'DatosRubrica4Final.xml',
                'mysql'   => [
                    'cadena' => 'host=localhost:3307;dbname=videojuegos_db',
                    'usuario' => 'root',
                    'password' => '',
                ],
                //mongodb://jorge:1234@192.168.108.100:27017/videojuegos_db
                'mongodb'   => [
                    'host' => '192.168.108.100',
                    'bbdd' => 'videojuegos_db',
                    'puerto' => '27017',
                    'usuario' => 'jorge',
                    'password' => '1234',
                ],
            ],

            // Configuración general de la aplicación
            'app' => [
                'name'      => 'Gestion de usuarios',
                'version'   => '1.0.0',
                'debug'     => true,
                'timezone'  => 'Europe/Madrid',
            ],
            //DURACION SESION
            'sesion' => [
                'duracion_seg' => '3600', //esta en segundos
            ],
            'pass' => [
                'hash' => 'p3p1noM@r1n0C0nFrut@D3l@P@si0n', //esta en segundos
            ],
        ];
    }
}
