<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

//para poder usar el ->validate()
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
}


class PerfilController extends Controller implements HasMiddleware
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

    public function index(){
        
        return view('perfil.index');
    }


    public function store(Request $request){

        //modifica el request para que mas adelante en el campo username duplicado no te salte un mensaje feo de error de laravel
        //en su lugar que salga un aposible correccion automatica del request en username, agregando guiones
        
        $request->request->add(['username'=>Str::slug($request->username)]);
        $this->validate($request,[
            'username'=>['required','unique:users,username,'.auth()->user()->id, 'min:3','max:20',
            'not_in:twitter,editar-perfil'],
        ]);



        if($request->imagen){
            $imagen=$request->file('imagen');
            //creamos el objeto manajer e instanciamos clase de ImageManager
            $manager = new ImageManager(new Driver());
            //nombre de la imagen con un metodo que le da un nombre unico
            $nombreImagen=Str::uuid(). ".". $imagen->extension();
            //$imagenServidor=Image::make($imagen); no jala en laravel 11
            //leemos la imagen con la funcion read
            $imagenServidor = $manager->read($imagen);
            //aplicamos las medidas a rescalar la imagen para que todas esten en armonia
            $imagenServidor->scale(1000, 1000);
            //agregamos la imagen a la  carpeta en public donde se guardaran las imagenes
            $imagenPath = public_path('perfiles'). '/'. $nombreImagen;
            //Una vez procesada la imagen entonces guardamos la imagen en la carpeta que creamos
            $imagenServidor->save($imagenPath);

        }

        //guardar cambios
        $usuario=User::find(auth()->user()->id);
        $usuario->username=$request->username;
        $usuario->imagen=$nombreImagen ?? auth()->user()->imagen?? null;//si no carga una imagen toma la que ya esta en el campo imagen del usuario, si no hay nada usa un null
        $usuario->save();


        //redireccionar
        
        return redirect()->route('posts.index', $usuario->username);
    }
}
