<?php

namespace App\Http\Controllers;

use App\Model\Cart;
use App\Model\Order;
use App\Model\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Sodium\compare;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return view('pages.orders',compact('payments'));
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
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required'
        ]);

        if($request->payment_method != "cash_in"){
            if($request->transaction_id == NULL || empty($request->transaction_id)){
                return back()->with('error','Please Insert Transaction Id');
            }
        }
        $payment_id = Payment::where('short_name',$request->payment_method)->first();
        $order = new Order();
        if(Auth::check()){
            $order->user_id = Auth::id();
        }

        $order->email = $request->email;
        $order->name = $request->name;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->ip_address = request()->ip();
        $order->payment_id = $payment_id->id;
        $order->transaction_id = $request->transaction_id;
        $order->save();

        foreach (Cart::totalCarts() as $cart){
            $cart->order_id = $order->id;
            $cart->save();
        }
        return redirect()->route('products.index')->with('success','Order Successful');


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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
