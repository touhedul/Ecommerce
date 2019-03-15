@extends('layouts.admin-layout')

@section('title')
Index
@endsection
@section('content')
<h1>All Products</h1>
<table class="table table-striped table-hover">
    <tr>

        <th>SL</th>
        <th>Category Name</th>
        <th>Parent</th>
        <th>Clild</th>
        <th>Image</th>
        <th>Action</th>

    </tr>
    @php $i = 0; @endphp
    @foreach($categories as $category)
    <tr>
        @php $i++;@endphp
        <td>{{$i}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->parentName($category->parent_id)}}</td>
        <td>
            @foreach ($category->childName($category->id) as $childCategory)
            {{$childCategory->name."   "}}<span> &nbsp </span>
            @endforeach
        </td>

        <td><img src="{{asset('images/categories/'.$category->image)}}"></td>
        <td>
            <a href="{{route('categories.edit',$category->id)}}"><button class="btn btn-success">Edit</button></a>
            <a href="{{route('categories.show',$category->id)}}"><button class="btn btn-success">Show</button></a>

            <a href="#deleteModal{{$category->id}}" data-toggle="modal" class="btn btn-danger">Delete</a>

            <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{route('categories.destroy',$category->id)}}" method="POST">
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
@foreach($categories as $category)
    @if($category->parent_id == null)
    <h3>{{$category->name}}</h3></br>
        @foreach ($category->getChild($category->id) as $child)
            <span> &nbsp </span>{{' ->'.$child->name}}</br>

            @foreach ($child->getChild($child->id) as $dChild)
                <span> &nbsp </span> <span> &nbsp </span>{{' --->'.$dChild->name}}</br>
                @foreach ($dChild->getChild($dChild->id) as $tChild)
                   <span> &nbsp </span> <span> &nbsp </span>{{' ----->'.$tChild->name}}</br>
                @endforeach
            @endforeach
        @endforeach    
    @endif
@endforeach


@endsection