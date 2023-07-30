@extends('auth.layouts.master')

@section('title', 'Заказы')

@section('content')
    <div class="col-md-12">
        <h1>Заказы</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    №
                </th>
                @if(Auth::user()->isAdmin())
                    <th>
                        Имя
                    </th>

                    <th>
                        Телефон
                    </th>

                    <th>
                        Когда отправлен
                    </th>
                @endif

                <th>
                    Сумма
                </th>

                <th>
                </th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id}}</td>
                    @if(Auth::user()->isAdmin())
                        <td>{{ $order->name }}</td>

                        <td>{{ $order->phone }}</td>

                        <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    @endif
                    <td>{{ $order->getFullPrice() }} руб.</td>

                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success" type="button"
                               @if(Auth::user()->isAdmin())
                               href="{{ route('orders.show', $order) }}"
                               @else
                                   href="{{ route('orders.person.show', $order) }}"
                               @endif
                            >Заказ</a>

                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$orders->links()}}
    </div>
@endsection
