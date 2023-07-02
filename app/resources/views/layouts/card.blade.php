<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="/images/layout.jpg"
             alt="iPhone X 64GB">
        <div class="caption">
            {{--Название и цена у продуктов--}}
            <h3>{{$product->name}}</h3>
            <p>{{$product->price}}</p>
            <p>
                <form action="{{route('basket-add', $product)}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary"
                       role="button">В корзину</button>
                    {{--Название категории к которой относится продукт--}}
                    {{$product->category->name}}
                    <a href="{{route('product', [$product->category->code, $product->code])}}"
                       class="btn btn-default"
                       role="button">Подробнее</a>
                </form>
            </p>
        </div>
    </div>
</div>
