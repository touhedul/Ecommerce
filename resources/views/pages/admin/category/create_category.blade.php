@extends('layouts.admin-layout')
@section('title')
Index
@endsection
@section('content')
<h3>Add Category</h3></br>
<form action="{{route('categories.store')}}" data-parsley-validate method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Name</label>
        <input type="text" data-parsley-required class="form-control" id="title" name="name" value="{{old('name')}}">
    </div>
    <div class="form-group">
        <label  for="pwd">Description:</label>
        <input type="text"  name="description" class="form-control" id="pwd">
    </div>

    <div class="form-group">
        <label for="pwd">Parent Category</label></br>
        <select name="parent_id" class="form-group">
            <option class="form-group" value="">Make This Parent</option>
            @foreach ($categoryName as $category)
            <option class="form-group" value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        
    </div>
    <div class="form-group">
        <label for="pwd">Image:</label>
    </div>
    <div class="row">
        <div class="col-md-3">
            <input type="file" name="category_image" class="form-control" id="pwd">
        </div>
    </div></br>
    @csrf
    <button type="submit" class="btn btn-success">Add Category</button>
</form>
@endsection