<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>Devstagram| @yield('titulo')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        <!-- Styles -->
        @livewireStyles
        
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">

                <a class="text-3xl font-black" href="{{route('home')}}">Devstagram</a>

                @auth <!--Si esta logueado-->
                
                <nav class="flex gap-2 items-center">

                    <a href="{{route('posts.create')}}" class="flex items-center gap-3 bg-withe border p-2 text-gray-600 rounded text-sm  font-bold cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                            <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                          </svg>
                          + Crear                          
                    </a>



                    <a href="{{ route('posts.index', auth()->user()->username ) }}" class="font-bold text-gray-600 text-sm">Hola: <span class="font-normal">
                        {{auth()->user()->username }}</span></a>

                    <form action="{{route('logout')}}" method="POST"> 
                        @csrf
                            <button type="submit" href="{{route('logout')}}" class="font-bold uppercase text-gray-600 text-sm">Cerrar Sesión</button>  
                    </form>
                </nav>
                @endauth  <!--fin logueado-->

                @guest  <!--Si no esta logueado-->
                
                <nav class="flex gap-2 items-center">
                    <a href="{{route('login')}}" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                    <a href="{{route('register')}}" class="font-bold uppercase text-gray-600 text-sm">Crear Cuenta</a>  
                </nav>
                @endguest   <!-- fin Si no esta logueado-->
            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>


        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            <p>DevStagram - &copy;Todos los derechos reservados. Miguel Angel Suarez {{now()->year}}</p>

            
        </footer>

        @livewireScripts
    </body>
</html>
