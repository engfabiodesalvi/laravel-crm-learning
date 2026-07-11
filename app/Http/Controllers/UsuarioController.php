<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function cadastrar(Request $request)
    {
        // Validando qual o verbo está requisitando o método

        if ($request->isMethod('post'))
        {
            // Evitar o uso de echo
            // echo 'POST: cadastrar';  
            return $this->salvar($request);
        }

        if ($request->isMethod('get'))
        {
            // Evitar o uso de echo
            // echo 'GET: cadastrar';
            return response()->json(
                [
                    'mensagem' => 'GET: cadastrar'
                ]
            );
        }
    }

    public function salvar(Request $request) 
    {
        // Esta função gera erro interno no servidor ao interromper uma função de forma abrupta
        // dd($request->all());

        // Utilizar return
        return response()->json(
            $request->all()
        );
    }
}
