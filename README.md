<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


---

# Anotações realizadas durante o projeto

## Atualização das tabelas após definir novo diretório e arquivo para a base de dados afim de apermitir a execução do sistema

Neste exemplo foi necessário executar o comando `migrate` para criar as tabels da base de dados e permitir a execução do sistema sem erros, diferente do tutorial.

Erro:
>Illuminate\Database\QueryException
vendor/laravel/framework/src/Illuminate/Database/Connection.php:857
SQLSTATE[HY000]: General error: 1 no such table: sessions (Connection: sqlite, Database: /home/engfabiodesalvi/Dio Cursos/Desenvolvimento Avancado PHP/banco/laravel.sqlite3, SQL: select * from "sessions" where "id" = 7xYtJeCxJtuZOieMTk71i4tWxIR6HyD3vN5MahGR limit 1)

```bash
$ php artisan config:cache
$ php artisan cache:clear
$ php artisan migrate
```

## Ativação do servidor do php

```bash
$ php artisan serve
```


## Sintaxe nova para especificar o controlador em uma rota

Atenção: Separar as requições que serão utilizadas pelo aplicativo (`Web.php`) das requisições externas (`Api.php`).
Ao tentar configurar uma rota na classe `Web.php` para responder a requisições de aplicativos como Insomnia será exibido uma resposta `419` de página expirada.

### Mantendo a asintaxe antiga

Especificar o caminho completo do controlador nas verções novas do Laravel:

```php
Route::get('/', 'App\Http\Controllers\UsuarioController@cadastrar');
```

### Utilizando a sintaxe nova

```php
Route::get('/usuario', [UsuarioController::class, 'cadastrar']);
```

### Definindo dois verbos para uma mesma rota

Utiliza o mesmo método em mais de uma rota

```php
Route::match(['get', 'post'], '/usuario', [UsuarioController::class, 'cadastrar']);
```

Definir no método uma forma de verificar o verbo

```php
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
```

## Definindo rotas da api

Instalando o arquivo de API:

```bash
php artisan install:api
```

Configurando uma rota da api

```php
Route::prefix('v1')->group(function(){
    Route::get('lista', function(){
        return ["a", "b", "c"];
    });

    Route::post('cadastra', function(){
        return 'implementar post v1';
    });
});
```

## Eloquent e Blade

O Eloquent é o ORM (Mapeamento Objeto-Relacional) nativo do framework Laravel. Ele permite interagir com bancos de dados relacionais (como MySQL e PostgreSQL) utilizando objetos e métodos em PHP, em vez de escrever consultas SQL complexas.

O Blade e o Eloquent não se conectam diretamente no banco de dados, mas trabalham juntos para exibir as informações na tela.

O Eloquent busca os dados do banco de dados e o Blade renderiza (mostra) esses dados no HTML.

O Fluxo de Trabalho (MVC)

- Controller: Pede os dados ao Eloquent.

- Eloquent: Busca no banco e envia para o Controller como objeto ou coleção.

- Controller: Passa esses objetos para a View do Blade.

## Formatação CSS

Utilizar a funcionalidade MIX para otimizar o css.

## Hashing e criptografia

Não, essas funções não são criptografias, são funções de hashing.
A criptografia é um processo de duas vias (reversível), onde você pode cifrar e decifrar um texto usando uma chave. O hashing é um processo de via única (irreversível), transformando o dado em uma pegada digital digital que não pode ser desfeita para revelar o texto original.

------------------------------
### Hash::make('123') (Bcrypt / Argon2)
Usa os algoritmos Bcrypt ou Argon2 por padrão no Laravel. É o padrão ouro para senhas.

* Vantagens: Extremamente seguro, lento por design (dificulta ataques de força bruta) e gera hashes diferentes para a mesma senha automaticamente (usa salt interno).
* Desvantagens: Consome mais memória/processamento do servidor e o resultado é longo (geralmente 60+ caracteres).

### md5('123')
Algoritmo antigo de 128 bits criado em 1991.

