<?php

namespace App\Http\Controllers;

use App\Pizza;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pizzas = Pizza::paginate(6);

        if(request()->query('keyword'))
            $pizzas = Pizza::where('name', 'like', "%". request()->query('keyword')."%")->paginate(6);
        
        return view('home', compact('pizzas'));
    }
}
