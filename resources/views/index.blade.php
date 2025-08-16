<!DOCTYPE html>

<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    @include('google_analytics')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! SEO::generate() !!}




    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.31.0/dist/full.css" rel="stylesheet" type="text/css" />
    <!--Replace with your tailwind.css once created-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Styles -->
    <title>@yield('title')</title>

    <style type="text/css">
        a.gflag {
            vertical-align: middle;
            font-size: 16px;
            padding: 5px 6px;
            background-repeat: no-repeat;
            /* background-image: url('/template/formato_guiasexcanarias/modulos/mod_gtranslate/tmpl/lang/24.png'); */
        }

        a.gflag img {
            border: 0;
        }

        a.gflag:hover {
            /* background-image: url('/template/formato_guiasexcanarias/modulos/mod_gtranslate/tmpl/lang/24a.png'); */
            -webkit-filter: grayscale(1);
            filter: grayscale(1);
        }

        #goog-gt-tt {
            display: none !important;
        }

        .goog-te-banner-frame {
            display: none !important;
        }

        .goog-te-menu-value:hover {
            text-decoration: none !important;
        }

        body {
            top: 0 !important;
        }

        #google_translate_element2 {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="antialiased">
    <link href="{{ config('app.url') }}/css/gdpr-cookie.css" rel="stylesheet">
    <!--Header-->



    <div class="bg-base-200 p-1 shadow-sm ">
        <div class="flex justify-center mt-1">
            <a href="{{ route('register') }}"
                class=" text-sm  md:text-base text-gray-900 dark:text-gray-700 font-bold hover:text-red-700 mr-4  px-2 border border-1 border-black bg-transparent hover:border-red-700 rounded">Publica tu Anuncio</a>

            <a href="{{ route('login') }}"
                class="text-sm  md:text-base text-gray-900 dark:text-gray-700 font-bold hover:text-red-700 mr-4  px-2 border border-1 border-black bg-transparent hover:border-red-700 rounded">Ingresar</a>
            {{-- @livewire('modal-precio') --}}
        </div>



    </div>

    <div id="banderas" class="container mx-auto p-1 md:p-30">

        <div id="main" class="flex justify-center">



            <a href="#" onclick="doGTranslate('es|zh-TW');return false;" title="Chinese (Traditional)"
                class="gflag nturl" style="background-position:-400px -0px;"><img
                    src="{{ config('app.url') }}/img/banderas/Bandera de China.svg" height="25" width="25"
                    alt="Chinese (Traditional)" /></a>
            <a href="#" onclick="doGTranslate('es|fr');return false;" title="French" class="gflag nturl"
                style="background-position:-200px -100px;"><img
                    src="{{ config('app.url') }}/img/banderas/Bandera de Francia.svg" height="25" width="25"
                    alt="French" /></a>
            <a href="#" onclick="doGTranslate('es|de');return false;" title="German" class="gflag nturl"
                style="background-position:-300px -100px;"><img
                    src="{{ config('app.url') }}/img/banderas/Bandera de Alemania.svg" height="25" width="25"
                    alt="German" /></a>
            <a href="#" onclick="doGTranslate('es|it');return false;" title="Italian" class="gflag nturl"
                style="background-position:-600px -100px;"><img
                    src="{{ config('app.url') }}/img/banderas/Bandera de Italia.svg" height="25" width="25"
                    alt="Italian" /></a>
            <a href="#" onclick="doGTranslate('es|pt');return false;" title="Portuguese" class="gflag nturl"
                style="background-position:-300px -200px;"><img
                    src="{{ config('app.url') }}/img/banderas/Bandera de Portugal.svg" height="25" width="25"
                    alt="Portuguese" /></a>
            <a href="#" onclick="doGTranslate('es|ru');return false;" title="Russian" class="gflag nturl"
                style="background-position:-500px -200px;"><img
                    src="{{ config('app.url') }}/img/banderas/Bandera de Rusia.svg" height="25" width="25"
                    alt="Russian" /></a>
            <a href="#" onclick="doGTranslate('es|es');return false;" title="Spanish" class="gflag nturl"
                style="background-position:-600px -200px;"><img
                    src="{{ config('app.url') }}/img/banderas/Bandera de España.svg" height="25" width="25"
                    alt="Spanish" /></a>
            <a href="#" onclick="doGTranslate('es|ca');return false;" title="Catalan" class="gflag nturl"
                style="background-position:-300px -200px;"><img
                    src="{{ config('app.asset_prefix') }}/img/banderas/Catalonia.svg" height="25" width="25"
                    alt="Catalan" /></a>
            <a href="#" onclick="doGTranslate('es|eu');return false;" title="Basque" class="gflag nturl"
                style="background-position:-300px -200px;"><img
                    src="{{ config('app.asset_prefix') }}/img/banderas/basco.svg" height="25" width="25"
                    alt="Basque" /></a>
        </div>
        <!-- GTranslate: https://gtranslate.net/ -->

    </div>
    <div id="google_translate_element2"></div>

    <div class="container mx-auto">
        <div id="logo" class="w-64 md:1/3 lg:w-1/2 mx-auto"><a href="{{ url('/') }}"><img
                    src="{{ config('app.url') }}/img/logo.png" /></a>
        </div>


    </div>


    <div class="container mx-auto ">

        <!--Posts Container-->
        @if (!is_null($ultima_categoria) && !is_null($ultima_provincia))
            <h2 class="card-title sm:text-lg md:text-3xl my-1 md:my-2 lg:my-3 xl:my-4 hover:text-red-600">
                <a href="{{ route('set_provincia_y_categoria', [$ultima_provincia, $ultima_categoria]) }}">
                    Ver {{ is_null($ultima_categoria) ? 'escort' : $ultima_categoria->nombre }}
                    {{ is_null($ultima_provincia) ? '' : ' en ' . $ultima_provincia->nombre }}
                </a>
            </h2>
        @endif


        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3  gap-4 ">


            @foreach ($categorias as $categoria)
                <div class="card  bg-base-100 shadow-xl hover:shadow-md">

                    @if ($categoria->nombre == 'Chicas')
                    <a href="{{ route('set_provincia_y_categoria', [$prov_laspalmas, $categoria]) }}"
                    class="card-title text-xl lg:text-2xl font-extrabold hover:text-red-600">
                        <figure><img src="{{ config('app.url') }}/img/chicas.jpeg" alt="Chicas" /></figure></a>
                    @elseif (str_contains($categoria->nombre, 'rans'))
                    <a href="{{ route('set_provincia_y_categoria', [$prov_laspalmas, $categoria]) }}"
                    class="card-title text-xl lg:text-2xl font-extrabold hover:text-red-600">
                        <figure><img src="{{ config('app.url') }}/img/trans.jpeg" alt="Transexuales" /></figure></a>
                    @elseif ($categoria->nombre == 'Masajes')
                    <a href="{{ route('set_provincia_y_categoria', [$prov_laspalmas, $categoria]) }}"
                    class="card-title text-xl lg:text-2xl font-extrabold hover:text-red-600">
                        <figure><img src="{{ config('app.url') }}/img/masajes.jpeg" alt="Masajes" /></figure></a>

                    @endif

                    <div class="card-body">
                        <div class="badge bg-[#bb1a19] py-3 border-none">Categoría</div>
                        <div style="display: none">
                            {!! $categoria->texto_seo !!}<br>
                        </div>
                        <a href="{{ route('set_provincia_y_categoria', [$prov_laspalmas, $categoria]) }}"
                            class="card-title text-xl lg:text-2xl font-extrabold hover:text-red-600">{{ $categoria->nombre }}</a>
                        <h3 class="text-xs">Provincias Principales:</h3>
                        <div class="">

                            <div class=" ">

                                <div class="my-1 inline-block"><a
                                        href="{{ route('set_provincia_y_categoria', [$prov_tenerife, $categoria]) }}"
                                        class="text-gray-900  py-1 px-1  bg-base-200 hover:text-white hover:bg-black">{{ $prov_tenerife->nombre }}
                                       <!-- ({{ $categoria->anuncios->where('provincia_id', $prov_tenerife->id)->where('estado', 'Publicado')->count() }})--></a>

                                </div>
                                <div class="my-1 inline-block"> <a
                                        href="{{ route('set_provincia_y_categoria', [$prov_laspalmas, $categoria]) }}"
                                        class="text-gray-900  py-1 px-1  bg-base-200 hover:text-white hover:bg-black">{{ $prov_laspalmas->nombre }}
                                        <!-- ({{ $categoria->anuncios->where('provincia_id', $prov_laspalmas->id)->where('estado', 'Publicado')->count() }})--></a>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            @endforeach



        </div>



        <!-- Livewire Component wire-end:5fBBmNI0swnu599eDOb5 -->
        <!--/ Post Content-->


    </div>


    <!--Container-->

    <section>

        <div class="mx-auto max-w-screen-2xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">


            <div class="py-5">
                <article class="space-y-4 text-gray-600">
                    <p>
                        <strong> canariasexclusiva.com </strong>es un portal web
                        que da alojamiento y conexión segura, para que los usuarios puedan tener perfiles personales e
                        interactuar con otros usuarios para
                        posibles encuentros. Una escort chica o escort chico es una persona que actúa como acompañante
                        remunerado, es decir, alguien a quien un cliente paga por acudir con él o ella a reuniones,
                        salidas,
                        viajes, etc.
                    </p>

                    <p>
                        Ningún anuncio de
                        canariasexclusiva.com ofrece sexo sino como bien lo decimos en nuestro nombre, queremos que tengas
                        tu
                        mejor encuentro en tu ciudad para realizar actividades tanto al aire libre como en casa, con la
                        compañia que quieras! <strong> "Siempre decimos que acompañados es mejor." </strong> <br
                            class="hidden lg:block"><br class="hidden lg:block"> En canariasexclusiva.com no somos
                        responsables de ningún servicio que
                        no
                        esté anunciado en la web. Hombres, mujeres, transexuales y travestis, masajistas ofrecen sus
                        servicios para encuentros como acompañanantes. <br class="hidden lg:block"><br
                            class="hidden lg:block"> <strong> Nuestro objetivo es que la gente con aficiones y gustos
                            en
                            común puedan encontrarse y disfrutar. Creamos encuentro únicos!</strong>
                    </p>
                </article>
            </div>

        </div>
    </section>
    <footer class="p-4 bg-base-200 rounded-lg shadow md:flex md:items-center md:justify-between md:p-6 ">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a
                href="https://canariasexclusiva.com/" class="hover:underline">canariasexclusiva.com</a>. All Rights Reserved.
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
            <li>
                Formulario de contacto
            </li>

            <li>
                Pólitica de Cookies. 
            </li>
            <li>
                Pólitica de Privacidad
            </li>
            <li>
                Aviso legal y Condiciones de Uso.
            </li>
            <li>
                Términos y Condiciones General de Contratación.
            </li>






        </ul>
    </footer>





    <script src=https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js></script>
    <script src='{{ config('app.url') }}/js/gdpr-cookie.js'></script>
    <script>
        $.gdprcookie.init({
            title: "Acepta las cookies y nuestras políticas de cookies?",
            message: "Utilizamos cookies propias y de terceros para realizar estadísticas de uso de la web con la finalidad de identificar fallos y poder mejorar los contenidos y configuración de la página web. También utilizamos cookies propias y de terceros para recordar algunas opciones que hayas elegido (idioma, por ejemplo). Para más información, visita la  <a class='link link-hover' href='{{ config('app.url') }}/cookies-policy' target='_blank'>Política de Cookies </a><br>",
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

    <script type="text/javascript">
        function googleTranslateElementInit2() {
            new google.translate.TranslateElement({
                pageLanguage: 'es',
                autoDisplay: false
            }, 'google_translate_element2');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2">
    </script>


    <script type="text/javascript">
        /* <![CDATA[ */
        eval(function(p, a, c, k, e, r) {
            e = function(c) {
                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c
                    .toString(36))
            };
            if (!''.replace(/^/, String)) {
                while (c--) r[e(c)] = k[c] || e(c);
                k = [function(e) {
                    return r[e]
                }];
                e = function() {
                    return '\\w+'
                };
                c = 1
            };
            while (c--)
                if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
            return p
        }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',
            43, 43,
            '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'
            .split('|'), 0, {}))
        /* ]]> */
    </script>
    <script>
        $(function() {
            $('#gtidiomas').on('change', function() {
                lang = $(this).val();
                doGTranslate(lang);
                return false;
            })
        });
    </script>

    <script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    @livewireScripts
</body>

</html>
