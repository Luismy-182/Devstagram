@extends('layouts.app')

@section('titulo')
    Regístrate en Devstagram
@endsection


@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
        <img src="{{asset ('img/registrar.jpg') }}" alt="Imagen registro">
    </div>

    <div class="md:w-1/2 bg-white p-6 rounded-lg shadow-xl">
        <form action="crear-cuenta" method="POST">

            @csrf
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercarse text-gray-500 font-bold">Nombre</label>
                <input type="text" id="name" name="name" class="border p-3 w-full rounded-lg
                @error('name') border-red-500 @enderror" placeholder="Tu nombre" value="{{old('name')}}">

                @error ('name')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="username" class="mb-2 block uppercarse text-gray-500 font-bold">Username</label>
                <input type="text" id="username" name="username" class="border p-3 w-full rounded-lg  @error('username') border-red-500 @enderror" placeholder="Tu nombre de usuario"
                value="{{old('username')}}">

                @error ('username')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>


            <div class="mb-5">
                <label for="email" class="mb-2 block uppercarse text-gray-500 font-bold">Email</label>
                <input type="email" id="email" name="email" class="border p-3 w-full rounded-lg  @error('name') border-red-500 @enderror" placeholder="Tu email de registro"
                value="{{old('email')}}">
                
                @error ('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="mb-2 block uppercarse text-gray-500 font-bold">Password</label>
                <input type="password" id="password" name="password" class="border p-3 w-full rounded-lg  @error('name') border-red-500 @enderror" placeholder="Tu password">

                @error ('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercarse text-gray-500 font-bold">Confirma tu Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="border p-3 w-full rounded-lg" placeholder="Confirma tu password">
            </div>


            <input type="submit" value="Crear cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>

    </div>


    @endsection