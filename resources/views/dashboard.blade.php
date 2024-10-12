@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
           
@endsection


@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{
                 $user->imagen ? 
                 asset ('perfiles/').'/'.$user->imagen:
                 asset('img/usuario.svg') }}"
                alt="imagen-usuario"
                class="rounded-full"
                >
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 md:flex md:flex-col items-center md:justify-center py-10 md:py-10 md:items-start">
                
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">
                        {{$user->username}}
                    </p>

                    @auth
                        @if($user->id===auth()->user()->id)
                        <a href="{{route('perfil.index')}}" class="text-gray-500 hover:text-gray-600 cursor-pointer">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                              </svg>
                              
                        </a>
                        @endif
                    @endauth
                </div>
              

                <p class="text-gray-800 text-sm mb-3 font-bold mt-3">
                    {{$user->followers->count()}}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count())</span>
                </p>


                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->followings->count()}}
                    <span class="font-normal">Siguiendo</span>
                </p>


                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$numPosts}}
                    <span class="font-normal">Post</span>
                </p>

                @auth

                @if ($user->id !== auth()->user()->id) <!--mostrar a usuarios que no sea yo, para que me puedan seguir--> 

                    @if (!$user->siguiendo(auth()->user() ))
                        
                  
          
                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            <input type="submit" class="bg-blue-600 text-white  rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                            value="Seguir">
                        </form>
                    @else
                    <!--Dejar de seguir-->
                        <form action="{{ route('users.unfollow', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="bg-red-600 text-white  rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                            value="Dejar de seguir">
                        </form>


                    @endif    

                @endif
                @endauth

            </div>

        </div>
    </div>


    <section class="container mx-auto mt-10">
        <h2 class="text-center text-4xl font-black my-10">Publicaciones</h2>

        @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($posts as $post)
            <div>
                <a href="{{route('posts.show', ['user'=>$user, 'post'=>$post])}}">
                    <img src="{{asset('uploads'). '/' .$post->imagen}}" alt="imagen del post {{$post->titulo}}" class="w-full h-full
                     bg-center ">
                </a>
            </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links('pagination::tailwind')}}
        </div>
        @else 
            <p class="text-gray-600 text-center uppercase text-sm font-bold">No hay post aún</p>
        @endif



    </section>
@endsection


