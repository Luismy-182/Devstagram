<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



abstract class Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
}

class ComentarioController extends Controller
{
    //store para almacenar los comentarios

    public function store(Request $request, User $user, Post $post){
        
        
        //para guardar y mostrar comentario, requieres:
        //validar
        $this->validate($request,[
            'comentario' =>'required|max:255'
        ]);

        //almacenar

        Comentario::create([
            'user_id'=>auth()->user()->id,
            'post_id'=>$post->id,
            'comentario'=>$request->comentario
        ]);
        //mostrar en la vista

        return back()->with('mensaje', 'comentario realizado');
    }
}
