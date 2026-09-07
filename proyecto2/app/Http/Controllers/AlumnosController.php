<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = [
            ['nombre' => 'Juan', 'apellidos' => 'Gutiérrez Sanz'],
            ['nombre' => 'Vicente', 'apellidos' => 'Sánchez Medina'],
            ['nombre' => 'Pablo', 'apellidos' => 'Pérez Álvarez']
        ];
        //return view('listado', compact('clientes'));
        return $clientes;
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
         return "Mostrando ficha de Proveedor con ID $id";
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