* Vantagens: Extremamente rápido e gera strings curtas (32 caracteres), ideal para checar integridade de arquivos leves.
* Desvantagens: Completamente quebrado e inseguro para senhas, sofrendo facilmente com ataques de colisão (duas senhas diferentes gerando o mesmo hash).

### sha1('123')
Algoritmo de 160 bits desenvolvido pela NSA em 1995.

* Vantagens: Muito rápido e amplamente compatível com sistemas legados e controle de versão (como o Git).
* Desvantagens: Também é considerado inseguro hoje em dia e vulnerável a ataques de colisão gerados por supercomputadores.

### hash('sha256', '123')
Algoritmo moderno da família SHA-2 que gera uma assinatura de 256 bits (64 caracteres).

* Vantagens: Altamente seguro contra colisões, ideal para chaves de API, assinaturas digitais, webhooks e verificação de arquivos.
* Desvantagens: Por ser muito rápido para computadores modernos, é inseguro para salvar senhas de usuários (fácil de quebrar por força bruta).


## Validação de dados e formulários

### Validação de dados

Utilizar ``

```php
// Valida os campos do formulário
$request->validate([
    "nome" => "required",
    "email" => "required|email",
    "senha" => "required|min:5"
]);
```
### Validação de formulários

Utilizar `Form Request Validation`

## Criando a tabela de usuários

### Gerar o arquivo de Migration

#### Gerar a estutura de migração padrão para a tabela `usuarios`.

```Bash
$ php artisan make:migration create_usuarios_table
```

### Configurar a estrutura padrão da tabela `usuarios`

O código abaixo configura a estrutura padrão do arquivo de migração da tabela `usuarios` utilizando `SQL`.
Possuia a desvantagem de atribuir ao banco de dados a função de gerenciar conflitos e ordenar os dados de forma crescente.

```php
/**
 * Run the migrations.
 */
public function up(): void
{
    // Executa a sua query exata no banco de dados
    DB::statement("
        CREATE TABLE usuarios (
            id INTEGER PRIMARY KEY ASC ON CONFLICT ROLLBACK AUTOINCREMENT UNIQUE,
            nome VARCHAR,
            email VARCHAR,
            senha VARCHAR,
            data_cadastro DATETIME
        )
    ");
}
```

Já o código abaixo utiliza o `Blueprint`do Laravel 13 para criar a tabela `usuarios`.
Os modificadores específicos (`ASC`, `ON CONFLICT ROLLBACK`, `AUTOINCREMENT` e `UNIQUE` no ID) são traduzidos para métodos equivalentes que o construtor de esquemas do framework disponibiliza.
Esta forma atribuia a responsbilidade por gerenciar os métodos equivalentes aos especificadores `SQL` à camamda de aplicação, permitindo que a base de dados possa ser modificada posteriormente durante as diversas fazes de desenvolvimento e implementação do sistema.


**Análise desta abordagem:** Ao migrar do SQL bruto para o Blueprint, três detalhes importantes mudam nos bastidores devido à camada de abstração do Laravel:

- Omitindo o `ASC`: No Blueprint, a ordenação padrão de índices e chaves primárias (`ASC`) já é assumida pelo banco de dados na criação. O Laravel não possui um método `.asc()` para chaves primárias porque os bancos já estruturam os índices dessa forma por padrão.

- Omitindo o `ON` `CONFLICT` `ROLLBACK`: O construtor de esquemas do Laravel é agnóstico (funciona em MySQL, PostgreSQL, SQLite e SQL Server). Cláusulas muito específicas de controle de transação por linha como o `ON` `CONFLICT` `ROLLBACK` do SQLite não possuem um método nativo no Blueprint.

- Comportamento do Framework: Sem o `ON` `CONFLICT` `ROLLBACK` na estrutura da tabela, o tratamento de erros em caso de duplicidade de ID ou e-mail passa a ser responsabilidade da aplicação (sua camada PHP vai disparar uma `QueryException`, que por padrão cancela a requisição e faz o rollback da transação se você estiver utilizando `DB::transaction()`).

