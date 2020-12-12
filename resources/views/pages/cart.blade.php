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
        <form action="{{route('transaction.store')}}" class="d-flex flex-row-reverse bd-highlight" method="post"
            class="mr-5">
            @csrf
            <button class="btn btn-success" type="submit"
                onclick="return confirm('Continue to checkout?')">Checkout</button>
        </form>
    </div>
    @endif

    @include('layouts.alert')

    @foreach ($carts as $cart)
    <div class="card mb-3">
        <form action="{{route('cart.destroy', $cart->id)}}" class="d-flex flex-row-reverse bd-highlight" method="post"
            class="mr-5">
            @csrf
            {{ method_field('DELETE') }}
            <input type="hidden" name="id" required value="{{$cart->id}}">
            <input type="hidden" name="name" required value="{{$cart->pizza->name}}">
            <button type="submit" onclick="return confirm('Remove this item?')" class="btn btn-danger">X</button>
        </form>
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset('gambar/' . $cart->pizza->img)}}" class="card-img" alt="{{$cart->pizza->name}}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $cart->pizza->name }}</h4>
                    <p class="card-text">{{ $cart->pizza->description }}</p>
                    <p class="card-text">Quantity: <b>{{ $cart->qty }}</b></p>
                    <p class="card-text">
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
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection