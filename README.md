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
