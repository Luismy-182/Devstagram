@extends('layouts.app')


@section('titulo')
    {{$post->titulo}}
@endsection


@section('contenido')
    <div class="container mx-auto md:flex gap-5">
        <div class="md:1/2">
            <!--FLEX IZQUIERDO, IMAGEN-->
            <img src="{{asset('uploads').'/'.$post->imagen }}" alt="Imagen del post {{$post->titulo}}">
            <div class="p-3 flex items-center gap-2">

                <!--LIKES-->
            @auth
                    <livewire:like-post :post="$post"/>
                
                
                {{--
                    @if ($post->checkLike(auth()->user() ))
                

                <form method="POST" action="{{route('posts.likes.destroy', $post) }}">
                    @method('DELETE')
                    @csrf
                    <div class="my-4">
                        
                        



                    </div>
                </form>
                @else
                <!--SI YA DIO LIKE EL USUARIO QUE APARECE EN LA BD EN SU CAMPO USER_ID DE TABLA M-A-M LIKE ENTONCES MARCAMOS EL CORAZON CON ROJITO-->
                
                    <form method="POST" action="{{route('posts.likes.store', $post) }}">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>                          
                            </div>
                    </form>
                @endif

                --}}
            @endauth

{{-- se uso en livewire <p class="font-bold">{{$post->likes->count() }} <span class="font-normal">Me gusta</span></p> --}}

               <!--FIN LIKES-->
            </div>
        </div>
        <!--FIN FLEX IZQUIERDO-->

        <!--CONTENEDOR DERECHO-->
        <div class="md:w-1/2">

          
                <!--NOMBRE DE USUARIO-->
            <h2 class="font-bold">{{$post->user->username, $post->titulo}}</h2>

            <!--DESCRIPCION DEL POST-->
            <p class="mt-1">{{$post->descripcion}}</p>

            <!--TIEMPO DE LA PUBLICACION-->
            <p class="text-gray-600">{{$post->created_at->diffForHumans()}}</p>

           
           <!--ELIMINAR UN POST CON METODO SPOOFING-->
            @auth
                @if ($post->user_id==auth()->user()->id)
            <form action="{{route('posts.destroy', $post)}}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="bg-gray-500 hover:bg-gray-600 rounded p-2 font-bold cursor-pointer text-white mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                </button>

            </form>
                @endif
            @endauth
            <!-- FIN ELIMINAR UN POST CON METODO SPOOFING-->






            @auth  
            
            <!--EXITO AL AGREGAR UN COMENTARIO-->
            <div class="shadow bg-white p-5 mt-8 ">
                @if (session('mensaje'))
                <div class="bg-green-500 p-2 rounded-lg mg-6 text-withe text-center uppercase font-bold">
                    {{session('mensaje')}}

                </div>

            <!--FIN EXITO AL AGREGAR UN COMENTARIO-->

                    
                @endif
            
            
            
            <!--AGREGANDO UN COMENTARIO-->
                <form action="{{route('comentarios.store', ['post'=>$post, 'user'=>$user])}}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Agrega un comentario</label>

                        <textarea name="comentario" id="comentario" placeholder="Agrega un comentario" 
                        class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
                        ></textarea>

                        @error('comentario')
                        <p class="bg-red-500 text-withe my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                            
                        @enderror


                    </div>

                    <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>

                <!--AGREGANDO UN COMENTARIO-->

            </div> <!--FIN CAJA BLANCA DE COMENTARIOS-->




            <!--MUESTRA SI HAY O NO COMENTARIOS-->
            <div class="bg-withe shadow mb-5 max-h-96 overflow-y-scroll">
                @if ($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario )
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('posts.index', $comentario->user)}}" class="font-bold">{{$comentario->user->username}}</a>
                            <p>{{$comentario ->comentario}}</p>

                            <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                        </div>
                    @endforeach
            </div>
                @else
                    <p class="p-10 text-center">No Hay Comentarios Aún</p>
                @endif

            <!--FIN AGREGANDO UN COMENTARIO-->    

            @endauth
            


            <!--RESTRINGIENDO LOS COMENTARIOS A GENTE QUE NO TIENE CUENTA-->
            @guest
                <h2 class="mt-5 font-bold uppercase text-center font-size-10">Esta cuenta es privada</h2>
                <p class="mt-5 text-gray-500 text-center">Ya sigues a <span class="font-bold">{{$post->user->username}}</span>?  <a href="{{route('login')}}" class="text-blue-500"> Inicia Sesión </a> para ver sus fotos y vídeos</p>
            @endguest
            <!--FIN RESTRINGIENDO LOS COMENTARIOS A GENTE QUE NO TIENE CUENTA-->

        </div>
        <!--FIN CONTENEDOR SECUNDARIO CON 1/2-->

    </div>

    <!--FIN CONTENEDOR PRINCIPAL-->
@endsection