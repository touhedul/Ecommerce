@extends('layouts.admin-layout')
@section('title')
Index
@endsection
@section('content')
<h3>Add Product</h3></br>
<form action="{{route('admin_page.store')}}" data-parsley-validate method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" data-parsley-required value="{{old('title')}}" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="pwd">Description:</label>
        <input type="text" name="description" value="{{old('description')}}" class="form-control" id="pwd">
    </div>
    <div class="form-group">
        <label for="pwd">Quantity:</label>
        <input  data-parsley-type="number"  value="{{old('quantity')}}"name="quantity" 
        class="form-control" id="pwd">
    </div>
    <div class="form-group">
        <label for="pwd">Price:</label>
        <input data-parsley-type="number" value="{{old('price')}}" name="price" class="form-control" id="pwd">
    </div>

    <div class="form-group">
        <label for="pwd">Category</label></br>
        <select data-parsley-required name="category_id" class="form-group">
            <option class="form-group" value="">Select Category</option>
            @foreach ($categories as $cat)
            <option class="form-group" value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
     <div class="form-group">
        <label for="pwd">Brand</label></br>
        <select data-parsley-required name="brand_id" class="form-group">
            <option class="form-group" value="">Select Brand</option>
            @foreach ($brands as $brand)
            <option class="form-group" value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="pwd">Display Image:</label></br>
        <input data-parsley-required type="file" name="display_image">
    </div></br>
    <div class="form-group">
        <label for="pwd">More Image:</label>
    </div>
    <div class="row">
        <div class="col-md-3">
            <input type="file" name="product_image[]" class="form-control" id="pwd">
        </div>

        <div class="col-md-3">
            <input type="file" name="product_image[]" class="form-control" id="pwd">
        </div>

        <div class="col-md-3">
            <input type="file" name="product_image[]" class="form-control" id="pwd">
        </div>
        <div class="col-md-3">
            <input type="file"  name="product_image[]" class="form-control" id="pwd">
        </div>
    </div>
    @csrf
    <button type="submit" class="btn btn-success">Add Product</button>
</form>
@endsection