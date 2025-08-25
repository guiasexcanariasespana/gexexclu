@extends('layouts.portal')
@section('title', 'Home')
@section('content')
    <section>
        <div class="container mx-auto">
            <div class=" max-w-[1100px] mx-auto">
                <div style="display: none">
                    {!! $anuncio->categoria->texto_seo !!}<br>
                    {!! $anuncio->provincia->texto_seo !!}<br>
                    {!! $anuncio->municipio->texto_seo !!}<br>
                </div>
                <div class="columns-1 md:columns-2  my-10 p-3 md:p-1">
                    <div class="col-1">
                        <p class="text-base font-extrabold md:text-5xl mb-10  ">
                            <span class="inline-block bg-[#bb1a19] py-1 px-2 text-base font-medium text-white">
                                Acerca de Mi
                            </span>
                        </p>
                        <h1 class=" inline text-4xl font-extrabold  align-middle text-black mr-5">{{ $anuncio->nombre }}: {{ $anuncio->titulo }}</h1>
                        <img src="{{ config('app.url') }}/img/banderas/Bandera de {{ $anuncio->nacionalidad }}.svg"
                            class="inline-block w-10" alt="" />
                        @if (!is_null($anuncio->nacionalidad))
                            <span class="  bg-gray-300  py-1 px-1 text-sm">{!! $anuncio->nacionalidad !!}</span>
                        @endif
                        <span class=" bg-gray-300 py-1 px-3 text-sm">{{ $anuncio->edad }} años</span>
                        {{-- <span class="   bg-gray-300  py-1 px-3 text-sm"> {{ $anuncio->orientacion }}</span> --}}
                        @if (!is_null($anuncio->profesion))
                            <span class="  bg-gray-300  py-1 px-1 text-sm">{!! $anuncio->profesion !!}</span>
                        @endif
                        <div class="tooltip text-left" data-tip="Recuerda recomendar canariasexclusiva.com">
                            <h2 class="mt-4 mb-4 text-6xl font-extrabold  animate__animated animate__heartBeat">
                                {{ $anuncio->telefono_publicacion }}
                            </h2>
                            <p class="xs:text-base md:text-base lg:text-xl lg:p-2 text-red-700  animate-pulse">Di que llamas
                                de <strong>{{   env('APP_NAME') }}</strong></p>
                        </div>
                        @if ($anuncio->whatsapp == 'Si')
                            <span class="bg-[#55cd6c] text-white font-semibold pr-2 rounded-xl ">
                                <a href="https://wa.me/34{{ $anuncio->telefono_publicacion }}/?text=Chatea%20con%20este%20perfil%20de%canariasexclusiva.com"
                                    target="_blank" style="">
                                    <img src="{{ config('app.url') }}/img/whatsapp.svg"
                                        class="stroke-current inline-block flex-shrink-0 h-6 w-6 ">
                                </a>
                                {{__('CHAT')}}</span>
                        @endif
                        <div
                            class="text-base p-4 bg-red-100 rounded-sm my-5  animate__animated animate__fadeInDown  shadow-xl">
                            <p class="font-bold break-normal text-xl my-2">{{ $anuncio->titulo }}</p>
                            <div class="text-ellipsis overflow-hidden">{!! $anuncio->presentacion !!}</div>
                        </div>
                        <hr class="mt-5 mb-5 ">
                        <div class="mb-4">
                            <div class=" inline-block bg-gray-300 py-1 px-3 text-sm">
                                {{ $anuncio->provincia ? $anuncio->provincia->nombre : 'N/D' }}</div>
                            <div class=" inline-block bg-gray-300 py-1 px-3 text-sm">
                                {{ $anuncio->municipio ? $anuncio->municipio->nombre : 'N/D' }}</div>
                            <div class=" inline-block bg-gray-300 py-1 px-3 text-sm"> {{ $anuncio->localidad }}</div>
                        </div>

                        <div class="grid grid-cols-2">
                            <div><span class=" text-2xl font-extrabold  text-red-700 ">
                                    Tarifas
                                </span>
                                <ul class="bg-white rounded-lg w-96  text-gray-900">
                                    @if (!is_null($anuncio->treinta_minutos))
                                        <li class=" py-2 border-b  border-gray-200 w-full rounded-t-lg">{{ '30 Minutos' }}
                                        </li>
                                    @endif
                                    @if (!is_null($anuncio->cuarenta_y_cinco_minutos))
                                        <li class=" py-2 border-b border-gray-200 w-full">{{ '45 Minutos' }} </li>
                                    @endif
                                    @if (!is_null($anuncio->una_hora))
                                        <li class="py-2 border-b border-gray-200 w-full">{{ '1 Hora' }} </li>
                                    @endif
                                    @if (!is_null($anuncio->medio_dia))
                                        <li class="py-2 border-b border-gray-200 w-full">{{ 'Medio día' }} </li>
                                    @endif
                                    @if (!is_null($anuncio->todo_el_dia))
                                        <li class=" py-2 border-b border-gray-200 w-full">{{ 'Todo el día' }}</li>
                                    @endif
                                    @if (!is_null($anuncio->fin_de_semana))
                                        <li class="py-2 border-b border-gray-200 w-full">{{ 'Fin de semana' }} </li>
                                    @endif
                                    @if (!is_null($anuncio->hora_desplazamiento))
                                        <li class=" py-2 w-full rounded-b-lg">{{ 'Hora desplazamiento' }}</li>
                                    @endif
                                </ul>
                            </div>
                            <div>
                                <span class=" text-2xl font-extrabold  ml-5  text-red-700 "></span>

                                <div class="flex justify-center">
                                    <ul class="bg-white rounded-lg w-96 font-semibold text-gray-900">
                                        @if (!is_null($anuncio->treinta_minutos))
                                            <li class="px-6 py-2 border-b  border-gray-200 w-full rounded-t-lg">€
                                                {{ $anuncio->treinta_minutos }} </li>
                                        @endif
                                        @if (!is_null($anuncio->cuarenta_y_cinco_minutos))
                                            <li class="px-6 py-2 border-b border-gray-200 w-full">€
                                                {{ $anuncio->cuarenta_y_cinco_minutos }} </li>
                                        @endif
                                        @if (!is_null($anuncio->una_hora))
                                            <li class="px-6 py-2 border-b border-gray-200 w-full">€
                                                {{ $anuncio->una_hora }} </li>
                                        @endif
                                        @if (!is_null($anuncio->medio_dia))
                                            <li class="px-6 py-2 border-b border-gray-200 w-full">€
                                                {{ $anuncio->medio_dia }} </li>
                                        @endif
                                        @if (!is_null($anuncio->todo_el_dia))
                                            <li class="px-6 py-2 border-b border-gray-200 w-full">€
                                                {{ $anuncio->todo_el_dia }} </li>
                                        @endif
                                        @if (!is_null($anuncio->fin_de_semana))
                                            <li class="px-6 py-2 border-b border-gray-200 w-full">€
                                                {{ $anuncio->fin_de_semana }} </li>
                                        @endif
                                        @if (!is_null($anuncio->hora_desplazamiento))
                                            <li class="px-6 py-2 w-full rounded-b-lg">€ {{ $anuncio->hora_desplazamiento }}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="my-7">

                            <span class="text-2xl font-extrabold  text-red-700">
                                Horarios
                            </span>
                            <p>
                                @if (!is_null($anuncio->horario))
                                    {!! $anuncio->horario !!}
                                @endif
                            </p>

                        </div>

                        <hr class="mt-5 mb-5">

                        <span class=" text-2xl font-extrabold text-red-700">
                            Mis gustos
                        </span>
                        <div>

                            @if ($tags_ec != '[]')
                                <p class="text-sm">En mi casa: </p>
                                @foreach ($tags_ec as $gusto)
                                    <span class=" mb-1 inline-block bg-gray-900 text-white py-1 px-3 text-sm">
                                        {{ $gusto->nombre }}</span>
                                @endforeach
                            @endif

                            @if ($tags_etc != '[]')

                                <p class="text-sm">En tu casa: </p>
                                @foreach ($tags_etc as $gusto)
                                    <span class=" mb-1 inline-block bg-gray-900 text-white py-1 px-3 text-sm">
                                        {{ $gusto->nombre }}</span>
                                @endforeach
                            @endif
                            @if ($tags_al != '[]')
                                <p class="text-sm">Al aire libre: </p>
                                @foreach ($tags_al as $gusto)
                                    <span class=" mb-1 inline-block bg-gray-900 text-white py-1 px-3 text-sm">
                                        {{ $gusto->nombre }}</span>
                                @endforeach
                            @endif
                            @if ($tags_in != '[]')
                                <p class="text-sm">Bajo techo: </p>
                                @foreach ($tags_in as $gusto)
                                    <span class=" mb-1 inline-block bg-gray-900 text-white py-1 px-3 text-sm">
                                        {{ $gusto->nombre }}</span>
                                @endforeach
                            @endif
                            <hr class="mt-5 mb-5">
                            <span class="btn gap-2 ">
                                Visitas
                                <div class="badge badge-secondary"> {{ $anuncio->visitas }}</div>
                            </span>
                            <span ">
                                    <div class="badge badge-secondary"> <a class="link link-hover" href="{{ route('denuncia.form', $anuncio) }}" target="_blank">Denuncia de Perfil falso </a> </div>
                                </span>
                                <div class="text-center  ">
                                    <div class="relative z-10 inline-block">
                                        <div id="video" class="w-full my-4 aspect-video">
                                             @if ($anuncio->estado == 'Publicado')
                                @if (!is_null($anuncio->video) && $anuncio->estado_video == 'Verificado')
                                    <div>
                                        <video controls
                                            src="{{ '/videos/anuncios/' . $anuncio->id . '/' . $anuncio->video }}"
                                            oncontextmenu="return false"></video>
                                    </div>
                                @endif
                            @else
                                @if (!is_null($anuncio->video))
                                    <div>
                                        <video controls
                                            src="{{ '/videos/anuncios/' . $anuncio->id . '/' . $anuncio->video }}"
                                            oncontextmenu="return false"></video>
                                    </div>
                                @endif
                                @endif
                        </div>
                    </div>
                </div>
                @if ($anuncio->estado == 'Publicado')
                    @foreach ($anuncio->imagenes_verificadas_ordenadas as $img)
                        <img alt="fotos" class="m-2 rounded-2xl "
                            src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                            loading="lazy" oncontextmenu="return false">
                    @endforeach
                @else
                    @foreach ($anuncio->imagens as $img)
                        <img alt="fotos" class="m-2 rounded-2xl "
                            src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                            loading="lazy" oncontextmenu="return false">
                    @endforeach
                @endif
            </div>
        </div>
        </div>
    </section>
    <!-- ====== Acerca de mi Section End -->
    <section id="relacionados" class="bg-base-200  py-10 px-10  animate__animated animate__fadeInUp animate__delay-2s">
        <div class="container mx-auto h-2/3 ">
            <h2 class=" border-l-4 border-[#bb1a19] italic text-3xl font-bold my-8 pl-8 md:pl-12">Quizas pueda
                interesarte...
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-3">
                @foreach ($anuncio->relacionados() as $anun)
                    <div class="hover:shadow-xl transition-transform transform hover:border-2 border-[{{ $anun->clase->color }}]"
                        style="background-color: {{ $anun->clase->color }}">
                        <div class="h-[500px]">
                            <a href="{{ route('portal.show', [ $anun->provincia, $anun->municipio,  $anun->categoria, $anun->user_id, $anun]) }}"
                                class="no-underline hover:no-underline">
                                @if (is_null($anun->portada))
                                    <img src="{{ config('app.url') }}/images/logo.png " class="object-cover ">
                                @else
                                    <img class="object-cover w-full h-full"src="{{ config('app.url') . '/images/anuncio/' . $anun->id . '/' . $anun->portada->nombre }}"
                                        loading="lazy" oncontextmenu="return false">
                                @endif
                            </a>
                        </div>
                        <div class="py-2 px-2">
                            <h3 class="text-xl font-extrabold">
                                {{ \Illuminate\Support\Str::limit($anun->nombre, 50, $end = '...') }}</h3>
                            <p class="text-xs">{{ \Illuminate\Support\Str::limit($anun->titulo, 50, $end = '...') }}</p>

                            <div class="inline-block bg-gray-300 py-1 px-3  text-xs">{{ $anun->edad }} años</div>

                            @if (!is_null($anun->nacionalidad))
                                <div class="inline-block bg-gray-300 py-1 px-3  text-xs">
                                    {{ \Illuminate\Support\Str::limit($anun->nacionalidad, 15, $end = '...') }}</div>
                            @endif
                            @if (!is_null($anun->municipio))
                                <div class="inline-block bg-gray-300 py-1 px-3  text-xs">
                                    {{ \Illuminate\Support\Str::limit($anun->municipio->nombre, 15, $end = '...') }}</div>
                            @endif
                        </div>
                        <div class="inline-flex justify-start m-1 text-base px-2 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>

                            <div class="text-[#bb1a19]  text-base ">{{ count($anun->imagenes_verificadas_ordenadas) }}
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round"
                                    d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <div class="text-[#bb1a19] text-base ">
                                @if (is_null($anun->video) or $anun->estado_video != 'Verificado')
                                    0
                                @else
                                    1
                                @endif
                            </div>
                            @if ($anun->verificacion == 'Si')
                                <div style=";">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="stroke-current inline-block flex-shrink-0 h-6 w-6" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" color="black" stroke-linejoin="round"
                                            stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-black font-semibold pr-2">Verificada</span>
                                </div>
                            @endif
                            @if ($anun->whatsapp == 'Si')
                                <span class="bg-[#55cd6c] text-white font-semibold pr-2 rounded-xl ">
                                    <a href="https://wa.me/{{ $anun->telefono_publicacion }}/?text=Chatea%20con%20este%20perfil%20de%canariasexclusiva.com"
                                        target="_blank" style="">
                                        <img src="{{ config('app.url') }}/img/whatsapp.svg"
                                            class="stroke-current inline-block flex-shrink-0 h-6 w-6 ">
                                    </a>
                                    CHAT</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
        </div>
        <div class="px-5 py-5 mt-5 justify-items-end">
            <a href="
            @if (is_null(session('categoriaSel')))
                @if (is_null(session('muniSelec')))
                        {{ route('index_provincia', [$anuncio->provincia]) }}
                @else
                        {{ route('index_provincia_municipio', [$anuncio->provincia, $anuncio->municipio]) }}
                @endif
            @else
                @if (is_null(session('muniSelec')))
                        {{ route('index_categoria_provincia', [ $anuncio->provincia, $anuncio->categoria]) }}
                @else
                        {{ route('index_categoria_municipio', [ $anuncio->provincia, $anuncio->municipio, $anuncio->categoria ]) }}
                @endif
            @endif"
                class="text-md text-gray-700 ">
                <span class="badge badge-lg">REGRESAR AL LISTADO</span></a>
            @auth
                <a href="{{ route('dashboard', $anuncio) }}" class="text-md text-gray-700 ">
                    <span class="badge badge-lg">REGRESAR A MI PANEL</span></a>
            @endauth
        </div>
    </section>
@endsection