Se o comportamento rigoroso de `ROLLBACK` direto no motor do banco de dados for um requisito de arquitetura indispensável para o seu projeto, a abordagem anterior usando `DB::statement` com o `SQL` bruto continua sendo a recomendada.

```php
/**
 * Run the migrations.
 */
public function up(): void
{
    Schema::create('usuarios', function (Blueprint $table) {
        // Cria o ID como chave primária, autoincremento e único
        $table->integer('id')->autoIncrement()->primary()->unique();
        
        // Campos de texto simples
        $table->string('nome');
        $table->string('email');
        $table->string('senha');
        
        // Campo de data e hora para o cadastro
        $table->dateTime('data_cadastro');
    });
}
```

### Versiona o banco de dados

Lê ou altera as **tabelas e colunas** do banco de dados baseado nos arquivos PHP criados na pasta `database/migrations`

```Bash
$ php artisan migrate
```

## Leitura da estrutura e valores da tabela

### Inspeção da estrutura gerada

Valida se os campos e indexadores foram aplicados rodando o inspetor de tabelas d Laravel:

```Bash
$ php artisan db:table usuarios
```

É retornado o espelho detalhando as chaves primáris, única e os tipos dos dados.

```Bash
  main.usuarios ..................................................
  Columns ...................................................... 5

  Column .................................................... Type
  id integer, autoincrement, nullable .................... integer
  nome varchar, nullable ................................. varchar
  email varchar, nullable ................................ varchar
  senha varchar, nullable ................................ varchar
  data_cadastro datetime, nullable ...................... datetime

  Index ..........................................................
  primary id ............................................. primary
  sqlite_autoindex_usuarios_1 id .......................... unique
```

### Entrar no Laravel Tinker

Validar o comportamento dos dados através do ambiente interativo:

```php
$ php artisian tinker
```

### Consultar dados da tabela usuarios

Independentemente da tabela ser criada via comando bruto, ou via Blueprint do Laravel, a leitura de seus registros poderá ser realizada de forma direta usando a Facade de banco de dados (`DB`):

```PHP
// Retorna todos os registros salvos na tabela usuarios
DB::table('usuarios')->get();
```

Exemplo de dados registrados utilizando o Blueprint Laravel sem a implmentação das restrições de dados:

```PHP
= Illuminate\Support\Collection {#7442
    all: [
      {#7441
        +"id": 1,
        +"nome": "kfjsd",
        +"email": "kjk@kjk",
        +"senha": "\$2y\$12\$XdIyFjXDna4RfMczBRGk8.9El4qRirKaLIMBFda7fpDxRP6KiKluS",
        +"data_cadastro": "2026-07-13 00:18:21",
      },
      {#7439
        +"id": 2,
        +"nome": "kfjsd",
        +"email": "kjk@kjk",
        +"senha": "\$2y\$12\$7pp3iJqSMTWVRO5mU/4yeuoLqgZe/Tit68Eh0VSv.VBdFyEcF01B.",
        +"data_cadastro": "2026-07-13 02:00:41",
      },
      {#7437
        +"id": 3,
        +"nome": "dsf",
        +"email": "sdf@df",
        +"senha": "\$2y\$12\$iAOW8Gg1KR4me3G3URRxN.XpxoBjWlFQUTxd6MWs9Mk9E3oFbxUg6",
        +"data_cadastro": "2026-07-13 02:00:57",
      },
      {#7444
        +"id": 4,
        +"nome": "kfjsd",
        +"email": "kjk@kjk",
        +"senha": "\$2y\$12\$Q8OBS3HykeVzWQ149quQ1eWOUTUd00jS6PgTcP4E0LrrG494T1.a2",
        +"data_cadastro": "2026-07-13 02:03:20",
      },
    ],
  }
```

### Inserir e consultar um registro no Tinker,

Exemplos de inserção e busca de registros

```PHP
// Inserindo um registro de teste
DB::table('usuarios')->insert(['nome' => 'Dev Sênior', 'email' => 'senior@dev.com', 'senha' => 'hash_senha', 'data_cadastro' => now()]);

// Lendo o valor recém inserido
DB::table('usuarios')->where('email', 'senior@dev.com')->first();
```

