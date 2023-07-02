<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    #Полная стоимость заказа
    public function getFullPrice()
    {
        $sum = 0;

        foreach($this->products as $product){
            $sum += $product->getPriceForCount();
        }

        return $sum;
    }
}
