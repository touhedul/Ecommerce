@extends('layouts.admin-layout')
@section('title')
Index
@endsection
@section('content')
<h3>Add Product</h3></br>
<form action="{{route('admin_page.update',$product->id)}}" data-parsley-validate method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" data-parsley-required class="form-control" value="{{$product->title}}" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="pwd">Description:</label>
        <input type="text" name="description" value="{{$product->description}}" class="form-control" id="pwd">
    </div>
    <div class="form-group">
        <label for="pwd">Quantity:</label>
        <input  data-parsley-type="number" value="{{$product->quantity}}" name="quantity" class="form-control" id="pwd">
    </div>
    <div class="form-group">
        <label for="pwd">Price:</label>
        <input data-parsley-type="number" value="{{$product->price}}" name="price" class="form-control" id="pwd">
    </div>
    <div class="form-group">
        <label for="pwd">Category</label></br>
        <select data-parsley-required name="category_id" class="form-group">
            <option class="form-group" value="{{$category->id}}">{{$category->name}}</option>
            @foreach ($categories as $cat)
            <option class="form-group" value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="pwd">Brand</label></br>
        <select data-parsley-required name="brand_id" class="form-group">
            <option class="form-group" value="{{$brand->id}}">{{$brand->name}}</option>
            @foreach ($brands as $brand)
            <option class="form-group" value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="pwd">Display Image:</label></br>
        <input  type="file" name="display_image">
        <img height="150px" width="200px" src="{{asset('images/products/display_image/'.$product->display_image)}}" alt="Card image">
    </div></br>
    Add Image
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
            <input type="file" name="product_image[]" class="form-control" id="pwd">
        </div>
    </div>
    @csrf
    @method('PATCH')
</br>
<button type="submit" class="btn btn-success">Update Product</button>
</form>

<div class="row">
    @foreach($product->images as $image)
    <div class="col-md-4">

        <img height="150px" width="80px" class="card-img-top feature-img" src="{{asset('images/products/'.$image->image)}}" alt="Card image">

        <p><a href="#deleteModal{{$image->id}}" data-toggle="modal" class="btn btn-danger">Delete</a></p>

        <div class="modal fade" id="deleteModal{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3> Are You Sure To Delete? </h3>
                        <form action="{{route('admin_page.imgDelete',$image->id)}}" method="POST">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button class="btn btn-danger" type="submit" >Delete</button>
                            @csrf
                            {{--  @method('DELETE') --}}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection