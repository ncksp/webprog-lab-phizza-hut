<?php

namespace App\Http\Controllers;

use App\Pizza;
use App\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pizzas = Pizza::latest('created_at');

        if (request()->query('keyword'))
            $pizzas = Pizza::where('name', 'like', "%" . request()->query('keyword') . "%")
                ->latest('created_at');

        $pizzas = $pizzas->paginate(6);

        return view('home', compact('pizzas'));
    }

    public function users()
    {
        $users = User::where('role', 'user')->get();

        return view('pages.users', compact('users'));
    }
}
