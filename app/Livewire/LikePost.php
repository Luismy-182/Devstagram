<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLiked;
    public $likes;

    public function mount($post){
        $this->isLiked=$post->checkLike(auth()->user() );
        $this->likes=$post->likes->count();
    }

    public function like (){
        

        if($this->post->checkLike(auth()->user() )){

            
            // auth()->user()->likes()->where('post_id', $this->post->id)->delete(); primera solucion
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isLiked=false;
            $this->likes--;
           //$this->post->likes()->where('post_id', $this->post->id)->delete(); //ojo, eliminara todos los like de la publicacion

        }else{
            $this->post->likes()->create([
                'user_id'=>auth()->user()->id
             ]);

            $this->isLiked=true;
            $this->likes++;
        }

    }
    public function render()
    {

        
        return view('livewire.like-post');
    }
}