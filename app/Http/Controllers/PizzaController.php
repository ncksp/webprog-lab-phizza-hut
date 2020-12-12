<?php

namespace App\Http\Controllers;

use App\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PizzaController extends Controller
{

    public function detail($pizzaId)
    { //buat ambil detail pizza
        $pizza = Pizza::where('id', $pizzaId)->first();
        return view('pages.pizza-detail', compact('pizza'));
    }

    public function store(Request $req)
    { //buat insert pizza
        $name = $req->name;
        $price = $req->price;
        $img = $req->name;
        DB::insert("INSERT INTO pizzas('name','price','img') VALUES ($name,$price,$img)");
        //insert db
    }
}
