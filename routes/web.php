<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Aquí cambia un poco la nomenclatura debido a que el controlador solo tiene un método que es el invoke
Route::get('/', HomeController::class)->name('home');

//rutas para el perfil
Route::get('/editar-perfil',[PerfilController::class,'index'])->name('perfil.index');
Route::post('/editar-perfil',[PerfilController::class,'store'])->name('perfil.store');

/*En esta parte importamos el controlador, definimos que es una clase y le pasamos el método*/
//le asignamos un nombre a la ruta y laravel sabrá a que vista llamar
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

Route::post('/logout',[logoutController::class,'store'])->name('logout');

//Para crear una ruta en variable, se agrega {{}}
/*Esto lo vamos a utilizar para mandar el nombre del usuario a la URL
y como en el proyecto ya tenemos un modelo llamado user, es por eso que se
puede utilizar*/

//siguiendo usuarios

Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name('users.unfollow');

Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');


Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');//ruta para crear un post
Route::post('/posts',[PostController::class,'store'])->name('posts.store');//ruta para almacenar posts
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');//ruta para mostrar detalles de los posts publicados
Route::delete('posts/{post}',[PostController::class,'destroy'])->name('post.destroy');

Route::post('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');//ruta para almacenar los comentarios publicados



Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//like a las fotos
Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('posts.like.store');

//dislike a las fotos
Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('posts.like.destroy');


