@extends('layouts.master')

@section('title')
{{$product->slug}}
@endsection
@section('content')
<div class="widget">
    <h2>{{$product->title}}</h2><span>{{$product->quantity}} in stock</span>
    <p class="card-text">Taka - {{$product->price}}</p>
    <hr>
    <h2>Description:</h2>
    <p>{{$product->description}}</p>
</br>
</div>
<div class="row">
    <div class="col-md-6">

    </div>
</div>




<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
</ol>
<div class="carousel-inner">
    @php
        $i = 1;
    @endphp
    @foreach ($product->images as $image)
    <div class="carousel-item {{$i == 1 ? 'active':''}}">
      <img class="d-block w-100" src="{{ asset('images/products/'.$image->image) }}" alt="First slide">
    </div>
    @php
        $i++;
    @endphp
    @endforeach
</div>
<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div>
@endsection