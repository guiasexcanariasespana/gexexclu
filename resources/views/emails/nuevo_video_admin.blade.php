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
            <h1>Anuncio modificado en canariasexclusiva.com</h1>
            <p>Se agrego un video al anuncio {!!$anuncio_str!!}. Siga el siguiente enlace para Comprobar y Validar. Así  permitir la publicación del video :</p>
            <a href="{{route('admin.users.edit_anuncio', $anuncio)}}">Click aquí para verificar los cambios</a>
            
           
            <p> <br>Saludos</p>
        </div>
    </body>
</html>