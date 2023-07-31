@extends('layouts.master')

@section('title', 'Услуга')

@section('content')
    <h1>{{$product->name}}</h1>
    <p>Цена: <b>От {{$product->price}} руб.</b></p>
    <img class="img-width" src="{{ Storage::url($product->image) }}">
    <br>
    <br>
    <h4>{{$product->description}}</h4>
    <h5>Категория: <b>{{$product->category->name}} </b> </h5>
@endsection

