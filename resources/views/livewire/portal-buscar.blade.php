<div>
    <div class="p-8 bg-red-100">
        <h2 class="font-bold text-xl  italic my-5">ANUNCIOS DOBLES</h2>
        <div class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-3 gap-3 ">

            @foreach ($anuncios_doble as $anuncio)
            @include('anuncios.portal.col-anuncios_dobles')
        @endforeach
        </div>
    </div>
    <div class="p-8 bg-base-300">

            @if(is_null(session('provinciaSel')))
                            @include('livewire.pop-index')
                        @endif
            <div style="display: none">@if(!is_null($provincia))
                {{$provincia->texto_seo}}
            @endif
            </div>
            <div style="display: none">@if(!is_null($categoria))
                {{$categoria->texto_seo}}
            @endif
            </div>

            <div style="display: none">@if(!is_null($municipio))
                {{$municipio->texto_seo}}
            @endif
            </div>

            <h2 class="font-bold text-xl italic my-5">ANUNCIOS DESTACADOS</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 2xl:grid-cols-6 gap-3 ">


            @foreach ($anuncios_diamante as $anuncio)
                @include('anuncios.portal.4col-anuncios')
            @endforeach
            @foreach ($anuncios_oro as $anuncio)
                @include('anuncios.portal.4col-anuncios')
            @endforeach
            {{-- @foreach ($anuncios_destacados_complemento as $anuncio)
                @include('anuncios.portal.4col-anuncios-complemento')
            @endforeach --}}
            </div>

            <h2 class="font-bold text-xl italic my-5">MÁS ANUNCIOS</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 2xl:grid-cols-12 gap-1 ">
            @foreach ($anuncios_plata as $anuncio)
                @include('anuncios.portal.col-anuncios_nodestacados')
            @endforeach

            @foreach ($anuncios_bronce as $anuncio)
                @include('anuncios.portal.col-anuncios_nodestacados')
            @endforeach

            @foreach ($anuncios_normal as $anuncio)
                @include('anuncios.portal.col-anuncios_nodestacados')
            @endforeach
            <!--1/2 col -->
        </div>

    </div>
</div>
