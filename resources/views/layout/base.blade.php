<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'CRM') }} :: @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
</head>
<body>

    <div class="container-flex">
        <img src="{{  asset('img/crm.png') }}" alt="CRM" class="logo-flex">
    </div>

    <div class="container">
        <h3>@yield('conteudo')</h3>      
    </div>    
    
    <footer>
        <p>Fabio Toledo Bonemer De Salvi - 2026</p>
    </footer>
</body>
</html>