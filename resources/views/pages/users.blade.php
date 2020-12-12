@extends('layouts.app')

@section('content')
<div class="container">
    <h2>
        All user data
    </h2>
    <hr>
    <div class="row">
        @foreach ($users as $user)
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header bg-danger text-white">User ID: {{$user->id}}</div>
                <div class="card-body">
                <p class="card-text"><b>Username</b> : {{$user->username}}</p>
                <p class="card-text"><b>Email</b> : {{$user->email}}</p>
                <p class="card-text"><b>Address</b> : {{$user->address}}</p>
                <p class="card-text"><b>Phone Number</b> : {{$user->phone}}</p>
                <p class="card-text"><b>Gender</b> : {{$user->gender}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection