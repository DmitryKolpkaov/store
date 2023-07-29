<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('index')}}">Интернет Магазин</a>
        </div>

        <div id="navbar" class="collapse navbar-collapse ">
            <div class="dropdown mgt-05 flex-end">
                <button class="btn dropdown-toggle btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Меню
                </button>
                <ul class="dropdown-menu ">
                    <li @if(Route::currentRouteNamed('index')) class="active dropdown-item" @endif><a href="{{route('index')}}">Все товары</a></li>
                    <li @if(Route::currentRouteNamed('categor*')) class="active dropdown-item" @endif><a href="{{route('categories')}}">Категории</a></li>
                    <li @if(Route::currentRouteNamed('basket')) class="active dropdown-item" @endif><a href="{{route('basket')}}">В корзину</a></li>

                    @guest
                        <li><a href="{{ route('login') }}">Войти</a></li>
                    @endguest

                    @auth
                        @if(Auth::user()->isAdmin())
                            <li><a href="{{ route('orders') }}">Панель администратора</a></li>
                        @else
                            <li><a href="{{ route('orders.person') }}">Мои заказы</a></li>
                        @endif
                        <li><a href="{{ route('get-logout') }}">Выйти</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>


<div class="container">
    <div class="starter-template">
        @if(session()->has('success'))
            <p class="alert alert-success">{{session()->get('success')}}</p>
        @endif
        @if(session()->has('warning'))
            <p class="alert alert-warning">{{session()->get('warning')}}</p>
        @endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
