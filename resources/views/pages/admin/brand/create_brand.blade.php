@extends('layouts.admin-layout')
@section('title')
Brand
@endsection
@section('content')
<h3>Add Brand</h3></br>
<form action="{{route('brands.store')}}" data-parsley-validate method="POST">
    <div class="form-group">
        <label for="title">Name</label>
        <input type="text" data-parsley-required class="form-control" id="title" name="name" value="{{old('name')}}">
    </div>
    <div class="form-group">
        <label for="pwd">Parent Category</label></br>
        <select data-parsley-required name="category_id" class="form-group">
            <option class="form-group" value="">Select Category</option>
            @foreach ($categoryNameId as $category)
            <option class="form-group" value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        
    </div>
    </br>
@csrf
<button type="submit" class="btn btn-success">Add brand</button>
</form>
@endsection