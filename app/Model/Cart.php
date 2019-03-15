<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    public $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'ip_address',
        'product_quantity',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);

    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public static function totalItems(){

        if(Auth::check()){
            $cart = Cart::where('user_id',Auth::id())->where('order_id',NULL)
                ->sum('product_quantity');
        }else{
            $cart = Cart::where('ip_address',request()->ip())->where('order_id',NULL)
                ->sum('product_quantity');
        }
        return $cart;
    }

    public static  function totalCarts(){
        if(Auth::check()){
            $cart = Cart::where('user_id',Auth::id())->where('order_id',NULL)->get();
        }else{
            $cart = Cart::where('ip_address',request()->ip())->where('order_id',NULL)->get();
        }
        return $cart;
    }
}
