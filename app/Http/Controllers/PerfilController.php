<?php

namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
 
class PerfilController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        return view('perfil.index');
    }
 
    public function store(Request $request)
    {
        // modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);
 
        $this->validate($request, [
            // laravel recomienda cuando son mas de 3 condiciones usar un arreglo
            'username' => ['required','unique:users,username,'. auth()->user()->id,'min:3','max:20', 'not_in:twitter,editar-perfil,perfil,login,logout,juanbarraza'],
             
            
        ]);

        if($request->password === null){

        }else if (Hash::check($request->password, auth()->user()->password)) {
 
            $this->validate($request,['newPassword'=>'required|min:6']);
            $request->user()->fill([
                'password' => Hash::make($request->newPassword)
            ])->save();

            
        }else{
            return back()->with('mensaje','Contraseñas incorrectas');
        }

        if($request->imagen) {
            $imagen = $request->file('imagen');
 
            // generamos un id unico para cada img
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            // mantiene la imagen en memoria
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // altera los px 1000x1000
            // ruta + nombre
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            // guarda en el servidor
            $imagenServidor->save($imagenPath);
        } 
       
             // Guardar imagen
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        // revisa si hay una imagen
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();
 
        return redirect()->route('posts.index', $usuario->username);
        
       
    }
}