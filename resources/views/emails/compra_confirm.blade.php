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
           <h2>Aviso de pago recibido en <a class="text-color-red" href="{{config('app.url')}}"> canariasexclusiva.com </a> </h2>
            Hola {{ $user->name }}
           <p>{!!$mensaje!!}</p>
            <br>
            <h2>Datos:</h2>
            Plan: {{ $plan->nombre}}<br>
            Días: {{ $plan->dias}}<br>
            Precio: {{ $plan->precio}}<br>
            
            Motivo: {{ $motivo}}<br>
            Monto Pago:  {{ $monto}}<br>
        
            <br>
            Puedes ver tu anuncio en  <a href="{{route('edit_anuncio', $anuncio)}}">Click aquí para ver el anuncio</a>
           
             <p>Ante cualquier inconveniente o duda contacte al 610829595 <br>Saludos</p>
        </div>
    </body>
</html>