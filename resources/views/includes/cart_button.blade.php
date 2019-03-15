<form class="form-inline" action="{{route('carts.store')}}" method="POST">
@csrf
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <button type="submit" class="btn btn-warning">Add to Cart</button>
</form>