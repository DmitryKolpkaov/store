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
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    #Возвращает страницу категорий
    public function categories()
    {
        $categories = Category::paginate(1);
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
    public function product(Product $product)
    {
        $product->get('id');
        return view('product', compact('product'));
    }

    public function show(Product $product)
    {
        $category = $product->getCategory();
        return view('product', compact('product', 'category'));
    }


}
