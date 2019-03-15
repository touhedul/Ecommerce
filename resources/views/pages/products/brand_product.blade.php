@extends('layouts.master')

@section('title')
Index
@endsection
@section('content')
<div class="widget">
    <h2>{{$brand->name}} Brand Product</h2>
    <div class="row">
        @if (count($brandProduct)>0)
        
        @foreach($brandProduct as $bndProduct)
        <div class="col-md-3">
            <div class="card">
                <a href="{{ route('products.show',$bndProduct->id) }}">  <img class="card-img-top feature-img" src="{{asset('images/products/display_image/'.$bndProduct->display_image)}}" alt="Card image"></a>
                <div class="card-body">
                    <a href="{{ route('products.show',$bndProduct->id) }}"><h4 class="card-title">{{$bndProduct->title}}</h4></a>
                    <p class="card-text">Taka - {{$bndProduct->price}}</p>
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