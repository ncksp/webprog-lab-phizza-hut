@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h4 class="card-header">
            Add new pizza
        </h4>
        <div class="card-body">
            @include('layouts.alert')
            <form class="w-50" method="POST" action="{{route('pizza.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" required name="name">
                    <small class="form-text text-muted">Don't forget to fill the name. Name should be less than 20
                        characters</small>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" cols="30" rows="10" required></textarea>
                    <small class="form-text text-muted">Description pizza is required. Lets fill it with more than 20
                        characters</small>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" required name="price">
                    <small class="form-text text-muted">Type price of pizza. Min: 10000</small>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" required name="img">
                </div>
                <a href="{{route('home')}}" class="btn btn-secondary">Back</a>
                <button type="submit" class="float-right btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection