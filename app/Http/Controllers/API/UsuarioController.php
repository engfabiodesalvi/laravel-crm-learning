<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioRequest;
use App\Models\Model\UsuarioModel;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // public function salvar(Request $request) {
    public function salvar(StoreUsuarioRequest $request) {

        // if (UsuarioModel::cadastrar($request)) {
        //     return response(
        //         "Usuário criado com sucesso!", // Created
        //         201
        //     );
        // } else {
        //     return response(
        //         "Ops! Falha ao cadastrar!", // Unprocessable Entity
        //         422
        //     );            
        // }

        // Cadastra usuário
        try {
            $model = new UsuarioModel();
            $model->cadastrar($request);

            // return response()->json(['mensagem' => 'Usuário cadastrado com sucesso!'], 201);
            return response(
                "Usuário criado com sucesso! (API)", // Created
                201
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
        // dd($request->all());
    }
}
