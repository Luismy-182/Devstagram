<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image;



class ImagenController extends Controller
{
    //almacenamiento de imagenes

    public function store(Request $request)
    {
        
        $imagen=$request->file('file');

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
        $imagenPath = public_path('uploads'). '/'. $nombreImagen;

        //Una vez procesada la imagen entonces guardamos la imagen en la carpeta que creamos
        $imagenServidor->save($imagenPath);




        return response()->json(['imagen'=>$nombreImagen]);
    }
}