### Deletar registros

- Com o mesmo e-maill:

```PHP
DB::table('usuarios')->where('email', 'senior@dev.com')->delete();
```
Retorna o número de registros apagados.

- Com o mesmo ID:

```PHP
DB::table('usuarios')->where('id', 1)->delete();
```

Retorna o número de registros apagados.

- Apagar TODOS os registros e resetar o auto-incremento (Limpar a tabela):

```PHP
DB::table('usuarios')->truncate();
```
(Nota: Em bancos locais isso funciona perfeitamente, mas o comando `truncate` falhará se a tabela tiver chaves estrangeiras ativas vinculadas a ela).

### Sair do ambiente Tinker

Para encerrar a inspeção e fechar o interpretador do Tinker, basta digitar `exit`.

## Definir um FormRequest para `usuarios`

O comando bash cria um FormRequest para a clase usuário.

```bash
php artisan make:request StoreUsuarioRequest
```

Novidade Exclusiva do Laravel 13: O ecossistema do Laravel 13 introduziu o `FormRequest` `Strict` `Mode`.

Se ativado, ele rejeita automaticamente qualquer campo enviado na requisição que não tenha sido explicitamente declarado nas suas regras (`rules`), blindando a aplicação contra injeção de dados maliciosos.

Um FormRequest no Laravel 13 serve para isolar e limpar os Controllers, assumindo duas atribuições principais:

- **Validação Automatizada:** Executa e barra dados incorretos com base em regras (método `rules`) antes mesmo de a requisição chegar à lógica principal do seu Controller.

    Regra para validação dos campos do formulário, sendo agora uma responsabilidade da aplicação.

    ```php
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'  => 'required|string|min:2|max:255',
            'senha' => 'required|string|min:6|max:255', // max adicionado por segurança
            'email' => [
                'required',
                'email:rfc,dns', // Validação RFC e DNS ativada
                'unique:usuarios,email'
            ],
        ];
    }    
    ```

- **Autorização de Acesso:** Verifica se o usuário autenticado tem permissão para realizar aquela ação específica (método `authorize`).

    Autoriza qualquer usuário a enviar os dados por ser um cadastro de usuário.

    ```php
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    ```

- **Modifica as mensagens padrão:** As mensagens padrão são modiifcadas da seguinte forma:

    ```php
    /**
     * Customiza as mensagens de erro para esta validação.
     */
    public function messages(): array
    {
        return [
            'email.unique'   => 'Este e-mail já está cadastrado em nosso sistema.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email'    => 'Por favor, insira um endereço de e-mail válido.',
            'nome.required'  => 'O campo nome é obrigatório.',
            'senha.min'      => 'A senha deve conter no mínimo 6 caracteres.',
        ];
    }    
    ```

## Atualiza o `Controller` para utilizar o `FormRequest`

Valida os dados utilizando o `FormRequest` no método `salvar` da classe `UsuarioModel`.

No método `salvar` modificar o tipo de dado do argumento de `Request` para `StoreUsuarioRequest`:

```php
public function salvar(StoreUsuarioRequest $request) 
{
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
}
```

## Atualizar o `UsuarioModel` para incluir os dados

O método `cadastrar` é responsável por:

- Verificar se o e-mail é único

- Incluir os dados na base de dados através do método `self::insert` como argumento do método `DB::transaction`, utilizado para garantir a aatomicidade das operações de inlcusão de dados.

> O DB::transaction() serve para garantir a atomicidade do banco de dados (o princípio "tudo ou nada").

Funcionalidades do `DB::transaction()`:
- **Agrupamento:** Une múltiplas operações de banco (operações de escrita, atualização ou exclusão) em um único bloco técnico.
- **Auto-Commit:** Salva e consolida permanentemente todas as alterações no banco se o código interno for executado com sucesso até o fim.
- **Auto-Rollback:** Desfaz e cancela instantaneamente todas as alterações anteriores caso ocorra qualquer erro ou exceção no meio do caminho, impedindo dados corrompidos ou incompletos.

