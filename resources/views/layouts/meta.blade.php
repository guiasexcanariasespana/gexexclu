{{-- resources/views/layouts/meta.blade.php --}}

@php
    $routeName = Route::currentRouteName();
@endphp

<title>
    @if($routeName === 'login')
        Iniciar sesión - {{ config('app.name') }}
    @elseif($routeName === 'register')
        Registrarse - {{ config('app.name') }}
    @elseif($routeName === 'password.request')
        Recuperar contraseña - {{ config('app.name') }}
    @elseif($routeName === 'terms.show')
        Términos de Servicio - {{ config('app.name') }}
    @elseif($routeName === 'policy.show')
        Política de Privacidad - {{ config('app.name') }}
    @else
        {{ config('app.name') }}
    @endif
</title>

<meta name="title" content="
    @if($routeName === 'login')
        Iniciar sesión en {{ config('app.name') }}
    @elseif($routeName === 'register')
        Crea tu cuenta en {{ config('app.name') }}
    @elseif($routeName === 'password.request')
        Recupera tu contraseña - {{ config('app.name') }}
    @elseif($routeName === 'terms.show')
        Lee nuestros Términos de Servicio en {{ config('app.name') }}
    @elseif($routeName === 'policy.show')
        Conoce nuestra Política de Privacidad en {{ config('app.name') }}
    @else
        {{ config('app.name') }}
    @endif
">

<meta name="description" content="
    @if($routeName === 'login')
        Accede a tu cuenta y gestionalo fácilmente.
    @elseif($routeName === 'register')
        Únete a nosotros y disfruta de todos nuestros servicios.
    @elseif($routeName === 'password.request')
        Restablece tu contraseña de manera fácil y rápida.
    @elseif($routeName === 'terms.show')
        Consulta nuestros términos y condiciones de uso para conocer las reglas de nuestro servicio.
    @elseif($routeName === 'policy.show')
        Descubre cómo protegemos tu información en nuestra Política de Privacidad.
    @else
        Bienvenido a {{ config('app.name') }}. Encuentra lo mejor, todo en un solo lugar.
    @endif
">
