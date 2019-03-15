{{--@extends('layouts.master')--}}

{{--@section('title')--}}
    {{--Carts--}}
{{--@endsection--}}
{{--@section('content')--}}
@include('includes.css-link')
@include('includes.navbar')
<div class="container">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No.</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>sub total Price</th>
            <th>Action</th>
        </tr>
        </thead>
        @php
        $totalPrice = 0;
        @endphp
        @foreach(\App\Model\Cart::totalCarts() as $cart)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td><a href="{{route('products.show',$cart->product_id)}}">{{$cart->product->title}}</a></td>
            <td> <img  width="70px" src="{{asset('images/products/display_image/'.$cart->product->display_image)}}" alt="Card image"></td>
            <td>
                <form class="form-inline" action="{{route('carts.update',$cart->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="number" value="{{$cart->product_quantity}}" class="form-control" name="product_quantity">
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </td>

            <td>{{$cart->product->price}}</td>
            <td>
                {{$cart->product->price*$cart->product_quantity}}
                @php
                $totalPrice += $cart->product->price*$cart->product_quantity;
                @endphp
            </td>
            <td>
                <form class="form-inline" action="{{route('carts.destroy',$cart->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="cart_id" value="{{$cart->id}}">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <h2>Total Price is {{$totalPrice}}</h2>
    <div class="float-right">
        <a href="{{route('products.index')}}"><button class="btn btn-warning">Continue Shoping...</button></a>
        <a href="{{route('orders.index')}}"><button class="btn btn-success">Order</button></a>
    </div>
</div>
{{--@endsection--}}