@extends('layouts.master')

@section('title', 'Услуга')

@section('content')
    <h1>{{$product}}</h1>
    <p>Цена: <b>71990 руб.</b></p>
    <img class="img-width" src="/images/layout.jpg">
    <p>Отличный продвинутый телефон с памятью на 64 gb</p>
    <a class="btn btn-success" href="http://laravel-diplom-1.rdavydov.ru/basket/1/add">Добавить в корзину</a>
@endsection

