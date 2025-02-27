@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <h1>Our freshly made pizza!</h1>
        <hr>
        <form action="" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pizza Name" name="keyword"
                    aria-label="Recipient's username" value="{{Request::get('keyword')}}"
                    aria-describedby="button-addon2">
                <div class="input-group-append">
                    @if (Request::has('keyword'))
                    <button class="btn btn-outline-danger" onclick="return window.location.href = `{{route('home')}}`"
                        type="reset">Clear</button>
                    @endif
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        @if (Auth::check() && Auth::user()->hasRole('admin'))
            <a href="{{route('pizza.create')}}" class="btn btn-success mb-3">Add new pizza</a>
        @endif

        @include('layouts.alert')
    </div>
</div>
@include('pages.section.dashboard-pizza')
@endsection