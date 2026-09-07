<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\FilasMongoController;
use App\Http\Controllers\JuegosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('alumnos', AlumnosController::class);
Route::apiResource('filasMongo', FilasMongoController::class);
Route::apiResource('juegos', JuegosController::class);
