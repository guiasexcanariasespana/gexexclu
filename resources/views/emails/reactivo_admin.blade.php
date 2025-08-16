<!DOCTYPE html>
<html data-theme="night" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'canariasexclusivas') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
    <img class="w-10 mx-auto  " style="width: 40%;" src="{{ config('app.url') }}/img/logo.png" />
    <div class="font-sans  text-gray-900 antialiased">
        <h1>Anuncio reactivado en canariasexclusiva.com</h1>
        <p>El anuncio {{ $anuncio->slug}} con plan {{$anuncio->plane->nombre}} por {{$anuncio->plane->dias}} día/s en la categoría {{$anuncio->categoria->nombre}} se reactivo el {{$anuncio->fecha_de_publicacion}}  Aún le restan {{$anuncio->dias}}  día/s.</p>        
        <p>Está publicado en la localidad {{$anuncio->localidad}} provincia {{$anuncio->provincia->nombre}}</p>
        <p>El mismo se pausó el {{$fecha_pausa}}</p>        
        <a href="{{ route('admin.users.edit_anuncio', $anuncio) }}">Para ver el anuncio haga click</a>
        <p>
            
        <p> <br>Saludos</p>
    </div>
</body>

</html>