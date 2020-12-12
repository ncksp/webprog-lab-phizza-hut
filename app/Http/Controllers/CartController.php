<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        //avoiding n+1 problem using with
        $carts = Cart::with('pizza')->where('user_id', $userId)->get();

        return view('pages.cart', compact('carts'));
    }

    public function store(CartRequest $req)
    {
        $where = [
            ['user_id', $req->user_id],
            ['pizza_id', $req->pizza_id]
        ];
        try {
            $exist = Cart::where($where)->first();

            if ($exist === null)
                Cart::create($req->all());
            else
                Cart::where($where)->update(['qty' => $exist->qty + $req->qty]);

            return redirect(route('home'))->with('success', 'Success add product to cart');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed add product to cart');
        }
    }

    public function destroy(Request $req)
    {
        try {
            Cart::find($req->id)->delete();
            return redirect()->back()->with('success', "Success remove product <b>($req->name)</b> from cart");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed remove product from cart');
        }
    }

    public function update(CartRequest $req)
    {
        try {
            $where = [
                ['user_id', $req->user_id],
                ['pizza_id', $req->pizza_id]
            ];

            Cart::where($where)->update(['qty' => $req->qty]);
            return redirect()->back()->with('success', "Success update quantity product <b>($req->name)</b> in cart");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Failed update quantity product <b>($req->name)</b> in cart");
        }
    }
}
