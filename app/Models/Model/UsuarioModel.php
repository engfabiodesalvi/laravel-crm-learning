<?php

namespace App\Models\Model;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioModel extends Model
{
    protected $connection = 'sqlite';
    protected $table = 'usuarios';

    public static function listar(int $limite){
        $sql = self::select([
            "id",
            "nome",
            "email",
            "data_cadastro"
        ])
        ->limit($limite);
        
        dd($sql->toSql());
    }

    public static function cadastrar(Request $request){

        // DB::enableQueryLog(); 

        // 1. Camada de Validação Manual (Garante o e-mail único antes de tentar inserir)
        $emailExiste = self::query()
            ->where(
                'email', 
                $request->input('email')
            )
            ->exists();
        
        if ($emailExiste) {
            // Lança uma exceção controlada para acionar o Rollback
            throw new \Exception("O e-mail informado já está cadastrado.");
        }                       

        return DB::transaction(function () use ($request) {
            // $sql = self::insert([
            return self::insert([
                "nome" => $request->input('nome'),
                "email" => $request->input('email'),
                "senha" => Hash::make(
                    $request->input('senha')
                ),
                // "data_cadastro" => DB::raw('NOW()')
                //"data_cadastro" => (new Carbon())->setTimezone('America/Sao_Paulo')
                //"data_cadastro" => Carbon::now('America/Sao_Paulo')
                "data_cadastro" => Carbon::now()
            ]);
        });

        // dd($sql->toSql(), $request->all());
        // dd(DB::getQueryLog());
    }
}
