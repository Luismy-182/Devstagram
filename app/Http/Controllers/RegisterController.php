<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;//para poder usar la funcion attempt   
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
}



class RegisterController extends Controller
{
    public function index ()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd('Post....');

        //con este papi tu puedes ver si estan llegando los datos con el metodo POST a tu controlador desde la vista
        //dd($request->get ('username') );


        //modifica el request para que mas adelante en el campo username duplicado no te salte un mensaje feo de error de laravel
        //en su lugar que salga un aposible correccion automatica del request en username, agregando guiones
        
        $request->request->add(['username'=>Str::slug($request->username)]);

        //validacion automatica

        $this->validate($request, [
            'name' => 'required|max:30',
            'username'=>'required|unique:users|min:3|max:20',
            'email'=>'required|unique:users|email|max:30',
            'password'=>'required|confirmed|min:6'
        ]);

        User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        //autentificar


        //use Illuminate\Support\Facades\Auth;//para poder usar la funcion attempt  
        Auth::attempt($request->only('email','password'));
        //se requiere para poder usar la autentificacion  
        


        //redireccionar

        return redirect()->route('posts.index', auth()->user()->username); //con esto metes tu username como url);
    }
}
