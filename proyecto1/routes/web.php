<?php

use App\Http\Controllers\JuegosController;
use App\Http\Controllers\PlataformasController;
use App\Http\Controllers\SoloUnMetodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Plataformas/alta', [PlataformasController::class, 'alta']);
Route::get('/SoloUnMetodo', SoloUnMetodoController::class);
Route::resource('Juegos', JuegosController::class);