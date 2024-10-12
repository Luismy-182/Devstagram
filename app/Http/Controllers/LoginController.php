<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



abstract class Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
use Illuminate\Support\Facades\Auth;







class LoginController extends Controller
{
    //public 
    public function index(){
        return view ('auth.login');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required'
        ]);


        if(!auth()->attempt($request->only('email','password'),$request->remember )){ // a pesar que marca erro el attempt si funciona :D
            //con el request->remember haces que te recuerde la session, nesesitas en la view tener el checkbox con remember
            return back()->with('mensaje','Credenciales incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username); //con esto metes tu username como url

    }



}
