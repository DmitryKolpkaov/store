<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    #Получаем категорию по category_id
    public function getCategory()
    {
        return Category::find($this->category_id);
    }

    #Связь product с category 1 к 1, используем для получения названия категории у продуктов
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    #Получаем правильную стоимость в зависимости от количества товаров
    public function getPriceForCount()
    {
        if(!is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

}
