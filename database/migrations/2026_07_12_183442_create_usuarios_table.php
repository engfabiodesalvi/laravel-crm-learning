<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // Executa a query exata no banco de dados
        // A responsabilidade de gerenciar conflitos está no bnaco de dados
        // Não é o ideal 

        DB::statement("
            CREATE TABLE usuarios (
                id INTEGER PRIMARY KEY ASC ON CONFLICT ROLLBACK AUTOINCREMENT UNIQUE,
                nome VARCHAR,
                email VARCHAR,
                senha VARCHAR,
                data_cadastro DATETIME
            )
        ");    

        
        // Padrão Blueprint 
        // ASC: ordenação padrão de chaves primárias assumida pelo Blueprint
        // ON CONFLICT ROLLBACK: Construtor agnóstico (funciona em MySQL, PostgreeSQL, SQLite e SQL Server), esta cláusula não pssui um método nativo no Blueprint.
        // A função de gerenciar conflitos deve ser implementada ns respestivos respectivos métodos

        // Schema::create('usuarios', function (Blueprint $table) {
        //     // Cria o ID como chave primária, autoincremento e único
        //     $table->integer('id')->autoIncrement()->primary()->unique();
            
        //     // Campos de texto simples
        //     $table->string('nome');
        //     $table->string('email');
        //     $table->string('senha');
            


        //     // Campo de data e hora para o cadastro
        //     $table->dateTime('data_cadastro');
        // });        

        // Tabela padrão
        // Schema::create('usuarios', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
