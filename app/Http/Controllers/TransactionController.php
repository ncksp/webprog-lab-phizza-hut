<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TransactionController extends Controller
{
    public function history()
    {
        //untuk transaction Detail
        $userId = Auth::user()->id;

        $histories = DB::table('transactions')
            ->selectRaw('DISTINCT transaction_id, created_at')
            ->where('user_id', $userId)
            ->get();

        return view('pages.history', compact('histories'));
    }

    public function historyDetail($id)
    {
        //avoiding (2n)+1 problem
        $histories = Transaction::with('pizza', 'user')
            ->where('transaction_id', $id)->get();

        return view('pages.transaction-detail', compact('histories'));
    }

    public function store()
    {
        $userId = Auth::user()->id;
        $carts = Cart::where('user_id', $userId);
        $transactionId = Uuid::uuid4();
        $insertTime = Carbon::now();
        try {
            DB::beginTransaction();
            $items = $carts->get();
            foreach ($items as $item) {
                Transaction::create([
                    'transaction_id' => $transactionId,
                    'user_id' => $userId,
                    'pizza_id' => $item->pizza_id,
                    'qty' => $item->qty,
                    'created_at' => $insertTime,
                ]);
            }
            $carts->delete();
            DB::commit();
            return redirect(route('history.all'))->with('success', 'Checkout success');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed checkout cart');
        }
    }
    public function all()
    {
        $transactions = DB::table('transactions as t')
            ->selectRaw('DISTINCT t.transaction_id, t.created_at, t.user_id, u.username')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->get();

        return view('pages.transaction', compact('transactions'));
    }
}