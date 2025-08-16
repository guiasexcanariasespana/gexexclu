<!DOCTYPE html>
<html data-theme="night" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body>
        <img class="w-10 mx-auto  " style="width: 40%;" src="{{config('app.url')}}/img/logo.png" />
        <div class="font-sans  text-gray-900 antialiased">
           <h2>No hemos podido procesar tu pago en <a class="text-color-red" href="{{config('app.url')}}">  canariasexclusiva.com </a> </h2>
            Hola {{ $anuncio->user->name }}
           <p>{!!$mensaje!!}</p>
            <br>
                   
            <br>
            Puedes ver tu anuncio en  <a href="{{route('edit_anuncio', $anuncio)}}">Click aquí para ver el anuncio</a>
             <p>Puedes contactarte al 610829595 <br>Saludos</p>
        </div>
    </body>
</html>