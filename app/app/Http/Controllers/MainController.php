<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    #Возвращает главную страницу
    public function index()
    {
        $products = Product::get();
        return view('index', compact('products'));
    }

    #Возвращает страницу категорий
    public function categories()
    {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    #Возвращает определенную категорию
    public function category($code)
    {
        $category = Category::where('code', $code)->first();
//        $products = Product::where('category_id', $category->id)->get();
        return view('category', compact('category'));
    }

    #Возвращает имя продукта
    public function product($category, $product = null)
    {
        return view('product', ['product'=>$product]);
    }

    #Возвращает страницу корзина
    public function basket()
    {
        return view('basket');
    }

    #Возвращает страницу оформление заказа
    public function basketPlace()
    {
        return view('order');
    }
}
