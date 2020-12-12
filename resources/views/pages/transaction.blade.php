@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transaction Data</h1>
    <hr>
    @foreach ($transactions as $transaction)
    <a href="{{route('history.detail', $transaction->transaction_id)}}" style="text-decoration: none;">
        <div class="card mb-2">
            <div class="card-body">
                <p>
                    Transaction at <b>{{date('d F Y H:i:s', strtotime($transaction->created_at))}}</b>
                </p>
                <p>
                    User ID : {{$transaction->user_id}}
                </p>
                <p>
                    Username : {{$transaction->username}}
                </p>
            </div>
        </div>
    </a>
    @endforeach
</div>

@endsection