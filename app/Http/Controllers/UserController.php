<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('user')->with('users',$users);
    }
    public function register(Request $req){
        $user = new User();
        $name = $req->name();
        $password = $req->password();
        $passwordHash = Hash::make($password);
        $email = $req->email();
        DB::insert("INSERT INTO users('name','email','password') VALUES ($name,$email,$passwordHash)");
        //direct ke login page
    }
    public function login(Request $req){
        $email = $req->email;
        $pass = $req->password;
        if(Auth::attempt([
            'email'=>$email,
            'password'=>$pass   
        ],false)){
            return redirect('/');
        }
        return redirect()->back();
    }
    public function logOut(){
        Auth::logout();
        return redirect('/');
    }
}
