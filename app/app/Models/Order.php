<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mockery\Exception;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function products()
    {
        return $this->belongsToMany( Product::class )->withPivot( 'count' )->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo( User::class );
    }


    #Полная стоимость заказа
    public function getFullPrice()
    {
        $sum = 0;

        foreach( $this->products as $product ){
            $sum += $product->getPriceForCount();
        }

        return $sum;
    }

    public function saveOrder($name, $phone)
    {
        if( $this->status == 0 ){
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();

            session()->forget( 'orderId' );

            return true;
        } else{
            throw new Exception( 'Order status = 1' );
        }

    }
}