> Vantagem de utilizar dentro do Model

Mover o DB::transaction() do Controller para dentro do Model traz vantagens cruciais de arquitetura:

- **Encapsulamento:** A responsabilidade de como os dados são salvos pertence ao banco e ao Model. O Controller não precisa saber os detalhes internos.

- **Reutilização de Código:** Você pode criar o registro complexo de um usuário em APIs, comandos de terminal (Artisan) ou filas de processos (Jobs) chamando a mesma função do Model, sem repetir código.

- **Testabilidade Simples:** Permite criar testes unitários isolados e focados diretamente na regra de negócio do Model, sem depender de rotas ou requisições HTTP.S

Modificar o método `cadastrar` da classe `UsuarioModel` para:

```php
public static function cadastrar(Request $request){

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
            "data_cadastro" => Carbon::now()
        ]);
    });
}
```

## Retorno dos valores anteriores

Retorno dos valores anteriores após uma excessão através da inclusão do helper `old()` diretamente no arquivo `.blade.php`.

```html
<div class="field">
    <label  for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="{{ old('nome') }}"/>

    @if($errors->has('nome'))
        @foreach ($errors->get('nome') as $error)
            <strong class="erro"> {{ $error }}</strong>
        @endforeach
    @endif
</div>

<div class="field">
    <label  for="email">E-mail:</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}"/>

    @if($errors->has('email'))
        @foreach ($errors->get('email') as $error)
            <strong class="erro"> {{ $error }}</strong>
        @endforeach
    @endif            
</div>
```

## Retorno dos usuários via POST em uma API

### Configurar a rota

Configurar a rota `POST` em `API.php`

```php
Route::prefix('v1')->group(function(){
    Route::get('lista', function(){
        // return ["a", "b", "c"];
        return UsuarioModel::listar(10);
    });

    Route::post('cadastra', function(){
        return 'implementar post v1';
    });
});
```

### Definir o método `listar()`

Definir o método `listar()` dentro da classe `UsuariModel.php`:

```php
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
```

### Modificar o fuso horário de `UTC` para outra zona

As datas são armazenadas em forma de string na zona `UTC`, sendo a conversão para outra zona horária realizada utlizando `Mutators/Casts`.

> **Mutators** e **Casts** funcionam como filtros de tratamento automático de dados no Laravel: enquanto os *Casts* convertem os tipos de dados do banco de dados (como transformar uma string de data em um objeto `Carbon` manipulável ou um número em booleano), os *Mutators* (ou *Accessors*) interceptam a leitura ou a escrita de um atributo para aplicar regras personalizadas — como converter uma data do fuso horário UTC para o de Brasília antes de exibi-la na tela, garantindo que toda essa lógica fique organizada dentro do Model e nunca espalhada pelos seus Controllers.

```php
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
```

## Classe de controle de rotas via API

### Criar a classe de controle de rotas via API

A classe `UsuarioController` é criada com o seguinte comando:

```bash
$ php artisan make:controller API/UsuarioController
```

### Definir o método `salvar`

Define o método `salvar` utilizando o `FormRequest` que define os requisitos de cadastro que cada novo usuário deve atender:

```php
class UsuarioController extends Controller
{
    public function salvar(StoreUsuarioRequest $request) {
        if (UsuarioModel::cadastrar($request)) {
            return response(
                "Usuário criado com sucesso!", // Created
                201
            );
        } else {
            return response(
                "Ops! Falha ao cadastrar!", // Unprocessable Entity
                422
            );            
        }
        // dd($request->all());
    }
}
```

### Configurar a rota API

A rota API é configura em `routes/api.php`

Utilizando a sintaxe antiga:

```php
    ...
    // A sintaxe antiga deve conter o caminho completo da classe
    Route::post(
        'cadastra', 'App\Http\Controllers\API\UsuarioController@salvar'
    );  
    ...
```

Ou utilizando a sintaxe moderna:

```php
    ...
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
    ...
```

## (TODO) Implementar os outros métodos de cadastro web e requisição da API

Implementar a edição e a remoção de usuários;

## 
