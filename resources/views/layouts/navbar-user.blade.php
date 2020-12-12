<li class="nav-item">
    <a class="nav-link text-white" href="{{ route('history.all') }}">Transaction History</a>
</li>
<li class="nav-item">
    <a class="nav-link text-white" href="{{ route('cart.index') }}">
        Cart ({{Auth::user()->carts->count()}})
    </a>
</li>