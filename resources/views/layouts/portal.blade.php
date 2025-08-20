<!DOCTYPE html>

<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    @include('google_analytics')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @hasSection('denunciaTitle')
        <title>@yield('denunciaTitle')</title>
    @else
    @endif
    @hasSection('denunciaDescription')
        <meta name="description" content="@yield('denunciaDescription')"> 
    @endif

     {!! SEO::generate() !!}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    

    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.31.0/dist/full.css" rel="stylesheet" type="text/css" />
    <!--Replace with your tailwind.css once created-->

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Styles -->
    <link href="{{config('app.url')}}/css/gdpr-cookie.css" rel="stylesheet">
    <!--   <script type="text/javascript" language="Javascript">
        document.oncontextmenu = function() {
            return false
        }
    </script> -->
        @livewireStyles

    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        body {
            font-family: 'Nunito', sans-serif;
        }
        </style>
</head>

<body class="antialiased">
    
    {{-- <div class="navbar bg-base-200 sticky top-0 z-50 shadow-sm">
        <div class="flex-1">
            <div class="lg:w-1/4 md:w-1/2 w-48">  <a href="{{ url('/') }}"><img src="{{config('app.url')}}/img/slogan.png" /></div></a>
        </div>
        <div class="flex-none">
            @if (Route::has('login'))
                <ul class="menu menu-horizontal px-1">
                    @auth
                        <li> <a href="{{ route('profile.show') }}" class="text-sm text-gray-700 " > Perfil </a></li>

                        <li> <a href="{{ url('/dashboard') }}"
                            class="text-sm text-gray-700 ">Panel</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="h-full" x-data>
                                            @csrf
                                            <button type="submit" class="text-sm text-gray-700 "> {{ __('Salir') }}
                                        </button>

                                </form>
                            </li>
                    @else
                    <li> <a href="{{ route('login') }}"
                        class="text-sm text-gray-700 ">Ingresar</a>
                      </li>
                     @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}"
                            class="text-sm text-gray-700 ">Registrate</a>
                    </li>
                     @endif
            @endauth
                </ul>
            @endif
        </div>
      </div> --}}
        <nav class=" sticky top-0 z-50 px-4 py-4 flex justify-between items-center bg-white">
            <a href="{{ url('/') }}">
                <img src="{{config('app.url')}}/img/slogan.png" class="w-1/2"/>
            </a>
            <div class="lg:hidden">
                <button class="navbar-burger flex items-center text-red-700 p-3">
                    <svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Mobile menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </button>
            </div>
            <ul class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
                <li><a class="text-md text-gray-700 hover:text-red-700" href="{{ route('index_general') }}">Chicas de Compañía en Canarias</a></li>
                <li class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
                <li class="group relative ">
                    {{-- <a href="#" class="cursor-pointer" onclick="toggleDropdown(event)">Las Palmas</a>
                    <ul class="dropdown-menu absolute left-0 mt-1 hidden ">
                        <li class="bg-gray-400 p-4 m-2 rounded"><a class="text-sm text-gray-700 hover:text-red-700" href="https://canariasexclusiva.com/escort/las-palmas">Chicas de compañía en Las Palmas</a></li>
                        <li class="bg-gray-400 p-4 m-2 rounded"><a class="text-sm text-gray-700 hover:text-red-700" href="https://canariasexclusiva.com/escort/las-palmas/todos/masajes">Masajes Eróticos en Las Palmas</a></li>
                    </ul> --}}

                    <a href="#" class="cursor-pointer hover:px-2 hover:py-1 w-64" >Las Palmas</a>
                    <div class="dropdown-menu absolute left-0 mt-1 hidden group-hover:block grid grid-cols-1 gap-4 p-4 bg-gray-200 rounded w-64">
                        @php
                        $prov_laspalmas=\App\Models\Provincia::buscar_nombre('Las Palmas');
                        $prov_tenerife=\App\Models\Provincia::buscar_nombre('Tenerife');
                        $cat_chicas=\App\Models\Categoria::buscar_nombre('Chicas');
                        $cat_masajes=\App\Models\Categoria::buscar_nombre('Masajes');
                        $cat_trav=\App\Models\Categoria::buscar_nombre('Trans & Travestis');
                        @endphp
                        @if ($cat_chicas)
                        @if ($cat_chicas->cantidad_anuncios_provincia($prov_laspalmas?->id) > 0)
                        <a class="text-sm text-gray-700 hover:text-red-700 " href="{{ route('index_categoria_provincia', [$prov_laspalmas, $cat_chicas]) }}">Chicas de compañía en Las Palmas</a>
                        @endif
                        @endif
                        @if ($cat_masajes)
                        @if ($cat_masajes->cantidad_anuncios_provincia($prov_laspalmas?->id) > 0)
                        <a class="text-sm text-gray-700 hover:text-red-700 " href="{{ route('index_categoria_provincia', [$prov_laspalmas, $cat_masajes]) }}">Masajes Eróticos en Las Palmas</a>
                        @endif
                        @endif
                        @if ($cat_trav)
                        @if ($cat_trav->cantidad_anuncios_provincia($prov_laspalmas?->id) > 0)
                        <a class="text-sm text-gray-700 hover:text-red-700 " href="{{ route('index_categoria_provincia', [$prov_laspalmas, $cat_trav]) }}">Transexsuales en Las Palmas</a>
                        @endif
                        @endif
                    </div>
                </li>
                <li class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
                <li class="group relative">
                    {{-- <a href="#" class="cursor-pointer" onclick="toggleDropdown(event)">Tenerife</a>
                    <ul class="dropdown-menu absolute left-0 mt-1 hidden">
                        <li class="bg-gray-400 p-4 m-2 rounded"><a class="text-sm text-gray-700 hover:text-red-700" href="https://canariasexclusiva.com/escort/sc-tenerife">Chicas de compañía en Tenerife</a></li>
                    </ul> --}}

                        <a href="#" class="cursor-pointer hover:py-1 w-64" >Tenerife</a>
                        <div class="dropdown-menu absolute left-0 mt-1 hidden  group-hover:block grid grid-cols-1 gap-4 p-4 bg-gray-200 rounded w-64">
                            @if ($cat_chicas)
                            @if ($cat_chicas->cantidad_anuncios_provincia($prov_tenerife?->id) > 0)
                            <a class="text-sm text-gray-700 hover:text-red-700" href="{{ route('index_categoria_provincia', [$prov_tenerife, $cat_chicas]) }}">Chicas de compañía en Tenerife</a>
                            @endif
                            @endif
                            @if ($cat_masajes)
                            @if ($cat_masajes->cantidad_anuncios_provincia($prov_tenerife?->id) > 0)
                            <a class="text-sm text-gray-700 hover:text-red-700 " href="{{ route('index_categoria_provincia', [$prov_tenerife, $cat_masajes]) }}">Masajes Eróticos en Tenerife</a>
                            @endif
                            @endif
                            @if ($cat_trav)
                            @if ($cat_trav->cantidad_anuncios_provincia($prov_tenerife?->id) > 0)
                            <a class="text-sm text-gray-700 hover:text-red-700 " href="{{ route('index_categoria_provincia', [$prov_tenerife, $cat_trav]) }}">Transexsuales en Tenerife</a>
                            @endif
                            @endif
                        </div>

                </li>
            </ul>
            {{-- @if (Route::has('login'))
            @auth

            <a class="hidden lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold  rounded-xl transition duration-200" href="{{ route('profile.show') }}" >Perfil</a>
            <a class="hidden lg:inline-block py-2 px-6 bg-red-500 hover:bg-red-600 text-sm text-white font-bold rounded-xl transition duration-200" href="{{ url('/dashboard') }}">Panel</a>
            <form method="POST" action="{{ route('logout') }}" class="h-full hidden lg:inline-block" x-data>
                @csrf
                <button type="submit" class="hidden lg:inline-block py-2 px-6 bg-gray-500 hover:bg-gray-600 text-sm text-white font-bold rounded-xl transition duration-200">{{ __('Salir') }}</button>
            </form>

            @else
            <a class="hidden lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold  rounded-xl transition duration-200" href="{{ route('login') }}" >Ingresar</a>
                @if (Route::has('register'))
                <a class="hidden lg:inline-block py-2 px-6 bg-red-500 hover:bg-red-600 text-sm text-white font-bold rounded-xl transition duration-200" href="{{ route('register') }}">Registrarme</a>
                @endif
            @endauth
            @endif --}}
        </nav>
        <div class="navbar-menu relative z-50 hidden">
            <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
            <nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
                <div class="flex items-center mb-8">

                        <a href="{{ url('/') }}">
                            <img src="{{config('app.url')}}/img/slogan.png" class="w-72 text-left"/>
                        </a>

                    <button class="navbar-close ml-6">
                        <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <ul>
                        <li class="mb-4">
                            <a class="block p-4 font-bold hover:bg-red-50 text-gray-700 hover:text-red-700 rounded" href="{{ route('index_general') }}">Chicas de Compañía en Canarias</a>
                        </li>

                        <li class="group relative mb-4">
                            <a href="#" class="font-bold">Las Palmas</a>
                            <ul >
                                @if($cat_chicas)
                                @if ($cat_chicas->cantidad_anuncios_provincia($prov_laspalmas?->id) > 0)
                                <li><a class="block p-4 text-sm font-semibold hover:bg-red-50 text-gray-700 hover:text-red-700 rounded" href="{{ route('index_categoria_provincia', [$prov_laspalmas, $cat_chicas]) }}">Chicas de compañía en Las Palmas</a></li>
                                @endif
                                @endif
                                @if($cat_masajes)
                                @if ($cat_masajes->cantidad_anuncios_provincia($prov_laspalmas?->id) > 0)
                                <li><a class="block p-4 text-sm font-semibold hover:bg-red-50 text-gray-700 hover:text-red-700 rounded" href="{{ route('index_categoria_provincia', [$prov_laspalmas, $cat_masajes]) }}">Masajes Eróticos en Las Palmas</a></li>
                                @endif
                                @endif
                                @if($cat_trav)
                                @if ($cat_trav->cantidad_anuncios_provincia($prov_laspalmas?->id) > 0)
                                <li><a class="block p-4 text-sm font-semibold hover:bg-red-50 text-gray-700 hover:text-red-700 rounded"  href="{{ route('index_categoria_provincia', [$prov_laspalmas, $cat_trav]) }}">Transexsuales en Las Palmas</a></li>
                                @endif
                                @endif
                            </ul>
                        </li>
                        <li class="group relative mb-4">
                            <a href="#" class="font-bold">Tenerife</a>
                            <ul>
                                @if($cat_chicas)
                                @if ($cat_chicas->cantidad_anuncios_provincia($prov_tenerife?->id) > 0)
                                <li><a class="block p-4 text-sm font-semibold hover:bg-red-50 text-gray-700 hover:text-red-700 rounded" href="{{ route('index_categoria_provincia', [$prov_tenerife, $cat_chicas]) }}">Chicas de compañía en Tenerife</a></li>
                                @endif
                                 @endif
                                @if($cat_masajes)
                                @if ($cat_masajes->cantidad_anuncios_provincia($prov_tenerife?->id) > 0)
                                <li><a class="block p-4 text-sm font-semibold hover:bg-red-50 text-gray-700 hover:text-red-700 rounded" href="{{ route('index_categoria_provincia', [$prov_tenerife, $cat_masajes]) }}">Masajes Eróticos en Tenerife</a></li>
                                @endif
                                 @endif
                                @if($cat_trav)
                                @if ($cat_trav->cantidad_anuncios_provincia($prov_tenerife?->id) > 0)
                                <li><a class="block p-4 text-sm font-semibold hover:bg-red-50 text-gray-700 hover:text-red-700 rounded" href="{{ route('index_categoria_provincia', [$prov_tenerife, $cat_trav]) }}">Transexsuales en Tenerife</a></li>
                                @endif
                                 @endif
                            </ul>
                        </li>

                    </ul>
                </div>
                <div class="mt-auto">
                    {{-- <div class="pt-6">
                        @if (Route::has('login'))
                                @auth
                                <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold leading-none bg-gray-50 hover:bg-gray-100 rounded-xl" href="{{ route('profile.show') }}" >Perfil</a>
                                <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-red-600 hover:bg-red-700  rounded-xl" href="{{ url('/dashboard') }}">Panel</a>
                                <form method="POST" action="{{ route('logout') }}" class="h-full" x-data>
                                    @csrf
                                    <button type="submit" class="block w-full py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-gray-600 hover:bg-gray-700  rounded-xl">{{ __('Salir') }}</button>
                                </form>
                                @else
                                <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold leading-none bg-gray-50 hover:bg-gray-100 rounded-xl" href="{{ route('login') }}" >Ingresar</a>
                                @if (Route::has('register'))
                                <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-red-600 hover:bg-red-700  rounded-xl" href="{{ route('register') }}">Registrarme</a>
                                @endif
                                @endauth
                        @endif --}}
                    </div>
                    <p class="my-4 text-xs text-center text-gray-400">
                        <span>Copyright © 2023</span>
                    </p>
                </div>
            </nav>
        </div>
   {{--   <marquee class="invisible lg:visible">
                <div class="badge badge-warning gap-2 text-gray-900 font-extrabold text-md">Últimas Publicaciones:</div>
                <div class="badge-outline inline-block ml-3 text-gray-900 font-extrabold text-md">Cantidad de Anuncios:
                </div> <span class="inline-block bg-gray-300 py-1 px-3 text-sm  text-yellow-700 ">Oro:
                    {{ $cantidad->oro }}</span> <span
                    class="inline-block bg-gray-300 py-1 px-3 text-sm  text-gray-700 ">Plata:
                    {{ $cantidad->plata }}</span> <span
                    class="inline-block bg-gray-300 py-1 px-3 text-sm text-amber-700"> Bronce:
                    {{ $cantidad->bronce }}</span> <span
                    class="inline-block bg-gray-300 py-1 px-3 text-sm text-black">Normal:
                    {{ $cantidad->normal }}</span> <span
                    class="inline-block bg-gray-300 py-1 px-3 text-sm  text-green-700">Diamante:
                    {{ $cantidad->diamante }}</span>
            </marquee>--}}
    <!--Header-->
    <div id="banderas" class="container mx-auto p-1 md:p-30">
        <div id="main" class="flex justify-center">
             @include('layouts.gt')
        </div>
        <!-- GTranslate: https://gtranslate.net/ -->
    </div>
    <div id="google_translate_element2"></div>
    <div class="container mx-auto ">
        <div id="logo" class="w-56 md:w-96 lg:w-1/3 mx-auto">
            <a href="{{ url('/') }}"><img src="{{config('app.url')}}/img/logo.png" /></a>
        </div>
    </div>
    @livewireScripts
    @yield('content')
    <footer class="footer footer-center p-10 bg-gray-500 text-primary-content">
        <div>
            {{-- <img src="{{config('app.url')}}/img/logo.png" class="w-72 h-auto" />
            <p class="font-bold text-base hover:text-lg">
                <a class="link link-hover" href="{{route('contact.form')}}" target="_blank">Formulario de contacto</a>
            </p>
            <p class="font-bold text-base hover:text-lg">
                <button onclick="location.href='mailto:info@canariasexclusiva.com';">Enviarnos un Correo</button>
            </p> --}}
            <p>Copyright © 2023 - All right reserved</p>
        </div>
        <div>
            <div class="grid grid-flow-col gap-4">
                Aviso legal y Condiciones de Uso.
                Términos y Condiciones General de Contratación. 
                Pólitica de Privacidad. 
                Pólitica de Cookies. 

            </div>
        </div>
    </footer>
    @vite(['resources/js/app.js'])
    <!-- Cargar jQuery (requerido) -->
    <!-- Cargar jQuery UI (incluye Sortable) -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js></script>
    <script src='{{config('app.url')}}/js/gdpr-cookie.js'></script>
    <script>
        
        $.gdprcookie.init({
            title: "Acepta las cookies y nuestras políticas de cookies?",
            message: "Utilizamos cookies propias y de terceros para realizar estadísticas de uso de la web con la finalidad de identificar fallos y poder mejorar los contenidos y configuración de la página web. También utilizamos cookies propias y de terceros para recordar algunas opciones que hayas elegido (idioma, por ejemplo). Para más información, visita la  <a class='link link-hover' href='{{config('app.url')}}/cookies-policy' target='_blank'>Política de Cookies </a><br>",
            delay: 600,
            expires: 1,
            acceptBtnLabel: "Aceptar cookies",
            advancedBtnLabel: "Configurar / Rechazar Cookies",
            subtitle: "Seleccione las cookies que acepta.",
            cookieTypes: [{
                    type: "Esenciales",
                    value: "essential",
                    description: "Estas cookies son esenciales para el correcto funcionamiento del sitio.",
                    checked: true,
                },
                {
                    type: "Preferencias del Sitio",
                    value: "preferences",
                    description: "Estas cookies son referentes a tus preferencias en el sitio.",
                    checked: true,
                },
                {
                    type: "Analíticas",
                    value: "analytics",
                    description: "Estas cookies están relacionadas a las visitas del sitio, tipo de navegador, etc.",
                    checked: true,
                },
                {
                    type: "Marketing",
                    value: "marketing",
                    description: "Cookies relacionadas a marketing, Ej. newsletters, social media, etc. No las usamos por el momento",
                    checked: true,
                }
            ],
        });

        $(document.body)
            .on("gdpr:show", function() {
                console.log("Cookie dialog is shown");
            })
            .on("gdpr:accept", function() {
                var preferences = $.gdprcookie.preference();
                console.log("Preferences saved:", preferences);
            })
            .on("gdpr:advanced", function() {
                console.log("Advanced button was pressed");
            });

        if ($.gdprcookie.preference("marketing") === true) {
            console.log("This should run because marketing is accepted.");
        }
    </script>

    
    <script>
        //Init tooltips
        tippy('.avatar')
    </script>
{{--
<script>
    function toggleDropdown(event) {
        event.preventDefault();
        event.target.nextElementSibling.classList.toggle("hidden");
    }
    </script> --}}

<script>
    // Burger menus
document.addEventListener('DOMContentLoaded', function() {
    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
        for (var i = 0; i < burger.length; i++) {
            burger[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
        for (var i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    if (backdrop.length) {
        for (var i = 0; i < backdrop.length; i++) {
            backdrop[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }
});
</script>


    @livewireScripts

    <script>
    Livewire.on('alert', function() {
        Swal.fire({
            // position: 'top-end',
            icon: 'success',
            title: 'Se ha guardado tu anuncio.',
            showConfirmButton: true,
        })
    })
</script>
<script>
    Livewire.on('notify-error', function() {
        Swal.fire({
            // position: 'top-end',
            icon: 'error',
            title: 'Hay errores en los datos. Por favor verifica los datos de tu anuncio.',
            showConfirmButton: true,
        })
    })
</script>
<script>
    Livewire.on('verificar', function() {
        verificar();
    });
</script>
<script>
    Livewire.on('previewImage', function() {
        previewImage();
    });
</script>
<script>
    Livewire.on('set_perfil', function() {
        set_perfil();
    });
</script>

<script>
    Livewire.on('previewVideo', function() {
        previewVideo();
    });
</script>
</body>

</html>
