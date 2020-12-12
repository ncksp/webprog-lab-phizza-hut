@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transaction Data</h1>
    <hr>
    @foreach ($histories as $history)
    <a href="{{route('history.detail', $history->transaction_id)}}" style="text-decoration: none;">
        <div class="card mb-2">
            <div class="card-body">
                Transaction at <b>{{date('d F Y H:i:s', strtotime($history->created_at))}}</b>
            </div>
        </div>
    </a>
    @endforeach
</div>

@endsection