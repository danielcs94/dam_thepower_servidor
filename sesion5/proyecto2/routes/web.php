<?php

use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\FilasMongoController;
use App\Http\Controllers\JuegosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hola', function () {
    return "Hola, es mi primera ruta2";
});

Route::get('/hola/{nombre}', function ($nombre) {
    return "Hola, $nombre";
});

Route::get('/hola_par/{nombre?}', function ($nombre = "Anónimo") {
    return "Hola, $nombre";
});

Route::resource('alumnos', AlumnosController::class);
Route::resource('filasMongo', FilasMongoController::class);
Route::resource('juegos', JuegosController::class);
