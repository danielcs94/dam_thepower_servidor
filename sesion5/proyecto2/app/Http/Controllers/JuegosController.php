<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Conectores;
use MongoDB\Driver\Query;
use MongoDB\Driver\Manager;
use MongoDB\Driver\BulkWrite;


class JuegosController extends Controller
{
    protected Manager $conexion; // El manager de MongoDB
    protected Conectores $conec; // La clase que maneja la conexión

    /**
     * Constructor
     */
    public function __construct()
    {
        // Instanciamos la clase de conexión
        $this->conec = new Conectores();

        // Conectamos a MongoDB
        $this->conec->conectarMongodb();

        // Guardamos el manager para usarlo en todos los métodos
        $this->conexion = $this->conec->getManagerMongodb();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Me traigo las filas para cargar los datos de los desplegables
        $filasCursor = $this->conexion->executeQuery("videojuegos_db.plataformas", new Query([], []));
        $filas = iterator_to_array($filasCursor);

        // Devuelve como JSON para Laravel
        //return response()->json($filas);
        return $filas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $plataforma = new BulkWrite();
        $plataforma->insert([
            'nombre' => $request->input('nombre', 'NEOGEO'), // ejemplo usando valor del request
            'juegos' => $request->input('juegos', [])
        ]);
        $this->conexion->executeBulkWrite("videojuegos_db.plataformas", $plataforma);
        return response()->json($request->all(), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $filter = ['_id' => new \MongoDB\BSON\ObjectId($id)];

        //$filtro = ['$and' => [['_id' => $id]]];
        $cambio = ['$set' => ['nombre' => $request->input('nombre', 'NEOGEO'), 'juegos' => $request->input('juegos', [])]];

        $bwfila_ant = new BulkWrite();
        $bwfila_ant->update($filter, $cambio, ['multi' => false]);
        $this->conexion->executeBulkWrite("videojuegos_db.plataformas", $bwfila_ant);
        return response()->json($request->all(), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
       $filter = ['_id' => new \MongoDB\BSON\ObjectId($id)];
        $plataforma = new BulkWrite();
        $plataforma->delete($filter, ['limit' => true]);
        $this->conexion->executeBulkWrite("videojuegos_db.plataformas", $plataforma);
        return response()->json("eliminado", 200);
    }
}
