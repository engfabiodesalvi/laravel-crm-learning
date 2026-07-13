<?php

namespace App\Models\Model;

use Carbon\Carbon;
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

        // $sql = self::insert([
        return self::insert([
            "nome" => $request->input('nome'),
            "email" => $request->input('email'),
            "senha" => Hash::make(
                $request->input('senha')
            ),
            // "data_cadastro" => DB::raw('NOW()')
            "data_cadastro" => new Carbon()
        ]);

        // dd($sql->toSql(), $request->all());
        // dd(DB::getQueryLog());
    }
}
