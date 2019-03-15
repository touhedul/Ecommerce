@extends('layouts.master')

@section('title')
Index
@endsection
@section('content')
<div class="widget">
    <h2>{{$category->name}} Category Product</h2>
    <div class="row">
        @if (count($categoryProduct)>0)
        
        @foreach($categoryProduct as $catProduct)
        <div class="col-md-3">
            <div class="card">
                <a href="{{ route('products.show',$catProduct->id) }}">  <img class="card-img-top feature-img" src="{{asset('images/products/display_image/'.$catProduct->display_image)}}" alt="Card image"></a>
                <div class="card-body">
                    <a href="{{ route('products.show',$catProduct->id) }}"><h4 class="card-title">{{$catProduct->title}}</h4></a>
                    <p class="card-text">Taka - {{$catProduct->price}}</p>
                    <a href="#" class="btn btn-outline-primary">Add to Cart</a>
                </div>
            </div>
        </div>
        @endforeach

        @else
        <h3 style="color:red">No Product Found</h3>
        @endif

        
    </div>
</div>
@endsection