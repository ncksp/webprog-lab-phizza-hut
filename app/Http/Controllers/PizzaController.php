<?php

namespace App\Http\Controllers;

use App\Http\Requests\PizzaRequest;
use App\Pizza;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PizzaController extends Controller
{
    public function __construct()
    {
        /*ngebuat method beda2 middlewarenya
        harusnya lebih bagus kalo make role permission lalu dibuat table kalo udh banyak methodnya
        bisa juga make laravel permission punya si "spatie"
        cuma karna ini cuma sedikit jadi masih oke
        */
        $this->middleware('authorization.simple:user,admin,guest')->only('show');

        $this->middleware('authorization.simple:admin')->only([
            'store', 'update', 'destroy'
        ]);
    }

    private function storeImage($image)
    {
        $img = $image->getClientOriginalName();
        $fileName = Uuid::uuid4() . "." . pathinfo($img, PATHINFO_EXTENSION);
        $image->move('gambar', $fileName);

        return $fileName;
    }

    public function show($pizzaId)
    { //buat ambil detail pizza
        $pizza = Pizza::findOrFail($pizzaId);
        return view('pages.pizza-detail', compact('pizza'));
    }

    public function store(PizzaRequest $req)
    { //buat insert pizza
        $req->validate(['img' => 'required|mimes:jpeg,png,jpg']);
        try {
            $request = $req->all();
            $request['img'] = $this->storeImage($req->img);

            Pizza::create($request);

            return redirect(route('home'))->with('success', 'Success add new pizza');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed add new pizza');
        }
    }

    public function create()
    {
        return view('pages.pizza-form');
    }

    public function edit($pizzaId)
    { //buat ambil detail pizza
        $pizza = Pizza::findOrFail($pizzaId);
        return view('pages.pizza-edit', compact('pizza'));
    }

    public function update(PizzaRequest $req)
    {
        $pizza = Pizza::findOrFail($req->id);
        try {
            if ($req->has('img'))
                $req->validate(['img' => 'required|mimes:jpeg,png,jpg']);

            $request = $req->all();
            $request['img'] = $request['img_old'];

            if ($req->has('img'))
                $request['img'] = $this->storeImage($req->img);;

            $pizza->update($request);
            return redirect(route('home'))->with('success', "Success update pizza ($pizza->name)");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Failed update pizza ($pizza->name)");
        }
    }

    public function destroy(Request $req)
    {
        $pizza = Pizza::findOrFail($req->id);
        try {
            unlink(public_path('gambar/' . $pizza->img));

            $pizza->delete();
            return redirect()->back()->with('success', "Success delete pizza <b>($pizza->name)</b>");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Failed to delete pizza <b>($pizza->name)</b>");
        }
    }
}