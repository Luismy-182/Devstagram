<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];


    public function user(){

        //pertenece a....
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }


    public function likes(){
        return $this->hasMany(Like::class);
    }

    //se posiciona en la tabla likes y revisa con contains en la parte de user_id si existe un $user->id
    public function checklike(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
}
