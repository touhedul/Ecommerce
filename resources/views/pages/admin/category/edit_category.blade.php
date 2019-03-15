@extends('layouts.admin-layout')
@section('title')
Index
@endsection
@section('content')
<h3>Add Product</h3></br>
<form action="{{route('categories.update',$category->id)}}" data-parsley-validate method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Name</label>
        <input type="text" data-parsley-required class="form-control" value="{{$category->name}}" id="title" name="name">
    </div>
    <div class="form-group">
        <label for="pwd">Description:</label>
        <input type="text" name="description" value="{{$category->description}}" class="form-control" id="pwd">
    </div>

    <div class="form-group">
        <label for="pwd">Parent Category</label></br>
        <select name="parent_id" class="form-group">
            <option class="form-group" value="{{$category->parendId($category->parent_id)}}">{{$category->parentName($category->parent_id)}}</option>
            <option class="form-group" value="">Make This Parent</option>
            @foreach ($categoryName as $cat)
            <option class="form-group" value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
        
    </div>
    
    <div class="form-group">
        <label for="pwd">Image:</label>
    </div></br>
    <div class="row">
        <div class="col-md-4">
            <input type="file" name="category_image" class="form-control" id="pwd">
        
            <img height="200px" width="90px" class="card-img-top feature-img" src="{{asset('images/categories/'.$category->image)}}" alt="Card image">

        </div>
    </div>
    @csrf
    @method('PATCH')
    </br>
    <button type="submit" class="btn btn-success">Update Category</button>
</form>
@endsection