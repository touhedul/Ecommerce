@extends('layouts.admin-layout')
@section('title')
Index
@endsection
@section('content')
<h3>Add Product</h3></br>
<form action="{{route('brands.update',$brand->id)}}" data-parsley-validate method="POST">
    <div class="form-group">
        <label for="title">Name</label>
        <input type="text" data-parsley-required class="form-control" id="title" name="name" value="{{$brand->name}}">
    </div>
    <div class="form-group">
        <label for="pwd">brand</label></br>
        <select data-parsley-required name="category_id" class="form-group">
            <option class="form-group" value="{{$brand->category->id}}">{{$brand->category->name}}</option>
            @foreach ($categoryNameId as $category)
            <option class="form-group" value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        
    </div>
</br>
@csrf
@method('PATCH')
<button type="submit" class="btn btn-success">Update brand</button>
</form>
@endsection