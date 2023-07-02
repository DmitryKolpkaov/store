<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Mockery\Exception;

class BasketController extends Controller
{

    #Возвращает страницу корзина
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }
        return view('basket', compact('order'));
    }

    #Возвращает страницу оформление заказа
    public function basketPlace()
    {
        $orderId = session('orderId');
        if(is_null($orderId)){
            return redirect()->route('index');
        }

        $order = Order::find($orderId);

        return view('order', compact('order'));
    }

    #Добавление в корзину
    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }

        $product = Product::find($productId);
        session()->flash('success', 'Товар ' .$product->name. ' добавлен!');

        return redirect()->route('basket');
//        return view('basket', compact('order'));
    }

    #Удалить из корзины
    public function basketRemove($productId)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            throw new Exception('Order id is not correct');
        }

        $order = Order::find($orderId);

        if($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if($pivotRow->count < 2){
                $order->products()->detach($productId);
            }else{
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);
        session()->flash('success', 'Товар ' .$product->name. ' удален!');

        return redirect()->route('basket');
//        return view('basket', compact('order'));
    }

    #Подверждение заказа
    public function basketConfirm(Request $request)
    {
        $orderId = session('orderId');

        if(is_null($orderId)){
            return redirect()->route('index');
        }

        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

        if($success){
            session()->flash('success', 'Ваш заказ принят в обработку!');
        }else{
            session()->flash('warning', 'Ваш заказ не принят в обработку, повторите попытку!');
        }

        return redirect()->route('index');
    }
}
