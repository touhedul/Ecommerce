@extends('layouts.master')

@section('title')
Index
@endsection
@section('content')
<div class="widget">
    <h2>Search Products for {{$value}}</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3">
            <div class="card">
                <a href="{{ route('products.show',$product->id) }}">
                    <img class="card-img-top feature-img"
                         src="{{asset('images/products/display_image/'.$product->display_image)}}"
                         alt="Card image">
                </a>
                <div class="card-body">
                    <a href="{{ route('products.show',$product->id) }}"><h4 class="card-title">{{$product->title}}</h4></a>
                    <p class="card-text">Taka - {{$product->price}}</p>
                    @include('includes.cart_button')
                </div>
            </div>
        </div>
        @endforeach 
        @if ($categoryProduct)
            {{-- expr --}}
        
        @foreach($categoryProduct as $product)
        <div class="col-md-3">
            <div class="card">
                <a href="{{ route('products.show',$product->id) }}">  <img class="card-img-top feature-img" src="{{asset('images/products/display_image/'.$product->display_image)}}" alt="Card image"></a>
                <div class="card-body">
                    <a href="{{ route('products.show',$product->id) }}"><h4 class="card-title">{{$product->title}}</h4></a>
                    <p class="card-text">Taka - {{$product->price}}</p>
                    @include('includes.cart_button')
                </div>
            </div>
        </div>
        @endforeach
        @endif
         @if ($brandProduct)
            {{-- expr --}}
        
        @foreach($brandProduct as $product)
        <div class="col-md-3">
            <div class="card">
                <a href="{{ route('products.show',$product->id) }}">  <img class="card-img-top feature-img" src="{{asset('images/products/display_image/'.$product->display_image)}}" alt="Card image"></a>
                <div class="card-body">
                    <a href="{{ route('products.show',$product->id) }}"><h4 class="card-title">{{$product->title}}</h4></a>
                    <p class="card-text">Taka - {{$product->price}}</p>
                    @include('includes.cart_button')
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@endsection