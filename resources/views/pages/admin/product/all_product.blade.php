@extends('layouts.admin-layout')

@section('title')
Index
@endsection
@section('content')
<h1>All Products</h1>
<table class="table table-striped table-hover">
    <tr> 

        <th>SL</th>
        <th>Product Title</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>

    </tr>
    @php $i = 0; @endphp
    @foreach($products as $product)
    <tr>
        @php $i++;@endphp
        <td>{{$i}}</td>
        <td>{{$product->title}}</td>
        <td>{{$product->category->name}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->price}}</td>
        <td>
            <a href="{{route('admin_page.edit',$product->id)}}"><button class="btn btn-success">Edit</button></a>

            <a href="#deleteModal{{$product->id}}" data-toggle="modal" class="btn btn-danger">Delete</a>

            <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{route('admin_page.destroy',$product->id)}}" method="POST">
                                <button class="btn btn-danger" type="submit" >Delete</button>
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </td>
    </tr>
    @endforeach
</table>
@endsection