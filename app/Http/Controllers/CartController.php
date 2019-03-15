<?php

namespace App\Http\Controllers;

use App\Model\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.carts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'product_id'=>'required'
        ]);

        if(Auth::check()){
            $cart = Cart::where('user_id',Auth::id())
                ->where('product_id',$request->product_id)
                ->where('order_id',NULL)
                ->first();

        }else{
            $cart = Cart::where('ip_address',$request->ip())
                ->where('product_id',$request->product_id)
                ->where('order_id',NULL)
                ->first();
        }

        if(!is_null($cart)){
            $cart->increment('product_quantity');
        }else{

            echo "<h1>ldsasdfsadfasdfdfsadfsdffjf</h1>";
            $cart = new Cart();
            if(Auth::check()){
                $cart->user_id = Auth::id();
            }
            $cart->product_id = $request->product_id;
            $cart->ip_address = $request->ip();
            $cart->save();
        }
        return redirect()->route('products.index')->with('success','Product has successfully added to cart.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $this->validate($request,[
            'product_quantity' => 'required|integer|min:1'
        ]);
        $cart->product_quantity = $request->product_quantity;
        $cart->save();
        return back()->with('success','Product Quantity has update successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return back()->with('success','Cart has successfully deleted.');
    }
}
