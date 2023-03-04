<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    //Cuando tenemos un solo método en el controlador, es recomendable mandar llamar el __invoke

    public function __invoke()

    //Obtener a quienes seguimos

    {
        //pluck nos trae ciertos campos, en este caso solo queremos traer el id de los usuarios
        $ids = auth()->user()->followings->pluck('id')->toArray();

        //Post::where solo trae un dato de la BD y Post::whereIn nos trae un arreglo con los valores deseados
        //en este caso, de la tabla post, traerá los user_id que encuentre

        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home',[
            'posts' => $posts
        ]);
    }

}
