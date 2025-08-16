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
    <img class="w-10 mx-auto  " style="width: 40%;" src="{{ config('app.url') }}/img/logo.png" />
    <div class="font-sans  text-gray-900 antialiased">
        <h1>Anuncio modificado en canariasexclusiva.com</h1>
        <p>Se han cambiado las fotos o el orden o la portada del anuncio {!! $anuncio_str !!} . Siga el siguiente
            enlace para Comprobar y Validar. Así permitir la publicación de dichas fotos :</p>
        <a href="{{ route('admin.users.edit_anuncio', $anuncio) }}">Click aquí para verificar los cambios</a>
        <p>
            Las imagenes son las siguientes:</p>

        @foreach ($anuncio->imagenes_no_verificadas() as $foto)
            <img class="w-10 mx-auto  " style="width: 40%;"
                src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $foto->nombre }}" />
        @endforeach
        <br>
        @php
            $cambia_portada = false;
            $portada_solicitada = $anuncio
                ->imagens()
                ->where('portada', 'Si')
                ->first();
            if ($anuncio->portada_id != $portada_solicitada->id) {
                $portada_actual = $anuncio->portada;
                $cambia_portada = true;
            }
        @endphp
        @if ($cambia_portada)
            <h3>Foto de Portada:</h3> <br>
            portada actual <br>
            @if (!is_null($anuncio->portada_id))
                <img class="w-10 mx-auto  " style="width: 40%;" src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $portada_actual->nombre }}" />
            @endif<br>  
            Portada Solicitada <br>
            @if (!is_null($portada_solicitada))
                <img class="w-10 mx-auto  " style="width: 40%;" src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $portada_solicitada->nombre }}" />
            @endif


        @endif

        <p> <br>Saludos</p>
    </div>
</body>

</html>
