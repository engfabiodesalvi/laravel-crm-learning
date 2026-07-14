<?php

namespace App\Models\Model;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioModel extends Model
{
    protected $connection = 'sqlite';
    protected $table = 'usuarios';

    /**
     * Define os casts nativos do Laravel
     */
    protected function casts(): array
    {
        return [
            'data_cadastro' => 'datetime',
        ];
    }

    /**
     * Accessor para garantir o fuso horário correto na camada de apresentação
     */
    public function getDataCadastroAttribute(mixed $value)
    {
        return $value 
            ? Carbon::parse($value)->timezone('America/Sao_Paulo')->format('Y-m-d H:i:s') 
            : null;
    }   

    public static function listar(int $limite){
        $sqlUsuarios = self::select([
            "id",
            "nome",
            "email",
            "data_cadastro"
        ])
        ->limit($limite)
        ->get();
        
        // dd($sql->toSql());
        return $sqlUsuarios;
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
