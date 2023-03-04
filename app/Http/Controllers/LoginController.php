<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function index()
    {
      return view('auth.login');  
    }

    public function store(Request $request)
    {

        //dd($request->remember);
        $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required']);

        

        if(!auth()->attempt($request->only('email','password'),$request->remember)){

            /*En este if, verificamos si el usuario y contraseña ingresados son incorrectos
            de la variable request tomamos solo el email y contraseña para no comprometer más datos
            si los datos cumplen la condición, mandamos una alerta a la pantalla y redireccionamos a la
            pagina actual donde se envío el formularios, con el método back().
            el método with nos permite mandar crear mensajes en el controlador y consumirlos en las vistas */

            return back()->with('mensaje','Credenciales Incorrectas');
        }

        return redirect()->route('posts.index',auth()->user()->username);
    }
}
