<form action="{{route('cart.store')}}" method="post" class="mr-5">
    @csrf
    <div class="form-group">
        @include('layouts.alert')
        <label for="qty">Quantity</label>
        <input type="hidden" name="user_id" required value="{{Auth::user()->id}}">
        <input type="hidden" name="pizza_id" required value="{{$pizza->id}}">
        <input type="number" class="form-control" id="qty" name="qty" required placeholder="Input quantity">
    </div>
    <button type="submit" class="float-right btn btn-primary">Add to cart</button>
</form>