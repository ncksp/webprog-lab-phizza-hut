<?php

namespace App\Http\Controllers;

use App\transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $req){ //untuk transaction Detail
        $userId = $req->userId;
        $transactions = transaction::where('userId',$userId)->get();
        // return view('transaction')->with('transactions',$transactions);
    }
    public function getAllTransaction(){ //untuk admin view all
        $transactions = transaction::all();
        // return view('transaction')->with('transactions',$transactions);
    }
    
}
