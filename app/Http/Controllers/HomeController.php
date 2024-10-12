<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Foundation\Validation\ValidatesRequests;



 
class HomeController extends Controller implements HasMiddleware

{

    //Mostramos el index del formulario de edicion pero protegemos con un middleware primero 

    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function middleware(): array
    {
        return [
            new Middleware('auth')
        ];
    }
    //Home




    public function index(){
        
        
       

        //obtener a quienes seguimos

        //desde el usuario autentificado trae al usuario del metodo que construimos followings,
        // y con el puck pedimos solo su id, y conviertelo a un arreglo
        $ids=(auth()->user()->followings->pluck('id')->toArray()) ;
        $posts=Post::whereIn('user_id', $ids)->latest()->paginate(20);
        
        return view('home',[
            'posts'=>$posts
        ]);



    }
}
