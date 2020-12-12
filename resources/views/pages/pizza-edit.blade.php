@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset('gambar/' . $pizza->img)}}" class="card-img" alt="{{$pizza->name}}">
            </div>
            <div class="col-md-8">
                <h4 class="card-header">
                    Edit pizza
                </h4>
                <div class="card-body">
                    @include('layouts.alert')
                    <form class="w-75" method="POST" action="{{route('pizza.update', $pizza->id)}}"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="id" required value="{{$pizza->id}}">
                        <input type="hidden" name="img_old" required value="{{$pizza->img}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required name="name" value="{{$pizza->name}}">
                            <small class="form-text text-muted">Don't forget to fill the name. Name should be less than
                                20
                                characters</small>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10"
                                required>{{$pizza->description}}</textarea>
                            <small class="form-text text-muted">Description pizza is required. Lets fill it with more
                                than 20
                                characters</small>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" required name="price" value="{{$pizza->price}}">
                            <small class="form-text text-muted">Type price of pizza. Min: 10000</small>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="img" value="{{$pizza->img}}">
                        </div>
                        <a href="{{route('home')}}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="float-right btn btn-success">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">

    </div>
</div>
@endsection