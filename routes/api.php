<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->group(function(){
    Route::get('lista', function(){
        return ["a", "b", "c"];
    });

    Route::post('cadastra', function(){
        return 'implementar post v1';
    });
});

Route::prefix('v2')->group(function(){
    Route::get('lista', function(){
        return ["d", "e", "f"];
    });

    Route::post('cadastra', function(){
        return 'implementar post v2';
    });
});