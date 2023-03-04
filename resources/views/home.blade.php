@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    
<!-- Los componentes en laravel permiten reutilizar código
    Si el componente que estamos utilizando le ponemos la <nombreComponente/> indica que no puede recibir datos externos
    sin embargo, si la dejamos <nombreComponente> <nombreComponente /> permitirá recibir datos externos; a esto se le llama slots -->

   <x-listar-post :posts="$posts" />

@endsection