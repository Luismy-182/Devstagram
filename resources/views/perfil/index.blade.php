@extends('layouts.app')

@section('titulo')
    Editar perfil: {{auth()->user()->username}}
@endsection


@section('contenido')

    <div class="md:flex md:justify-center">
        <div class="md:1/2 bg-white shadow p-6">
            <form action="{{route('perfil.store')}}" class="mt-10 md:mt-0" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercarse text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" class="border p-3 w-full rounded-lg
                    @error('username') border-red-500 @enderror" placeholder="Tu nombre de usuario">
    
                    @error ('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>


                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercarse text-gray-500 font-bold">Imagen de perfil</label>
                    <input type="file" id="imagen" name="imagen" class="border p-3 w-full rounded-lg" accept=".jpeg, .jpg, .png"
                    >
                </div>
                <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection