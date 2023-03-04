<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    //Los métodos de los controladores regresarán las vistas
    public function index () 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('name')); //Así se obtiene el valor de un campo

        //Modificar el request
        $request->request->add(['username'=>Str::slug( $request->username)]);

        // low Convierte el texto en minusculas para visualizarlo en la url
        //slug, convierte el texto ingresado en uno legible para ser una URL, eliminado espacios y convirtiendo a minusculas
        //Validación 


        $this->validate($request,[
            'name'=>'required|max:30',
            'username'=>'required|unique:users|min:3|max:30',
            'email'=>'required|unique:users|email|max:30',
            'password'=>'required|confirmed|min:6'
        ]);

        User::create([
            'name'=>$request->name,
            'username'=>$request->username, 
            'email'=>$request->email,
            'password'=>hash::make($request->password), //utilizamos hash para bridar cifrado a las contraseñas en la BD


        ]);

        //Autenticar al usuario
        /*
        auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]);*/

        //otra forma de autenticar
        auth()->attempt($request->only('email','password'));
        
        
        //redireccionar

        return redirect()->route('posts.index',auth()->user()->username);
    }
}
