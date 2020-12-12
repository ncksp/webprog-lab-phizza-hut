@extends('layouts.app')

@section('content')
<div class="container">
    <h2>
        Transaction Detail at
        <b>{{date('d F Y H:i:s', strtotime($histories[0]->created_at))}}</b>
    </h2>
    <hr>
    @foreach ($histories as $history)
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset('gambar/' . $history->pizza->img)}}" class="card-img" alt="{{$history->pizza->name}}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $history->pizza->name }}</h4>
                    <p class="card-text">{{ $history->pizza->description }}</p>
                    <p class="card-text">Price: <b>{{ $history->pizza->price }}</b></p>
                    <p class="card-text">Quantity: <b>{{ $history->qty }}</b></p>
                    <p class="card-text">
                        Total Price: <b>Rp. {{$history->qty * $history->pizza->price}}</b>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection