<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Mantendo a sintaxe antiga
// Especifica o caminho completo até do controller
// Route::get('/', 'App\Http\Controllers\UsuarioController@cadastrar');


// Utiliza a sintaxe moderna (recomendado)
// Route::get('/usuario', [UsuarioController::class, 'cadastrar']);


// Utiliza o mesmo método em mais de uma rota
// (Validar qual o verbo realiza a requisição dentro do método)
Route::match(['get', 'post'], '/usuario', [UsuarioController::class, 'cadastrar']);