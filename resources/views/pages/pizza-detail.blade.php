@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-3 card">
        <div class="row">
            <div class="col-6">
                <img class="img-fluid" src="{{ asset('gambar/' . $pizza->img) }}">
            </div>
            <div class="col-6 mt-3">
                <h1 class="text-center">{{ $pizza->name }}</h1>
                <p class="lead">
                    {{ $pizza->description }}
                </p>
                <p class="text-muted">
                    Rp. <b>{{$pizza->price}}</b>
                </p>

                {{-- BAD AUTHORIZATION CHECKING
                seharusnya tiap role punya folder view nya masing masin
                user/...
                admin/...
                
                tapi karna ga terlalu ribet jadi ini masih oke lah hehehe
                --}}
                @if (Auth::check() && Auth::user()->hasRole("user"))
                    @include('pages.section.pizza-detail-buy')
                @endif
                <a class="align-self-end" href="{{route('home')}}">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection