@extends('layouts.portal')

@section('content')
    <!--Container-->
    <div class="container max-w-full mx-auto">

        {{-- <div>@if (!is_null($provincia))
            {{$provincia->texto_seo}}
           @endif
          </div> --}}

        <!--Nav-->
        {{-- @if (config('app.filtro_provincias_superior'))
            @livewire('state-filtro')
        @endif
        @if (config('app.filtro_islas'))
            @livewire('buscar-islas')
        @endif --}}
        <div class=" text-center">

            <div class="my-1 inline-block"><a href="{{ route('index_provincia', [$prov_tenerife]) }}"
                    class="text-gray-900  py-1 px-1  bg-base-200 hover:text-white hover:bg-black @if (session('provinciaSel') == $prov_tenerife->id) bg-gray-500 @endif">{{ $prov_tenerife->nombre }}
                </a>

            </div>
            <div class="my-1 inline-block"> <a href="{{ route('index_provincia', [$prov_laspalmas]) }}"
                    class="text-gray-900  py-1 px-1  bg-base-200 hover:text-white hover:bg-black @if (session('provinciaSel') == $prov_laspalmas->id) bg-gray-500 @endif">{{ $prov_laspalmas->nombre }}

                </a>
            </div>

        </div>
        <div class='py-0  mt-5 text-center '>
            @foreach ($municipios as $muni)
                <div class="my-1 inline-block">
                    <a href="{{ route('index_provincia_municipio', [$provincia, $muni]) }}"
                        class="text-gray-900  py-1 px-1   hover:text-white hover:bg-black @if (session('muniSelec') == $muni->id) bg-gray-500 @else bg-red-200 @endif">{{ $muni->nombre }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class='py-0  mt-5 text-center '>
            @if (!is_null($provincia))
                <div class="my-1 inline-block">
                    <a href="@if (is_null(session('muniSelec'))) {{ route('index_provincia', [$provincia]) }}
                    @else
                        {{ route('index_provincia_municipio', [$provincia, $municipio]) }} @endif"
                        class="bg-gray-300 py-1 px-3 text-base  text-gray-800 hover:bg-slate-800 hover:text-white @if (is_null($categoria)) bg-gray-500 @endif">
                        Todas
                    </a>
                </div>


                @foreach ($categorias as $categ)
                    @if (is_null(session('muniSelec')))
                        @if ($categ->cantidad_anuncios_provincia($provincia?->id) > 0)
                            <div class="my-1 inline-block">
                                <a href="{{ route('index_categoria_provincia', [$provincia, $categ]) }}"
                                    class="bg-gray-300 py-1 px-3 text-base  text-gray-800 hover:bg-slate-800 hover:text-white @if (!is_null($categoria)) @if ($categoria->id == $categ->id) bg-gray-500 @endif @endif">
                                    {{ $categ->nombre }}
                                </a>
                            </div>
                        @endif
                    @else
                        @if ($categ->cantidad_anuncios_municipio($municipio?->id) >  0)
                            <div class="my-1 inline-block">
                                <a href="{{ route('index_categoria_municipio', [$provincia, $municipio, $categ]) }}"
                                    class="bg-gray-300 py-1 px-3 text-base  text-gray-800 hover:bg-slate-800 hover:text-white @if (!is_null($categoria)) @if ($categoria->id == $categ->id) bg-gray-500 @endif @endif">
                                    {{ $categ->nombre }}
                                </a>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    @livewire('buscador-portal')
    {{-- @livewire('buscar-muni') --}}

    <!--Posts Container-->
    @livewire('portal-buscar')
    <!--/ Post Content-->


    <!--seccion de enlaces relacionados Container-->
    <div>
        <div class='py-0  my-20 text-center '>
            @if (is_null($categoria))
                @foreach ($municipios as $muni)
                    <div class="my-1 inline-block">
                        <a href="{{ route('index_provincia_municipio', [$provincia, $muni]) }}"
                            class="text-gray-900  px-5   hover:text-black @if (session('muniSelec') == $muni->id) text-red-900  @else text-gray-500 @endif">Escorts
                            en {{ $muni->nombre }}
                        </a>
                    </div>
                @endforeach
            @else
                @foreach ($municipios as $muni)
                    <div class="my-1 inline-block">
                        <a href="{{ route('index_categoria_municipio', [$provincia, $muni, $categoria]) }}"
                            class="text-gray-900  px-5   hover:text-black @if (session('muniSelec') == $muni->id) text-red-900  @else text-gray-500 @endif">{{ $categoria->nombre }}
                            en {{ $muni->nombre }}
                        </a>
                    </div>
                @endforeach
            @endif




        </div>
    </div>
    <div class="my-20 p-10">

        @if (!is_null($provincia))

            @if (is_null(session('muniSelec')))
                <div class="my-10">
                    <span class="text-bold text-lg"> <strong> Las mejores acompa«Ðantes para tus encuentros en
                            {{ $provincia->nombre }}</strong></span>
                </div>
                {!!$provincia->texto_seo!!}
            @else
                <div class="my-10">
                    <span class="text-bold text-lg"> Las mejores acompa«Ðantes para tus encuentros en
                        {{ $municipio->nombre }}</span>
                </div>
                {!! $municipio->texto_seo !!}
            @endif
        @endif

    </div>
    <!--/ Fin enlaces Content-->
    </div>
@endsection
