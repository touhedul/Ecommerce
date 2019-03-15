@extends('layouts.admin-layout')
@section('title')
Index
@endsection
@section('content')
<h3>Category</h3></br>

<table class="table table-striped">
    <tr>
        <td><h3>Category Name:</h3></td>
        <td><h3>{{$category->name}}</h3></td>
    </tr>
    <tr>
        <td><h3>Category Description:</h3></td>
        <td><h3>{{$category->description}}</h3></td>
    </tr>
    <tr>
        <td><h3>Category Image:</h3></td>
        <td><img  src="{{asset('images/categories/'.$category->image)}}"></td>
    </tr>
</table>
@endsection

