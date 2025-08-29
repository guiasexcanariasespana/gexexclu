        <!--1/3 col -->

<div>

        <div class="relative h-0" style="padding-bottom: 145%">
          <a href="{{route('portal.show', [$anuncio->provincia, $anuncio->municipio, $anuncio->categoria, $anuncio->user_id,  $anuncio])}}" class="no-underline hover:no-underline">
              @if(is_null($anuncio->portada))
              <img  src="{{config('app.url')}}/images/logo.png " class="absolute h-full w-full object-contain ">
              @else
              <img  class="absolute h-full w-full object-contain hover:shadow-xl transition-transform transform hover:border-4 border-[{{$anuncio->clase->color}}]" src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $anuncio->portada->nombre }}" loading="lazy" oncontextmenu="return false">
              @endif
          </a>
        </div>

        <div class="py-2 px-2">
          <h3 class="text-xl font-extrabold">{{ \Illuminate\Support\Str::limit($anuncio->nombre, 50, $end='...') }}  <span class="inline-block ml-1"><img src="{{config('app.url')}}/img/banderas/Bandera de {{$anuncio->nacionalidad}}.svg" class="inline-block w-6" alt=""/> </span></h3>
          <p class="text-xs">{{ \Illuminate\Support\Str::limit($anuncio->titulo, 50, $end='...') }}</p>
          <div class="inline-block bg-gray-700 py-1 px-3 text-white text-xs">{{ $anuncio->categoria->nombre }}</div>
          <div class="inline-block bg-gray-300 py-1 px-3  text-xs">{{ $anuncio->edad }} años</div>

          @if (!is_null($anuncio->nacionalidad))

          <div class="inline-block bg-gray-300 py-1 px-3  text-xs">{{ \Illuminate\Support\Str::limit($anuncio->nacionalidad, 15, $end='...') }}</div>

          @endif
          @if (!is_null($anuncio->municipio))
          <div class="inline-block bg-gray-300 py-1 px-3  text-xs">{{ \Illuminate\Support\Str::limit( $anuncio->municipio->nombre, 15, $end='...') }}</div>
          @endif

          </div>




        <div class="inline-flex justify-start  text-xs px-2 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
              </svg>

                <div class="text-[#bb1a19]  text-xs ">{{count($anuncio->imagenes_verificadas_ordenadas)}}</div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-1">
                <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
              </svg>
                <div class="text-[#bb1a19] text-xs ">
                @if (is_null($anuncio->video) Or ($anuncio->estado_video != 'Verificado' ))
                  0
                @else
                1
                @endif
                </div>
                @if ($anuncio->verificacion == 'Si')
                <div style=";">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current inline-block flex-shrink-0 h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" color="black" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  <span class="text-black text-xs font-normal ">Verificada</span>
                  </div>
              @endif
                @if ($anuncio->whatsapp == 'Si')

                <span class="bg-[#55cd6c] text-white text-xs font-normal  rounded-xl ">
                  <a href="https://wa.me/34{{ $anuncio->telefono_publicacion }}/?text=Chatea%20con%20este%20perfil%20de%canariasexclusiva.com" target="_blank" style="">
                    <img src="{{config('app.url')}}/img/whatsapp.svg" class="stroke-current inline-block flex-shrink-0 h-5 w-5 " >
                  </a>
                  CHAT</span>
                @endif


  </div>


</div>


