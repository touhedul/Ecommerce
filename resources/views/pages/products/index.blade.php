@extends('layouts.master')

@section('title')
Index
@endsection
@section('content')
<div class="widget">
	@php
	$chkCategoryName="";
	@endphp
	<div class="row">
		@foreach($products as $product)
		@if ($chkCategoryName !=  $product->category->name)
		<div class="col-md-12">
			<h3> {{$product->category->name}}</h3> <hr>
		</div>
		@php
		$chkCategoryName = $product->category->name;
		@endphp
		@endif
		<div class="col-md-3">
			<div class="card">
					<a href="{{ route('products.show',$product->id) }}">
                        <img class="card-img-top  feature-img" src="{{asset('images/products/display_image/'.$product->display_image)}}" alt="Card image"></a>

				<div class="card-body">
					<a href="{{ route('products.show',$product->id) }}">
						<h4 class="card-title">{{$product->title}}</h4></a>
					<p class="card-text">Taka - {{$product->price}}</p>
					@include('includes.cart_button')
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection