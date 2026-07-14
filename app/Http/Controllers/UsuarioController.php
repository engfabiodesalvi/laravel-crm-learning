<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Models\Model\UsuarioModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function cadastrar(Request $request)
    {
        // Compara as hashing.
        // Hash::make() sempre retorna uma hash diferente para a mesma string.
        // dd(
            // Hash::make('123'),
            // md5('123'),
            // sha1('123'),
            // hash('sha256', '123')
        // );

        // Valida qual o verbo que está requisitando o método

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
            // return response()->json(
            //     [
            //         'mensagem' => 'GET: cadastrar'
            //     ]
            // );
            // return view('welcome');
            // return view('layout.base');
            return view('usuario.cadastro');
        }
    }

    //public function salvar(Request $request) 
    public function salvar(StoreUsuarioRequest $request) 
    {
        // // Valida os campos do formulário
        // $request->validate([
        //     "nome" => "required",
        //     "email" => "required|email",
        //     "senha" => "required|min:5"
        // ]);

        // // Cadastra usuário
        // if (UsuarioModel::cadastrar($request)) {
        //     return view('usuario.sucesso',
        //     [
        //         "fulano" => $request->input('nome')
        //     ]
        //     );
        // } else {
        //     echo "Ops! Falha ao cadastrar!";
        // }

        // Cadastra usuário
        try {
            $model = new UsuarioModel();
            $model->cadastrar($request);

            // return response()->json(['mensagem' => 'Usuário cadastrado com sucesso!'], 201);
            return  view('usuario.sucesso',
                        [
                            "fulano" => $request->input('nome')
                        ]
                    );            
        } catch (\Exception $e) {
            // Captura o erro do e-mail duplicado ou do rollback e devolve uma resposta amigável
            return response()->json([
                'erro' => 
                    "Ops! Falha ao cadastrar! ". 
                    $e->getMessage()
            ], 422); // Status 422: Unprocessable Entity (Erro de validação)
            // echo "Ops! Falha ao cadastrar!";
        }        


        // // Esta função gera erro interno no servidor ao interromper uma função de forma abrupta
        // dd($request->all());

        // // Utilizar return
        // return response()->json(
        //     $request->all()
        // );

        // return view('usuario.sucesso');
    }
}
