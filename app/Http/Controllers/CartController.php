<?php

namespace App\Http\Controllers;

use App\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $req){ 
        $userId = $req->userId;
        $carts = cart::where('userId',$userId)->get();
        // return view('cart')->with('carts',$carts);
    }
    public function addToCart(Request $req){
        $userId = $req->userId;
        $pizzaId = $req->pizzaId;
        $qty = $req->qty;
        DB::insert("INSERT INTO carts('userId','pizzaId','qty') VALUES ($userId,$pizzaId,$qty)");
    }
    public function removeFromCart(Request $req){
        $userId = $req->userId;
        $pizzaId = $req->pizzaId;
        DB::delete('delete from carts where userId = ? and pizzaId = ?',[$userId,$pizzaId]);
    }
    public function updateFromCart(Request $req){
        $userId = $req->userId;
        $pizzaId = $req->pizzaId;
        $qty = $req->qty;
        DB::update('update carts set qty = ? where userId = ? and pizzaId = ?',[$qty,$userId,$pizzaId]);
    }
    
}
