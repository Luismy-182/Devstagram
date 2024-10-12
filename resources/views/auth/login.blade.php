@extends('layouts.app')

@section('titulo')
    Inicia Sesión en Devstagram
@endsection


@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
        <img src="{{asset ('img/login.jpg') }}" alt="Imagen registro">
    </div>

    <div class="md:w-1/2 bg-white p-6 rounded-lg shadow-xl">
        <form action="{{route('login')}}" method="POST" novalidate>

            @csrf
            
            @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>
            @endif

            <div class="mb-5">
                <lavel for="email" class="mb-2 block uppercarse text-gray-500 font-bold">Email</lavel>
                <input type="email" id="email" name="email" class="border p-3 w-full rounded-lg  @error('name') border-red-500 @enderror" placeholder="Tu email de registro">
                
                @error ('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <lavel for="password" class="mb-2 block uppercarse text-gray-500 font-bold">Password</lavel>
                <input type="password" id="password" name="password" class="border p-3 w-full rounded-lg  @error('name') border-red-500 @enderror" placeholder="Tu password">

                @error ('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>

          
            <div class="mb-5">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" class="text-gray-500 text-sm">Mantener mi session abierta</label>
            </div>

            <input type="submit" value="Iniciar Sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>

    </div>


    @endsection