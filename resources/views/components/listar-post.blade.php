<div>

@if($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($posts as $post)
        <div>
            <a href="{{route('posts.show', ['user'=>$post->user, 'post'=>$post])}}">
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
        <p class="text-gray-600 text-center uppercase text-sm font-bold">No hay post aún, sigue a alguien para poder ver sus post</p>
@endif
        

</div>