@extends('layouts.master')

@section('title', 'Услуга')

@section('content')
    <h1>{{$product->name}}</h1>
    <p>Цена: <b>{{$product->price}} руб.</b></p>
    <img class="img-width" src="{{ Storage::url($product->image) }}">
    <p>{{$product->description}}</p>
@endsection

