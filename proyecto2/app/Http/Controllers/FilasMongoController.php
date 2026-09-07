<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Conectores;
use MongoDB\Driver\Query;

class FilasMongoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Instancio mi clase de conector
        $conec = new Conectores();

        //Me traigo los datos de BBDD
        $conec->conectarMongodb();
        $conexion = $conec->getManagerMongodb();

        //Me traigo las filas para cargar los datos de los desplegables
        $filasCursor = $conexion->executeQuery("videojuegos_db.filas", new Query([], []));
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
