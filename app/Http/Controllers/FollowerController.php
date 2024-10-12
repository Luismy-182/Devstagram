<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //para crear relacion de seguidor

    public function store(User $user){
        
        //lee la persona a la que estas visitando, le va a agregar que esta perosna le esta siguiendo (y va a ser la perosna que esta autentificada)
        $user->followers()->attach(auth()->user()->id);
        return back();
    }


    public function destroy(User $user){
        
        //lee la persona a la que estas visitando, le va a agregar que esta perosna le esta siguiendo (y va a ser la perosna que esta autentificada)
        $user->followers()->detach(auth()->user()->id);
        return back();
    }


    
}
