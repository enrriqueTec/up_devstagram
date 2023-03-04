<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>DevStagram - @yield('titulo')</title>
        
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        @livewireStyles <!-- Agregando los estilos de livewire-->
    </head>
    <body class="bg-gray-100">
    
      <header class="p-5 border-b bg-white shadow">
        
        <div class="container mx-auto flex justify-between items-center">
        <a class="text-3xl font-black" href="{{route('home')}}"> DevStagram</a>

        <!-- Comprobar si el usuario está autenticado con el Auth.
        -Si está autenticado, mostramos el nombre del usuario
        -Se crea el hipervinculo para terminar la sesión
        -Se elimina el navbar con registrarse y crear cuenta, se cambia por el nombre del usuario y cerrar sesión
        -->
          @auth
          <nav class="flex gap-2 items-center">

            <a href="{{route('posts.create')}}"
            class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
            
            Crear</a>
            
            <a class="font-bold  text-gray-600 text-sm pl-5" href="{{route('posts.index',auth()->user()->username)}}">
              Hola: <span class="font-normal">{{auth()->user()->username}}</span>
            </a>
             
            <form action="{{route('logout')}}" method="POST">
              @csrf
            <button type="submit" class="font-bold uppercase text-gray-600 text-sm pl-5" href="{{route('logout')}}">Cerrar sesión</button>
            </form>

        </nav>

       
          @endauth
        <!-- Si el usuario no está autenticado, mostramos el navbar de registrarse y crear cuenta
              - Todo esto con las directivas de laravel 
        -->
          @guest
          <nav class="flex gap-2 items-center">
            <a class="font-bold uppercase text-gray-600 text-sm pl-5" href="{{route('login')}}">Login</a>
            <a class="font-bold uppercase text-gray-600 text-sm pl-5" href="{{route('register')}}">Crear cuenta</a>
        </nav>
          @endguest
         
        </div>

      </header>
      <main class="container mx-auto mt-10">

        <h2 class="font-black text-center text-3xl mb-10">

          @yield('titulo')
        </h2>
        @yield('contenido')

        
        
        @guest
          <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
          DevStagram - Todos los derechos reservados {{now()->year}} 
        </footer>
        @endguest
        
      </main>

      @livewireScripts  <!-- Agregando los scripts de livewire-->
    </body>

</html>