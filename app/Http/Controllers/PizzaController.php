<?php

namespace App\Http\Controllers;

use App\pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PizzaController extends Controller
{
    public function index(){ //buat ngambil semua pizza
        $pizzas = Pizza::all();
        // return view('home')->with('pizzas',$pizzas);
    }
    public function pizzaDetail($pizzaId){ //buat ambil detail pizza
        $pizza = pizza::where('Id',$pizzaId);
        // return view('pizzaDetail')->with('pizza',$pizza);
    }
    public function addPizza(Request $req){ //buat insert pizza
        $name = $req->name;
        $price = $req->price;
        $img = $req->name;
        DB::insert("INSERT INTO pizzas('name','price','img') VALUES ($name,$price,$img)");
        //insert db
    }

}
