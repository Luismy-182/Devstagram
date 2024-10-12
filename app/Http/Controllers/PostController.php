<?php

namespace App\Http\Controllers;



use App\Models\Post;



use Illuminate\Http\Request;

/*Traiamos el siguiente error al llamar desde
//use Illuminate\Foundation\Auth\User;
//Call to undefined method Illuminate\Foundation\Auth\User::siguiendo()
se traia desde la vista el siguiente metodo 
!$user->siguiendo(auth()->user() )

daba error porque la libreria de arriba importada no era la que se requeria, necesitamos el modelo de usuario el cual no importamos, de ahi el error
ahora el link que si necesitamos

*/
use App\Models\User;

use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



abstract class Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;




class PostController extends Controller implements HasMiddleware //con middleware para verificar nuestro loggin
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    public function index(User $user){
        //dd(auth()->user() ); //a pesar que marca error, si funciona para debuguear usuario
        
        $posts=Post::where('user_id',$user->id)->latest()->paginate(20);


        //contador total de posts
        $numPosts = count(Post::where("user_id", $user->id)->get());
     

        
        return view('dashboard',[
            'user'=>$user,
            'posts'=>$posts,

            "user" => $user, 
            "posts" => $posts, 
            "numPosts" => $numPosts
        ]);

        


    }

    //permite tener el formulario de publicacion de tipo get
    public function create(){
        return view('posts.create');
    }


    //almacena en la bd
    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen'=>'required'
        ]);
        

        Post::create([
            'titulo'=>$request->titulo,
            'descripcion'=>$request->descripcion,
            'imagen'=>$request->imagen,
            'user_id'=>auth()->user()->id

        ]);

        //otra forma de almacenar registros usando objetos

        ////  $post= new Post;
        //    $post->titulo=$request->titulo;
        //    $post->descripcion=$request->descripcion;
        //    $post->imagen=$request->imagen;
        //    $post->user_id=auth()->user()->id;
        //    $post->save();
        ////



        //forma numero 3 para almacenar un registro en la bd
        //al estilo de laravel
       // $request->user()->post()->create([
        //    'titulo'=>$request->titulo,
        //    'descripcion'=>$request->descripcion,
        //    'imagen'=>$request->imagen,
        //    'user_id'=>auth()->user()->id
        // ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }


    public function show(User $user, Post $post)
    {
        return view('posts.show',[
            'post'=>$post,
            'user'=>$user
        ]);
    }


    public function destroy(Post $post){
        $this ->authorize('delete', $post);
        $post->delete();

        //eliminar tambien la imagen
        $imagen_path=public_path('uploads/'.$post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
