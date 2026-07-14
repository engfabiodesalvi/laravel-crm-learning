<?php

use App\Http\Controllers\API\UsuarioController as APIUsuarioController;
use App\Http\Controllers\UsuarioController;
use App\Models\Model\UsuarioModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->group(function(){
    Route::get('lista', function(){
        // return ["a", "b", "c"];
        return UsuarioModel::listar(10);
    });

    // Route::post('cadastra', function(){
    //     return 'implementar post v1';
    // });

    // A sintaxe antiga deve conter o caminho completo da classe
    Route::post(
        'cadastra', 'App\Http\Controllers\API\UsuarioController@salvar'
    );    
    
});

Route::prefix('v2')->group(function(){
    Route::get('lista', function(){
        // return ["d", "e", "f"];
        return UsuarioModel::listar(10);
    });

    // Sintaxe moderna de referência um método de uma classe
    Route::post(
        'cadastra', 
        // function(){
        //     return 'implementar post v2';
        // }
        [
            APIUsuarioController::class,
            'salvar'
        ]
    );
});