@extends('layouts.app')

@section('content')
<div class="container">
    @if ($carts->count() === 0)
    <div class="alert alert-danger" role="alert">
        <h1 class="text-center">Cart Empty</h1>
        <hr>
        <p>Add item to cart before..</p>
    </div>
    @endif

    @if ($carts->count() > 0)
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <button class="btn btn-success">Checkout</button>
    </div>
    @endif

    @include('layouts.alert')
    
    @foreach ($carts as $cart)
    <div class="mt-3 card">
        <form action="{{route('cart.destroy', $cart->id)}}" class="d-flex flex-row-reverse bd-highlight" method="post" class="mr-5">
            @csrf
            {{ method_field('DELETE') }}
            <input type="hidden" name="id" required value="{{$cart->id}}">
            <input type="hidden" name="name" required value="{{$cart->pizza->name}}">
            <button type="submit" onclick="return confirm('Remove this item?')" class="btn btn-danger">X</button>
        </form>

        <div class="row mb-3">
            <div class="m-5 bd-highlight">
                <img class="" src="{{ asset('gambar/' . $cart->pizza->img)}}" style="width: 250px; height: 250px;">
            </div>
            <div class="col mt-3">
                <h4>{{ $cart->pizza->name }}</h4>
                <p>{{ $cart->pizza->description }}</p>
                <p>Quantity: <b>{{ $cart->qty }}</b></p>
                <p class="text-muted">
                    Total Price: <b>Rp. {{$cart->qty * $cart->pizza->price}}</b>
                </p>
                <hr>

                <form action="{{route('cart.update', $cart->id)}}" class="w-50" method="post" class="mr-5">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="qty">Update Quantity</label>
                        <input type="hidden" name="user_id" required value="{{Auth::user()->id}}">
                        <input type="hidden" name="pizza_id" required value="{{$cart->pizza->id}}">
                        <input type="hidden" name="name" required value="{{$cart->pizza->name}}">
                        <input type="number" class="form-control" id="qty" name="qty" required
                            placeholder="Input quantity">
                    </div>
                    <button type="submit" class="float-right btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection