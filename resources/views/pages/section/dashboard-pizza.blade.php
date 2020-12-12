<div class="container-fluid">
    <div class="section row d-flex justify-content-center">
        @foreach ($pizzas as $item)
        <div class="card col-md-3 m-3" style="width: 18rem;">
            <img src="{{asset('gambar/'.$item->img)}}" class="card-img-top embed-responsive-item"
                alt="{{$item->name}} Image" style="height: 15vw; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">{{$item->name}}</h5>
                <p class="card-text font-weight-bold">Rp. {{$item->price}}</p>
                <a href="{{route('pizza.show', $item->id)}}" class="btn btn-primary">See more</a>
            </div>

            @if (Auth::check() && Auth::user()->hasRole('admin'))
                @include('pages.section.pizza-management-option')
            @endif
        </div>
        @endforeach
    </div>
</div>
<div class="container">
    <div class="float-right">
        {{ $pizzas->appends(request()->query())->links() }}
    </div>
</div>