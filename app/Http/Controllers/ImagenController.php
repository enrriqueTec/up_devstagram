<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //

    public function store(Request $request)
    {
        //obtenemos la imagen que estamos cargando y mandamos los datos a traves de un json para leerlos en la vista
        //$input = $request->all();

        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension(); //Se le asigna un ID unico a las imágenes
         
       $imagenServidor = Image::make($imagen);

       $imagenServidor->fit(1000, 1000);//escalamos la img a 1000 x 1000 px

       $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
