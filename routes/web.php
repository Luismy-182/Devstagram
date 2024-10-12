<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

//ruta princial, nuestro home de publicaciones
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/crear-cuenta', [RegisterController::class,'index'])->name('register');
Route::post('/crear-cuenta', [RegisterController::class,'store']);
//login
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store']);
//logout
Route::post('/logout', [LogoutController::class,'store'])->name('logout');
//url de usuario
//edicion de perfil

Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

//muro
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index')->middleware('auth'); //middlegare, redirecciona a login
//con lo anterior metes tu username en la url



//posts

Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');
Route::post('/posts',[PostController::class, 'store'])->name('posts.store');

//mirar el post
Route::get('/{user:username}/post/{post}',[PostController::class, 'show'])->name('posts.show');


//almacenar comentarios de la pipol
Route::post('/{user:username}/post/{post}',[ComentarioController::class, 'store'])->name('comentarios.store');


//eliminar una publicacion
Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');

//ruta para almacenar las imagenes

Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');


//like a las fotos
//es muy importante como le pasas las variables {} Route::post('/posts/{post}/likes'
//si escribes algo mal puede dar NUll en el contenido de las variables y eso no queremos
//en este caso no teniamos bien escrita la palabra post, estaba /{posts} y es {/post}
Route::post('/posts/{post}/likes',[LikeController::class, 'store'])->name('posts.likes.store');


//elimina Likes
Route::delete('/posts/{post}/likes',[LikeController::class, 'destroy'])->name('posts.likes.destroy');


//seguir usuarios

Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('users.follow') ;
Route::delete('/{user:username}/unfollow',[FollowerController::class, 'destroy'])->name('users.unfollow');



