@extends('layouts.admin-layout')

@section('title')
Index
@endsection
@section('content')
<h1>All Products</h1>
<table class="table table-striped table-hover">
    <tr>

        <th>SL</th>
        <th>Brand Name</th>
        <th>Category Name</th>
        <th>Action</th>

    </tr>
    @php $i = 0; @endphp
    @foreach($brands as $brand)
    <tr>
        @php $i++;@endphp
        <td>{{$i}}</td>
        <td>{{$brand->name}}</td>
        <td>

            {{$brand->category->name}}
           {{--  @foreach ($brand->category as $bc)
                {{$bc->name}}
            @endforeach  --}}
        </td>

        <td>
            <a href="{{route('brands.edit',$brand->id)}}"><button class="btn btn-success">Edit</button></a>

            <a href="#deleteModal{{$brand->id}}" data-toggle="modal" class="btn btn-danger">Delete</a>

            <div class="modal fade" id="deleteModal{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{route('brands.destroy',$brand->id)}}" method="POST">
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